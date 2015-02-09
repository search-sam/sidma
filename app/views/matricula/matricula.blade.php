@extends('layouts.home')

@section('css')
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
                    <?php
                 
                   
                    ?>
	      		@foreach ($matriculas as $estudiante)
	        	<tr>
	          		<td>{{$estudiante->student_card}}</td>
	          		<td>
	          			{{$estudiante->first_name}}
	          			<?= empty($estudiante->second_name)?'':$estudiante->second_name; ?>
	          			{{$estudiante->first_last_name}}
	          			<?= empty($estudiante->second_last_name)?'':$estudiante->second_last_name; ?>
	          		</td>
	          		<td>
	          			<div class="btn-group">
						  	<button type="button" class="btn btn-default edit" ref="{{action('EstudianteController@editar').'?id='.$estudiante->cod_student}}"><span class="glyphicon glyphicon-edit"></span></button>
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