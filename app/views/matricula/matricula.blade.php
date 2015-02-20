@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@stop

@section('content')
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
	<h1 class="page-header">Matricula <a href="{{action('EstudianteController@nuevo')}}" class="btn btn-success">Nueva Matricula</a> </h1>
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
	      		@foreach ($matriculas as $matricula)
	        	<tr>
	          		<td>{{$matricula->student_card}}</td>
	          		<td>
	          			{{$matricula->first_name}}
	          			<?= empty($matricula->second_name)?'':$matricula->second_name; ?>
	          			{{$matricula->first_last_name}}
	          			<?= empty($matricula->second_last_name)?'':$matricula->second_last_name; ?>
	          		</td>
	          		<td>
	          			<div class="btn-group">
						  	<button type="button" class="btn btn-default edit" ref="{{action('MatriculaController@editar').'?id='.$matricula->cod_student}}"><span class="glyphicon glyphicon-edit"></span></button>
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
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#example').dataTable();

	$(document).on('click', '.edit', function(){
		$(location).attr('href', $(this).attr('ref'));
	});

});
</script>
@stop
