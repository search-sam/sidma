@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav bs-docs-sidenav">
        <li><a href="#employments"><b>Cargos</b></a></li>
        <li><a href="#employees"><b>Empleados</b></a></li>
    </ul>
</div>
@stop

@section('content')
<div id="employments" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Cargos
        <button data-toggle="modal" data-target="#NewOrEditModal" id="NewEmployment"  class="btn btn-success">Nuevo cargo</button></h1>

    <div class="table-responsive">
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
                <button id="{{$cargo->cod_employment}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editemployment btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
            </div>
            </th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="employees" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Empleados
        <button data-toggle="modal" data-target="#NewOrEditModal" id="NewEmployee"  class="btn btn-success">Nuevo empleado</button></h1>

    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Residencia</th>
                    <th>Teléfonos</th>
                    <th>E-mails</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td>{{$empleado->cedula}}</td>
                    <td>{{$empleado->EmployeeName}}</td>
                    <td><address>{{$empleado->city_live}}, {{$empleado->neighborhood_live}}; {{$empleado->address_detail}}. <?= empty($empleado->house_number)?'':'casa #'.$empleado->house_number.'.' ?></address></td>
                    <td><?= ($empleado->phone==0)?'':'<span class="glyphicon glyphicon-earphone"></span>: '.$empleado->phone.'<br/>'?><?= ($empleado->mobile==0)?'':'<span class="glyphicon glyphicon-phone"></span>'.$empleado->mobile.'<br/>' ?><?= ($empleado->other_phone==0)?'':'<span class="glyphicon glyphicon-phone"></span>'.$empleado->other_phone ?></td>
                    <td><?= empty($empleado->email)?'':'<span class="glyphicon glyphicon-envelope"></span><b> personal: </b>'.$empleado->email.'<br/>' ?><?= empty($empleado->institutional_email)?'':'<span class="glyphicon glyphicon-envelope"></span><b> institucional: </b>'.$empleado->institutional_email?></td>            
                    <th>
                        <span class="label {{($empleado->employee_state==1)?'':' label-success'}}"><?= Util::$employee_state[$empleado->employee_state] ?></span></th>          
                    <th>
            <div class="btn-group">
                <button id="{{$empleado->cod_employee}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editemployee btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
            </div>
            </th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!--
      <div class="panel panel-default">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica </h4>
              </div>
              <div class="modal-body">
                  loading...
              </div>
          </div>
      </div>-->
</div>

@stop

@section('js')
<<<<<<< HEAD

<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>

=======
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
>>>>>>> fc3a6fb7cb8fdc99b9dc659b6533c4da06aef4fe
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $("#NewEmployment").live("click", function() {
        $("#NewOrEditModal").load("../cargo/editar");
    });
    $(".editemployment").live("click", function() {
        $("#NewOrEditModal").load("../cargo/editar?cod_employment=" + $(this).attr('id'));
    });
    $("#saveemployment").live('click', function() {
        $("#formnewedit").submit();
    });
    $("#NewEmployee").live("click", function() {
        $("#NewOrEditModal").load("../empleado/editar");
    });
    $(".editemployee").live("click", function() {
        $("#NewOrEditModal").load("../empleado/editar?cod_employee=" + $(this).attr('id'));
    });
    $("#saveemployee").live('click', function() {
        $("#formnewedit").submit();
    });
    $('#example').dataTable();
});
</script>
@stop
