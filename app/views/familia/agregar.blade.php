@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@parent
<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li class="active"><a href="{{action('FamiliaController@padrenuevo')}}">Agregar Familia</a></li>
		<li><a href="#">Reports</a></li>
		<li><a href="#">Analytics</a></li>
		<li><a href="#">Export</a></li>
	</ul>
</div>
@stop

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

	<h1 class="page-header">Agregar Familia</h1>

	<div class="table-responsive">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<span class="glyphicon glyphicon-minus-sign" id="asignar-icon"></span>
					Asignacion de Familia al Estudiante
				</h3>
			</div>
  			<div class="panel-body" id="asignar-panel">

  				<div class="section-header">
  					<form action="{{action('EstudianteController@guardar')}}" method="post">
  					<div class="col-sm-3">
  						<label for="nivel">Nivel:</label>
	  					<select class="form-control" id="nivel" name="nivel">
		  					@for ($i = 0; $i < 11; $i++)
					  		<option value="{{$i+1}}">{{$i+1}}° Grado</option>
					  		@endfor
						</select>
					</div>
					<div class="col-sm-3">
						<label for="seccion">Secci&oacute;n:</label>
	   					<select class="form-control" id="seccion" name="seccion">
	      					<option value="1">Seccion A</option>
						  	<option value="2">Seccion B</option>
						  	<option value="3">Seccion C</option>
						</select>
	   		 		</div>
		   		 	<div class="col-sm-3">
						<label for="genero">Genero:</label>
		   				<select class="form-control" id="genero" name="genero">
						  	<option value="1">Masculino</option>
						  	<option value="2">Femenino</option>
						</select>
		   		 	</div>
		   		 	<div class="col-sm-3">
						<button type="submit" class="btn btn-info">Buscar</button>
		   		 	</div>
	   		 	</div>

			    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" id="estudiante">
			      	<thead>
			        	<tr>
			          		<th></th>
			          		<th>Estudiante</th>
			          		<th>Carnet</th>
			        	</tr>
			      	</thead>
			      	<tbody>
			      </tbody>
			    </table>
			</div>
  		</div>

  		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<span class="glyphicon glyphicon-plus-sign" id="crear-icon"></span>
					Agregar de Familia
				</h3>
			</div>
  			<div class="panel-body" id="crear-section" style="display:none;">
			    <div class="form-group">
		    		<label for="apellido-padre" class="col-sm-3 control-label">Primer Apellido del Padre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="apellido-padre" name="apellido-padre" placeholder="Primer Apellido del Padre">
		   		 	</div>
		  		</div>
		  		<div style="margin-top:50px;"></div>
		  		<div class="form-group">
		    		<label for="apellido-madre" class="col-sm-3 control-label">Primer Apellido de la Madre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="apellido-madre" name="apellido-madre" placeholder="Primer Apellido de la Madre">
		   		 	</div>
		  		</div>
			</div> 
		</div>

		<div class="form-group">
    		<div class="col-sm-12 ">
      			<button type="submit" class="btn btn-primary pull-right">Continuar</button>
    		</div>
  		</div>

	</form>
 	</div>

</div>
@stop

@section('js')
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#example').dataTable();

	$(document).on('click', '#asignar-icon', function(){
		$('#asignar-panel').toggle('slow');
		if( $(this).attr('class') == 'glyphicon glyphicon-plus-sign')
			$(this).attr('class', 'glyphicon glyphicon-minus-sign');
		else
			$(this).attr('class', 'glyphicon glyphicon-plus-sign');
	});

	$(document).on('click', '#crear-icon', function(){
		$('#crear-section').toggle('slow');
		if( $(this).attr('class') == 'glyphicon glyphicon-plus-sign')
			$(this).attr('class', 'glyphicon glyphicon-minus-sign');
		else
			$(this).attr('class', 'glyphicon glyphicon-plus-sign');
	});

});
</script>
@stop