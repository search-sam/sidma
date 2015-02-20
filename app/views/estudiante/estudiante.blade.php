@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@stop

@section('content')
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
    <h1 class="page-header">Estudiante <a href="{{action('EstudianteController@nuevo')}}" class="btn btn-success">Nuevo Estudiante</a> </h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                <tr>
                    <td>{{($estudiante->student_state>0)?$estudiante->student_card:'<div class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-info-sign"></i><strong> Registro previo</strong></div>'}}</td>
                    <td>
                        {{$estudiante->first_name}}
                        <?= empty($estudiante->second_name) ? '' : $estudiante->second_name; ?>
                        {{$estudiante->first_last_name}}
                        <?= empty($estudiante->second_last_name) ? '' : $estudiante->second_last_name; ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="edit btn btn-sm btn-default" href="{{action('EstudianteController@editar').'?id='.$estudiante->cod_student}}"><span class="glyphicon glyphicon-edit"></span></a>
                            {{-- <button type="button" class="btn btn-default dihab" id="{{$estudiante->cod_student}}" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-{{$estudiante->student_state==1?'ok':'remove'}}"></button> --}}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('js')
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();

    $(document).on('click', '.edit', function() {
        $(location).attr('href', $(this).attr('ref'));
    });


});
</script>
@stop