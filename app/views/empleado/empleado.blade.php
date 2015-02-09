@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@parent
<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li><a href="{{action('EmpleadoController@nuevo')}}">Nuevo</a></li>
		<li><a href="#">Reports</a></li>
		<li><a href="#">Analytics</a></li>
		<li><a href="#">Export</a></li>
	</ul>
</div>
@stop

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h1 class="page-header">Empleado</h1>

<div class="table-responsive">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
      	<thead>
        	<tr>
          		<th>Nombre</th>
          		<th>Cedula</th>
        	</tr>
      	</thead>
      	<tbody>
      		@foreach ($empleados as $empleado)
        	<tr>
          		<td>{{$empleado->cedula}}</td>
          		<td>{{$empleado->first_name}} {{$empleado->first_last_name}}</td>
        	</tr>
        	@endforeach
      </tbody>
    </table>
  </div>
 </div>
@stop

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#example').dataTable();
});
</script>
@stop
