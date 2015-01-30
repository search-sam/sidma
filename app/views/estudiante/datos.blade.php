@extends('layouts.home')

@section('css')
@stop

@section('side')
<div class="col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 sidebar bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
	<ul class="nav bs-docs-sidenav">
		<li><a href="#acedemica"><b>Informaci&oacute;n Academica</b></a></li>
		<li><a href="#administrativa"><b>Informaci&oacute;n Administrativa</b></a></li>
		<li><a href="#medica"><b>Informaci&oacute;n Medica</b></a></li>
		<li><a href="#documentos"><b>Documentos</b></a></li>
		<li><a href="#guardar"><b>Guardar</b></a></li>
		<li><a href="#inicio"><b>Inicio</b></a></li>	
	</ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-md-10 main">
	<h1 class="page-header">Informaci&oacute;n del Estudiante</h1>
	<form action="{{action('EstudianteController@guardardatos')}}" method="post" class="form-horizontal" role="form">
		<input value="{{$id}}" type="text" style="display:none" name="estudiante_id">
		{{-- Informacion Academica --}}
		<div id="acedemica" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n Acedemica</h3>
			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label for="checkbox" class="col-sm-3 control-label">¿A estudiado antes?</label>
		   			<div class="col-sm-9">
			   			<input type="checkbox" name="estudiado" id="checkbox" value="1">
		   		 	</div>
		  		</div>

		  		{{-- Colegio anterior --}}
		  		<div id="antes" style="display:none;">
		  			<div class="form-group">
			    		<label for="grado" class="col-sm-3 control-label">¿A que grado va el alumno?</label>
			   			<div class="col-sm-9">
							<select class="form-control" id="grado" name="grado">
							  	@foreach ($grados as $grado)
							  	<option value="{{$grado->cod_level}}">
								  	@if ($grado->level_name == 'PK-2')
								  		Pre-Kinder 2 A&ntilde;o
								  	@elseif ($grado->level_name == 'PK-3')
								  		Pre-Kinder 3 A&ntilde;o
								  	@elseif ($grado->level_name == 'K')
								  		Kinder
								  	@else 
										{{$grado->level_name}}&deg; Grado
								  	@endif
							  	</option>
							  	@endforeach
							</select>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="colegio" class="col-sm-3 control-label">Colegio del que proviene el estudiante:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="colegio" name="colegio" placeholder="Colegio">
			      			<span class="help-block">No Aplica si el alumno no ha asistido al colegio.</span>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="col-pais" class="col-sm-3 control-label">Cuidad del colegio al que asistio el estudiante:</label>
			   			<div class="col-sm-9">
			   				<input type="text" class="form-control" id="col-pais" name="col-pais" placeholder="Ciudad">
			      			<span class="help-block">Pa&iacute;s en caso que quede fuera de Nicaragua.</span>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="grados" class="col-sm-3 control-label">Grados/A&ntilde;os que curso el estudiante:</label>
			   			<div class="col-sm-9">
			   				<span class="help-block">Seleccionar todos los grados que estudió en ese colegio.</span>
			   				@foreach ($grados as $grado)
			      			<label class="checkbox-inline">
	  							<input type="checkbox" name="cursos[]" class="elemento" value="{{$grado->cod_level}}"> 
							  	@if ($grado->level_name == 'PK-2')
							  		Pre-Kinder 2 A&ntilde;o
							  	@elseif ($grado->level_name == 'PK-3')
							  		Pre-Kinder 3 A&ntilde;o
							  	@elseif ($grado->level_name == 'K')
							  		Kinder
							  	@else 
							  		{{$grado->level_name}}&deg; Grado
							  	@endif
							</label>
							@endforeach
			   		 	</div>
			  		</div>
				  		<div class="form-group">
			    		<label for="num-casa" class="col-sm-3 control-label">Motivo por el que el Alumno está cambiando de Colegio:</label>
			   			<div class="col-sm-9">
			   				<span class="help-block">Puede seleccionar varias opciones.</span>
							@foreach (Util::$motivo as $i => $l)
			      			<label class="checkbox-inline">
	  							<input type="checkbox" id="grados" name="cambios[]" value="{{$i}}"> {{$l}}
							</label>
							@endforeach
			   		 	</div>
			  		</div>
		  		</div>
		  		{{-- -------------------------------------------------- --}}
		  		
		  		<div class="form-group">
		    		<label for="num-casa" class="col-sm-3 control-label">¿Por qu&eacute; escogi&oacute; el Angloameriacano?</label>
		   			<div class="col-sm-9">
		   				<span class="help-block">Puede seleccionar varias opciones.</span>
						@foreach (Util::$escogio as $i => $l)
		      			<label class="checkbox-inline">
  							<input type="checkbox" id="grados" name="escogio[]" value="{{$i}}"> {{$l}}
						</label>
						@endforeach
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="num-casa" class="col-sm-3 control-label">¿C&oacute;mo escuch&oacute; del Angloamericano?</label>
		   			<div class="col-sm-9">
		   				<span class="help-block">Puede seleccionar varias opciones.</span>
						@foreach (Util::$escucho as $i => $l)
		      			<label class="checkbox-inline">
  							<input type="checkbox" name="saber[]" value="{{$i}}"> {{$l}}
						</label>
						@endforeach
		   		 	</div>
		   		</div>
  			</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Informacion Administrativa --}}
		<div id="administrativa" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n Administrativa</h3>
			</div>
  			<div class="panel-body">
    			<div class="form-group">
		    		<label for="tutor" class="col-sm-3 control-label">¿Con quien vive el estudiante?</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="tutor" name="tutor">
		   					@foreach (Util::$tutor as $indice => $valor)
						  	<option value="{{$indice}}">{{$valor}}</option>
							@endforeach
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="pago" class="col-sm-3 control-label">¿Quien es el responsable del pago de aranceles?</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="pago" name="pago">
		   					@foreach (Util::$tutor as $indice => $valor)
						  	<option value="{{$indice}}">{{$valor}}</option>
							@endforeach
						</select>
		   		 	</div>
		  		</div>
		  	</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Informacion Medica --}}
		<div id="medica" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n Medica</h3>
			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label for="alergia" class="col-sm-3 control-label">Alergias comunes:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="alergia" name="alergia" placeholder="Alergias">
		      			<span class="help-block">Si es mas de una por favor separelas con comas.</span>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="medicamento" class="col-sm-3 control-label">Alergia a medicamentos:</label>
		   			<div class="col-sm-9">
		   				<input type="text" class="form-control" id="medicamento" name="medicamento" placeholder="Medicamentos">
		      			<span class="help-block">Si es mas de una por favor separelas con comas.</span>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="impedimento" class="col-sm-3 control-label">Impedimento f&iacute;sico:</label>
		   			<div class="col-sm-9">
		   				<input type="text" class="form-control" id="impedimento" name="impedimento" placeholder="Impedimento">	
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="enfermedad" class="col-sm-3 control-label">Enfermedades permanentes:</label>
		   			<div class="col-sm-9">
		   				<input type="text" class="form-control" name="enfermedad" id="enfermedad" placeholder="Enfermedad">
		   				<span class="help-block">Si es mas de una por favor separelas con comas.</span>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="emergencia" class="col-sm-3 control-label">N&uacute;mero de emergencia</label>
		   		 	<div class="col-sm-9">
		   				<input type="text" class="form-control" id="emergencia" name="emergencia" placeholder="Telefono">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="comentario" class="col-sm-3 control-label">Comentario:</label>
		   		 	<div class="col-sm-9">
		   				<textarea class="form-control" rows="3" id="comentario" name="comentario"></textarea>
		   		 	</div>
		  		</div>
		  	</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Documentos --}}
		<div id="documentos" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n Documentos</h3>
			</div>
  			<div class="panel-body">
    			{{-- Documentos Academicos --}}
  				<div class="form-group">
		    		<label for="partida" class="col-sm-3 control-label">Partida de Nacimiento:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="partida" name="partida" value="1">
		   		 	</div>
		  		</div>
  				<div class="form-group">
		    		<label for="conducta" class="col-sm-3 control-label">Certificado de Conducta:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="conducta" name="conducta" value="1">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="solvencia" class="col-sm-3 control-label">Solvencia de pago:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="solvencia" name="solvencia" value="1">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="seguro" class="col-sm-3 control-label">Seguro escolar:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="seguro" name="seguro" value="1">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="compromiso-tutor" class="col-sm-3 control-label">Compromiso del tutor:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="compromiso-tutor" name="compromiso-tutor" value="1">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="compromiso-estudiante" class="col-sm-3 control-label">Compromiso del estudiante:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="compromiso-estudiante" name="compromiso-estudiante" value="1">
		   		 	</div>
		  		</div>
		  		{{-- -------------------------------------------------- --}}

		  		<div style="border-bottom: 1px solid #eee;"></div>

		  		{{-- Documentos Administrativos --}}
		  		<div class="form-group">
		    		<label for="plan-pago" class="col-sm-3 control-label">Plan de pago:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="plan-pago" name="plan-pago" value="1">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="contrato" class="col-sm-3 control-label">Contrato de la escuela:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="contrato" name="contrato" value="1">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="transporte" class="col-sm-3 control-label">Transporte escolar:</label>
		   			<div class="col-sm-9 checkbox-inline">
  						<input type="checkbox" id="transporte" name="transporte" value="1">
		   		 	</div>
		  		</div>
		  		{{-- -------------------------------------------------- --}}
		  	</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		<div id="guardar" class="form-group">
    		<div class="col-sm-12 ">
      			<button type="submit" class="btn btn-primary pull-right">Continuar</button>
    		</div>
  		</div>
	</form>

</div>
@stop

@section('js')
<script>
$(document).ready(function(){
	$(document).on('change', '#pago', function(){
		if($('#pago option:selected').val() == 5) $('#pago-input').show();
		else $('#pago-input').hide();
	});

	$(document).on('click', '#grado-check', function(){
		if($(this).is(':checked')) $('#grado-input').removeAttr('disabled');
        else $('#grado-input').attr('disabled','disabled');  
	});

	$(document).on('click', '#asignar', function(){
		$('#asignar-familia').val($('input[name=cod-familia]:checked').val());
	});

	$(document).on('click', '#grado', function(){
		var limite = $('#grado option:selected').val();
		$('.elemento').each(function(i, elem){
			if(parseInt($(elem).val()) > limite){
			 	$(elem).attr('disabled','disabled');
			} else {
				$(elem).removeAttr('disabled');
			}
		});
	});

	$(document).on('click', '#checkbox', function(){
		$('#antes').toggle('slow');
	});
});
</script>
@stop



