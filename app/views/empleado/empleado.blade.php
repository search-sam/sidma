@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-pills">
        <li><a href="#employments"><b>Cargos</b> <span class="badge">{{$cargos->count()}}</span></a></li>
        <li><a href="#employees"><b>Empleados</b> <span class="badge">{{$empleados->count()}}</span></a></li>
    </ul>
</div>
@stop

@section('content')
<div id="employments" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader">Cargos
        <button data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo cargo al sistema'  type="button"  id="NewEmployment"  class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo cargo</button>
    </h1>
    <div class="alert alert-success" <?= Session::has('message_employment') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_employment')}}
    </div>

    <div class="table-respondsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th>Nombre cargo</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cargos as $cargo)
                <tr>
                    <td>{{$cargo->employment_name}}</td>
                    <td>{{$cargo->description}}</td>
                    <th>
            <div class="btn-group">
                <button id="{{$cargo->cod_employment}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editemployment btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button>
            </div>
            </th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="employees" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader">Empleados
        <button data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo empleado al sistema' type="button" data-toggle="modal" data-target="#NewOrEditModal" id="NewEmployee"  class="btn btn-success">
          <i class="glyphicon glyphicon-plus-sign"></i> Nuevo empleado
        </button>
    </h1>
    <div class="alert alert-success" <?= Session::has('message_employee') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_employee')}}
    </div>

    <div class="table-resdponsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table_employees">
            <thead>
                <tr>
                    <th >Identificación</th>
                    <th style="width:400px!important;">Nombre</th>
                    <th class="col-sm-1" >Teléfonos</th>
                    <th class="col-sm-2">E-mails</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td>{{$empleado->cedula}}</td>
                    <td>{{$empleado->EmployeeName}}
                        <address style="color:#555;">
                            {{$empleado->city_live}}, {{$empleado->neighborhood_live}}; 
                            {{$empleado->address_detail}}. 
        <?= empty($empleado->house_number) ? '' : 'casa #' . $empleado->house_number . '.' ?></address></td>
                    <td><?= ($empleado->phone == 0) ? '' : '<span class="glyphicon glyphicon-earphone"></span> ' . $empleado->phone . '<br/>' ?><?= ($empleado->mobile == 0) ? '' : '<span class="glyphicon glyphicon-phone"></span> ' . $empleado->mobile . '<br/>' ?><?= ($empleado->other_phone == 0) ? '' : '<span class="glyphicon glyphicon-phone"></span> ' . $empleado->other_phone ?></td>
                    <td><?= empty($empleado->email) ? '' : '<b style="color:#444;"><span class="glyphicon glyphicon-envelope"></span> personal </b>' . '<br/>'.$empleado->email . '<br/>' ?><?= empty($empleado->institutional_email) ? '' : '<b style="color:#444;"><span class="glyphicon glyphicon-envelope"></span> institucional: </b>' .'<br/>'.$empleado->institutional_email ?></td>            
                    <td>
                        <span class="label {{($empleado->employee_state==1)?'':' label-success'}}"><?= Util::$employee_state[$empleado->employee_state] ?></span></td>          
                    <td>
                        <div class="btn-group">
                            <button data-loading-text="Cargando formulario..."  id="{{$empleado->cod_employee}}"  type="button" class="editemployee btn btn-sm btn-default" ><i class="glyphicon glyphicon-edit"></i> Editar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

               
</div>
@stop

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.es.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
     $('[data-toggle="tooltip"]').tooltip();
    $('#table_employees').dataTable();
    $(document).on("click", "#NewEmployment", function() {
        $("#NewOrEditModal").modal('show');
        $("#NewOrEditModal").load("../cargo/editar");
    });
    $(document).on("click", "#NewEmployee", function() {
         $("#NewOrEditModal").modal('show');
        $("#NewOrEditModal").load("../empleado/editar");
    });
    $(document).on("click", ".editemployment", function() {      
     // $(this).button('loading');
        $("#NewOrEditModal").modal('show');
        $("#NewOrEditModal").load("../cargo/editar?cod_employment=" + $(this).attr('id'));
    });

    $(document).on("click", '.editemployee', function() {
        $("#NewOrEditModal").modal('show');
        $("#NewOrEditModal").load("../empleado/editar?cod_employee=" + $(this).attr('id'));
    });
   /* $(document).on('click', '#savecontrol', function() {
        if (formIsvalid($(".modal-content .form-control[required]"))) {
            $("#formnewedit").submit();
        }

    });*/

});
</script>
@stop
