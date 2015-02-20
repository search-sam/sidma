@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@stop

@section('content')
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
    <h1 class="page-header">Usuario <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Nuevo Usuario</button> </h1>
    <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
              <thead>
                <tr>
                      <th>Nombre</th>
                      <th>Perfil</th>
                      <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($usuarios as $usuario)
                <tr>
                      <td>{{$usuario->user}}</td>
                      <td>
                          @foreach (Util::$perfiles as $id=>$perfil)
                            @if ($usuario->cod_profile == $id)
                                {{$perfil}}
                            @endif
                          @endforeach
                      </td>
                      <td>
                          <div class="btn-group">
                              <button type="button" class="btn btn-default edit" ref="#"><span class="glyphicon glyphicon-edit"></span></button>
                        </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div>
</div>

{{-- ==================================================================================================== --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tipo de Usuario</h4>
              </div>

              <div class="modal-body">
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
                          <thead>
                            <tr>
                                  <th>Perfil de Usuario</th>
                                  <th></th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach (Util::$perfiles as $id=>$perfil)
                            <tr>
                                  <td><input class=".profile" type="radio" name="cod-profile" value="{{$id}}"/></td>
                                  <td>{{$perfil}}</td>
                            </tr>
                            @endforeach
                      </tbody>
                    </table>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="asignar" data-dismiss="modal" ref="{{action('UsuarioController@nuevo')}}">Continuar</button>
              </div>
        </div>
      </div>
</div>
@stop

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();

    $(document).on('click', '.edit', function(){
        $(location).attr('href', $(this).attr('ref'));
    });

    $(document).on('click', '#asignar', function(){
        var perfil = $("input:radio[name=cod-profile]:checked").val();
        $(location).attr('href', $(this).attr('ref')+'?perfil='+perfil);
    });
});
</script>
@stop
