@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/docs.css" rel="stylesheet">
@stop

@section('side')
<div class="col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 sidebar bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
	<ul class="nav bs-docs-sidenav">
		<li><a href="#guardar"><b>Gardar</b></a></li>
		<li><a href="#inicio"><b>Inicio</b></a></li>	
	</ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-md-10 main">
	<h1 class="page-header">Editar Informaci&oacute;n del Estudiante</h1>
    <div class="">
		<!-- Pestañas -->
		<ul class="nav nav-tabs" role="tablist">
		  	<li class="active"><a href="#estudiante">Informacion del Estudiante</a></li>
		  	<li><a href="#academica">Informacion Academica</a></li>
		  	<li><a href="#administrativa">Inforamcion Administrativa</a></li>
		  	<li><a href="#medica">Informacion Medica</a></li>
		  	<li><a href="#documentos">Documentos</a></li>
		</ul>

		<!-- Paneles -->
		<div class="tab-content">
			<form action="{{action('EstudianteController@actulizar')}}" method="post" class="form-horizontal" role="form">
				<input type="text" name="estudiante_id" id="estudiante_id" value="{{$estudiante->cod_student}}" style="display:none;"/>
	  			<div class="tab-pane active" id="estudiante">
	    			{{-- Informacion del Estudiante --}}
			  		<div class="form-group">
			    		<label for="nombre1" class="col-sm-3 control-label">Primer nombre:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer Nombre" value="{{$estudiante->first_name}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="nombre2" class="col-sm-3 control-label">Segundo nombre:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="nombre2"  name="nombre2" placeholder="Segundo Nombre" value="{{$estudiante->second_name}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="apellido1" class="col-sm-3 control-label">Primer apellido:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" value="{{$estudiante->first_last_name}}">
			    		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="apellido2" class="col-sm-3 control-label">Segundo apellido:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Nombre" value="{{$estudiante->second_last_name}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="genero" class="col-sm-3 control-label">Genero:</label>
			   			<div class="col-sm-9">
			   				<select class="form-control" id="genero" name="genero" >
							  	<option {{$estudiante->student_gender==0?'selected':''}} value="0">Masculino</option>
							  	<option {{$estudiante->student_gender==1?'selected':''}} value="1">Femenino</option>
							</select>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="correo" class="col-sm-3 control-label">Email:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="correo" name="correo" placeholder="Email" value="{{$estudiante->email}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			  			<label for="correo" class="col-sm-3 control-label">Foto:</label>
			  			<div class="col-lg-3 ">
							<div id="cropContaineroutput">
								<img class="croppedImg" src="{{$estudiante->student_photo}}">
							</div>
							<input type="text" id="cropOutput" name="foto" style="display:none;"/>
						</div>
			  		</div>
	  		
	  				<div class="form-group">
			    		<label for="dia" class="col-sm-3 control-label">D&iacute;a de Nacimiento:</label>
			   			<div class="col-sm-9">
			   				<select class="form-control" id="dia" name="dia" >
			      				@for ($i = 0; $i < 31; $i++)
							  	<option {{date('j',$estudiante->birth_date)==($i+1)?'selected':''}} value="{{$i+1}}">{{$i+1}}</option>
							  	@endfor
							</select>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="mes" class="col-sm-3 control-label">Mes de Nacimiento:</label>
			   			<div class="col-sm-9">
			   				<select class="form-control" id="mes" name="mes" >
			      				@foreach (Util::$meses as $j => $mes)
							  	<option {{date('n',$estudiante->birth_date)==$j?'selected':''}} value="{{$j}}">{{$mes}}</option>
							  	@endforeach
							</select>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="anyo" class="col-sm-3 control-label">A&ntilde;o de Nacimiento:</label>
			   			<div class="col-sm-9">
			   				<select class="form-control" id="anyo" name="anyo" >
			      				@for ($i = 1990; $i <= date('Y'); $i++)
							  	<option {{date('Y',$estudiante->birth_date)==$i?'selected':''}} value="{{$i}}">{{$i}}</option>
							  	@endfor
							</select>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="nacimiento-pais" class="col-sm-3 control-label">Pa&iacute;s de Nacimiento:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="nacimiento-pais" name="nacimiento-pais" placeholder="Pa&iacute;s" value="{{$estudiante->birth_country}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="nacimiento-ciudad" class="col-sm-3 control-label">Ciudad de Nacimiento:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="nacimiento-ciudad" name="nacimiento-ciudad" placeholder="Ciudad" value="{{$estudiante->birth_city}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="ciudad-casa" class="col-sm-3 control-label">Cuidad:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="ciudad-casa" name="ciudad-casa" placeholder="Ciudad" value="{{$estudiante->city_live}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="barrio" class="col-sm-3 control-label">Barrio/Reparto:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio/Reparto" value="{{$estudiante->neighborhood_live}}">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="dir" class="col-sm-3 control-label">Direcci&oacute;n exacta:</label>
			   			<div class="col-sm-9">
			   				<textarea class="form-control" rows="3"id="dir" name="dir" placeholder="Direcci&oacute;n">{{$estudiante->address_detail}}</textarea>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="num-casa" class="col-sm-3 control-label">N&uacute;mero de casa:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="num-casa" name="num-casa" placeholder="N° Casa" value="{{$estudiante->house_number}}">
			   		 	</div>
			  		</div>
		  			{{-- ==================================================================================================== --}}
	  			</div>
	  			<div class="tab-pane" id="academica" style="display:none;">
	    			{{-- Informacion Academica --}}
	  				<div class="form-group">
			    		<label for="grado" class="col-sm-3 control-label">¿A que grado va el alumno?</label>
			   			<div class="col-sm-9">
							<select class="form-control" id="grado" name="grado">
							  	@foreach ($grados as $grado)
							  	<option {{$estudiante->academica->level_course==$grado->cod_level?'selected':''}} value="{{$grado->cod_level}}">
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
			    		<label for="checkbox" class="col-sm-3 control-label">¿A estudiado antes?</label>
			   			<div class="col-sm-9">
				   			<input type="checkbox" name="estudiado" id="checkbox" {{$estudiante->academica->studied_before==1?'checked':''}} value="1">
			   		 	</div>
			  		</div>
			  		{{-- Colegio anterior --}}
			  		<div id="antes" {{$estudiante->academica->studied_before==1?'':'style="display:none;"'}}>
				  		<div class="form-group">
				    		<label for="colegio" class="col-sm-3 control-label">Colegio del que proviene el estudiante:</label>
				   			<div class="col-sm-9">
				      			<input type="text" class="form-control" id="colegio" name="colegio" placeholder="Colegio" value="{{$estudiante->academica->last_school}}">
				      			<span class="help-block">No Aplica si el alumno no ha asistido al colegio.</span>
				   		 	</div>
				  		</div>
				  		<div class="form-group">
				    		<label for="col-pais" class="col-sm-3 control-label">Cuidad del colegio al que asistio el estudiante:</label>
				   			<div class="col-sm-9">
				   				<input type="text" class="form-control" id="col-pais" name="col-pais" placeholder="Ciudad" value="{{$estudiante->academica->city_last_school}}">
				      			<span class="help-block">Pa&iacute;s en caso que quede fuera de Nicaragua.</span>
				   		 	</div>
				  		</div>
				  		<div class="form-group">
				    		<label for="grados" class="col-sm-3 control-label">Grados/A&ntilde;os que curso el estudiante:</label>
				   			<div class="col-sm-9">
				   				<span class="help-block">Seleccionar todos los grados que estudió en ese colegio.</span>
				   				@foreach ($grados as $grado)
				      			<label class="checkbox-inline">
		  							<input type="checkbox" name="cursos[]" value="{{$grado->cod_level}}" class="elemento"> 
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
		    					<div class="input-group">
		      						<span class="input-group-addon">
		        						<input type="checkbox" id="curso-check"> Otro
		      						</span>
		      						<input type="text" class="form-control" id="curso-input" name="cursos[]" disabled>	
		    					</div>
				   		 	</div>
				  		</div>
			  		</div>
			  		{{-- -------------------------------------------------- --}}
			  		<div class="form-group">
			    		<label for="num-casa" class="col-sm-3 control-label">Motivo por el que el Alumno está cambiando de Colegio:</label>
			   			<div class="col-sm-9">
			   				<span class="help-block">Puede seleccionar varias opciones.</span>
							@foreach (Util::$motivo as $i => $l)
			      			<label class="checkbox-inline">
	  							<input type="checkbox" id="grados" name="cambios[]" value="{{$i}}"> {{$l}}
							</label>
							@endforeach
							<div class="input-group">
	  							<span class="input-group-addon">
	    							<input type="checkbox" id="cambio-check"> Otro
	  							</span>
	  							<input type="text" class="form-control" name="cambios[]" id="cambio-input" disabled>	
							</div>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="num-casa" class="col-sm-3 control-label">¿Por qu&eacute; escogi&oacute; el Angloameriacano?</label>
			   			<div class="col-sm-9">
			   				<span class="help-block">Puede seleccionar varias opciones.</span>
							@foreach (Util::$escogio as $i => $l)
			      			<label class="checkbox-inline">
	  							<input type="checkbox" id="grados" name="escogio[]" value="{{$i}}"> {{$l}}
							</label>
							@endforeach
							<div class="input-group">
	  							<span class="input-group-addon">
	    							<input type="checkbox" id="escogio-check"> Otro
	  							</span>
	  							<input type="text" class="form-control" id="escogio-input" name="escogio[]" disabled>	
							</div>
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
							<div class="input-group">
	  							<span class="input-group-addon">
	    							<input type="checkbox" id="grado-check"> Otro
	  							</span>
	  							<input type="text" class="form-control" id="grado-input" name="saber[]" disabled>	
							</div>
			   		 	</div>
			   		</div>
			  		{{-- ==================================================================================================== --}}
	  			</div>
	  			<div class="tab-pane" id="administrativa" style="display:none;">
	  				{{-- Informacion Administrativa --}}
	    			<div class="form-group">
			    		<label for="tutor" class="col-sm-3 control-label">¿Con quien vive el estudiante?</label>
			   			<div class="col-sm-9">
			   				<select class="form-control" id="tutor" name="tutor">
			   					@foreach (Util::$tutor as $indice => $valor)
							  	<option {{$estudiante->administrativa->whom_student_live==$indice?'selected':''}} value="{{$indice}}">{{$valor}}</option>
								@endforeach
							</select>
							<div id="tutor-input"
								@if($estudiante->administrativa->whom_student_live!=5)
							  		style="display:none;"
							  	@endif
							>
								<br/>
								<input type="text" class="form-control" name="tutor" placeholder="Otro" value="
									@if($estudiante->administrativa->whom_student_live==5)
							  			{{$estudiante->administrativa->whom_student_live}}
							  		@endif 
								">
							</div>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="pago" class="col-sm-3 control-label">¿Quien es el responsable del pago de aranceles?</label>
			   			<div class="col-sm-9">
			   				<select class="form-control" id="pago" name="Pago">
			   					@foreach ($tutor as $indice => $valor)
							  	<option {{$estudiante->administrativa->payment_responsable==$indice?'selected':''}} value="{{$indice}}">{{$valor}}</option>
								@endforeach
							</select>
							<div id="pago-input"
								@if($estudiante->administrativa->payment_responsable!=5)
							  		style="display:none;"
							  	@endif
							>
								<br/>
								<input type="text" class="form-control" name="pago" placeholder="Otro" value="
									@if($estudiante->administrativa->payment_responsable==5)
							  			{{$estudiante->administrativa->payment_responsable}}
							  		@endif
								">
							</div>
			   		 	</div>
			  		</div>
			  		{{-- ==================================================================================================== --}}
	  			</div>
	  			<div class="tab-pane" id="medica" style="display:none;">
	  				{{-- Informacion Medica --}}
	  				<div class="form-group">
			    		<label for="alergia" class="col-sm-3 control-label">Alergias comunes:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="alergia" name="alergia" placeholder="Alergias" value="{{$estudiante->medica->common_allergie}}">
			      			{{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="medicamento" class="col-sm-3 control-label">Alergia a medicamentos:</label>
			   			<div class="col-sm-9">
			   				<input type="text" class="form-control" id="medicamento" name="medicamento" placeholder="Medicamentos" value="{{$estudiante->medica->medicine_allergie}}">
			      			{{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="impedimento" class="col-sm-3 control-label">Impedimento f&iacute;sico:</label>
			   			<div class="col-sm-9">
			   				<input type="text" class="form-control" id="impedimento" name="impedimento" placeholder="Impedimento" value="{{$estudiante->medica->physical_impediment}}">	
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="enfermedad" class="col-sm-3 control-label">Enfermedades permanentes:</label>
			   			<div class="col-sm-9">
			   				<input type="text" class="form-control" name="enfermedad" id="enfermedad" placeholder="Enfermedad" value="{{$estudiante->medica->permanet_illness}}">
			   				{{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="emergencia" class="col-sm-3 control-label">N&uacute;mero de emergencia</label>
			   		 	<div class="col-sm-9">
			   				<input type="text" class="form-control" id="emergencia" name="emergencia" placeholder="Telefono" value="{{$estudiante->medica->emergency_cal}}">
			   				<br>
			   				<input type="text" class="form-control" name="emergencia-nombre" placeholder="Nombre">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="comentario" class="col-sm-3 control-label">Comentario:</label>
			   		 	<div class="col-sm-9">
			   				<textarea class="form-control" rows="3" id="comentario" name="comentario">{{$estudiante->medica->comment}}</textarea>
			   		 	</div>
			  		</div>
			  		{{-- ==================================================================================================== --}}
	  			</div>
	  			<div class="tab-pane" id="documentos" style="display:none;">
	  				{{-- Documentos --}}
	    			{{-- Documentos Academicos --}}
	  				<div class="form-group">
			    		<label for="partida" class="col-sm-3 control-label">Partida de Nacimiento:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="partida" name="partida" value="1" {{$estudiante->academica->birth_certificate==1?'checked':''}}>
			   		 	</div>
			  		</div>
	  				<div class="form-group">
			    		<label for="conducta" class="col-sm-3 control-label">Certificado de Conducta:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="conducta" name="conducta" value="1" {{$estudiante->academica->good_standing==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="solvencia" class="col-sm-3 control-label">Solvencia de pago:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="solvencia" name="solvencia" value="1" {{$estudiante->academica->payment_solvency==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="seguro" class="col-sm-3 control-label">Seguro escolar:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="seguro" name="seguro" value="1" {{$estudiante->academica->insurance_student==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="compromiso-tutor" class="col-sm-3 control-label">Compromiso del tutor:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="compromiso-tutor" name="compromiso-tutor" value="1" {{$estudiante->academica->tutor_compromise_signature==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="compromiso-estudiante" class="col-sm-3 control-label">Compromiso del estudiante:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="compromiso-estudiante" name="compromiso-estudiante" value="1" {{$estudiante->academica->student_compromise_signature==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		{{-- -------------------------------------------------- --}}

			  		<div style="border-bottom: 1px solid #eee;"></div>

			  		{{-- Documentos Administrativos --}}
			  		<div class="form-group">
			    		<label for="plan-pago" class="col-sm-3 control-label">Plan de pago:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="plan-pago" name="plan-pago" value="1" {{$estudiante->administrativa->payment_plan_signature==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="contrato" class="col-sm-3 control-label">Contrato de la escuela:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="contrato" name="contrato" value="1" {{$estudiante->administrativa->school_contract_signature==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="transporte" class="col-sm-3 control-label">Transporte escolar:</label>
			   			<div class="col-sm-9 checkbox-inline">
	  						<input type="checkbox" id="transporte" name="transporte" value="1" {{$estudiante->administrativa->transport_take==1?'checked':''}}>
			   		 	</div>
			  		</div>
			  		{{-- -------------------------------------------------- --}}
			  		{{-- ==================================================================================================== --}}
	  			</div>
			</div>
			<div class="form-group" style="margin-top:50px;">
	    		<div id="guardar" class="col-sm-12 ">
	      			<button type="submit" class="btn btn-success pull-right">Guardar</button>
	    		</div>
	  		</div>
		</form>
	</div>

</div>
@stop

@section('js')
<script src="{{URL::to('/')}}/js/croppic.min.js"></script>
<script type="text/javascript">
var croppicContaineroutputOptions = {
	uploadUrl:'img_save_to_file.php',
	cropUrl:'img_crop_to_file.php', 
	outputUrlId:'cropOutput',
	modal:false,
	loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
}
var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);

$(document).ready(function() {
	$(document).on('click', '.nav-tabs a', function(){
		var id = $(this).attr('href');
		$('.tab-pane').each(function(index, element){
			$(element).removeClass('active');
			$(element).hide();
		});
		$(id).addClass('active');
		$(id).show();
		$('.nav-tabs li').each(function(index, element){
			$(element).removeClass('active');
		});
		$(this).parent('li').addClass('active');
	});

	$(document).on('change', '#tutor', function(){
		if($('#tutor option:selected').val() == 5) $('#tutor-input').show();
		else $('#tutor-input').hide();
	});

	$(document).on('change', '#pago', function(){
		if($('#pago option:selected').val() == 5) $('#pago-input').show();
		else $('#pago-input').hide();
	});

	$(document).on('click', '#curso-check', function(){
		if($(this).is(':checked')) $('#curso-input').removeAttr('disabled');
        else $('#curso-input').attr('disabled','disabled');  
	});

	$(document).on('click', '#cambio-check', function(){
		if($(this).is(':checked')) $('#cambio-input').removeAttr('disabled');
        else $('#cambio-input').attr('disabled','disabled');
	});

	$(document).on('click', '#escogio-check', function(){
		if($(this).is(':checked')) $('#escogio-input').removeAttr('disabled');
        else $('#escogio-input').attr('disabled','disabled');  
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