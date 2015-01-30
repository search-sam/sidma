@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/main.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
@stop

<?php
$meses = array(
	'1' => 'Enero',
	'2' => 'Febrero',
	'3' => 'Marzo',
	'4' => 'Abril',
	'5' => 'Mayo',
	'6' => 'Junio',
	'7' => 'Julio',
	'8' => 'Agosto',
	'9' => 'Septiembre',
	'10' => 'Octubre',
	'11' => 'Noviembre',
	'12' => 'Diciembre' 
);

$motivo = array(
	'1' => 'Educaci&oacute;n Bilingüe',
	'2' => 'Mejor Calidad Acad&eacute;mica',
	'3' => 'Situaci&oacute;n Econ&oacute;mica',
	'4' => 'Problemas con Rendimiento Acad&eacute;mico',
	'5' => 'Problemas con Profesor(es)',
	'6' => 'Desacuerdo con Filosof&iacute;a del otro Colegio',
	'7' => 'Desacuerdo con Forma de Trato del otro Colegio',
	'8' => 'No quiere completar 12vo grado en el otro Colegio',
	'9' => 'Cambio de Pais',
	'10' => 'Primera vez en un Colegio',
	'11' => 'Necesita colegio con Primaria'
);

$escogio = array(
	'1' => 'Mejor Educaci&oacute;n',
	'2' => 'Idioma Ingles',
	'3' => 'Grupos Peque&ntilde;os',
	'4' => 'M&aacute;s Econ&oacute;mico',
	'5' => 'Mejor Ubicaci&oacute;n',
	'6' => 'Calidad del Personal',
	'7' => 'Calendario Internacional',
	'8' => 'Conoce a alguien que estudia en el Angloameriacano'
);

$escucho = array(
	'1' => 'Recomendación de Familiar/Amigo',
	'2' => 'Mantas',
	'3' => 'Internet',
	'4' => 'Email',
	'5' => 'Facebook',
	'6' => 'Volantes',
	'7' => 'Gu&iacute;a Telef&oacute;nica',
	'8' => 'Anuncio Revista Cine',
	'9' => 'Vendedor(a)'
);
?>

@section('side')
@parent
<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li class="active"><a href="{{action('EstudianteController@nuevo')}}">Nuevo</a></li>
		<li><a href="#">Reports</a></li>
		<li><a href="#">Analytics</a></li>
		<li><a href="#">Export</a></li>
	</ul>
</div>
@stop

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Nuevo Estudiante</h1>
	<form action="{{action('EstudianteController@guardar')}}" method="post" class="form-horizontal" role="form">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nombre del Estudiante</h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="nombre1" class="col-sm-3 control-label">Primer nombre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer Nombre" required>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="nombre2" class="col-sm-3 control-label">Segundo nombre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nombre2"  name="nombre2" placeholder="Segundo Nombre">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="apellido1" class="col-sm-3 control-label">Primer apellido:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" required>
		    		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="apellido2" class="col-sm-3 control-label">Segundo apellido:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Nombre">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="genero" class="col-sm-3 control-label">Genero:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="genero" name="genero" required>
						  	<option value="1">Masculino</option>
						  	<option value="2">Femenino</option>
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="correo" class="col-sm-3 control-label">Email:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="correo" name="correo" placeholder="Email">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		  			<label for="correo" class="col-sm-3 control-label">Foto:</label>
		  			<div class="col-lg-3 ">
						<div id="cropContaineroutput"></div>
						<input type="text" id="cropOutput" name="foto" style="display:none;"/>
					</div>
		  		</div>
  			</div>
  		</div>

  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Lugar y Fecha del Nacimiento</h3>
  			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label for="dia" class="col-sm-3 control-label">D&iacute;a de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="dia" name="dia" required>
		      				@for ($i = 0; $i < 31; $i++)
						  	<option value="{{$i+1}}">{{$i+1}}</option>
						  	@endfor
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="mes" class="col-sm-3 control-label">Mes de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="mes" name="mes" required>
		      				@foreach ($meses as $j => $mes)
						  	<option value="{{$j}}">{{$mes}}</option>
						  	@endforeach
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="anyo" class="col-sm-3 control-label">A&ntilde;o de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="anyo" name="anyo" required>
		      				@for ($i = 1990; $i <= date('Y'); $i++)
						  	<option value="{{$i}}">{{$i}}</option>
						  	@endfor
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="nacimiento-pais" class="col-sm-3 control-label">Pa&iacute;s de Nacimiento:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nacimiento-pais" name="nacimiento-pais" placeholder="Pa&iacute;s" required>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="nacimiento-ciudad" class="col-sm-3 control-label">Ciudad de Nacimiento:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nacimiento-ciudad" name="nacimiento-ciudad" placeholder="Ciudad" required>
		   		 	</div>
		  		</div>
  			</div>
  		</div>

  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Direcci&oacute;n Domiciliar</h3>
  			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label for="tutor" class="col-sm-3 control-label">¿Con quien vive el estudiante?</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="tutor" name="tutor" required>
						  	<option value="Padre y Madre">Padre y Madre</option>
						  	<option value="Padre">Padre</option>
						  	<option value="Madre">Madre</option>
						  	<option value="Otro">Otro</option>
						</select>
						<div id="tutor-input" style="display:none;">
							<br/>
							<input type="text" class="form-control" name="tutor" placeholder="Otro">
						</div>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="ciudad-casa" class="col-sm-3 control-label">Cuidad:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="ciudad-casa" name="ciudad-casa" placeholder="Ciudad" required>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="barrio" class="col-sm-3 control-label">Barrio/Reparto:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio/Reparto" required>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="dir" class="col-sm-3 control-label">Direcci&oacute;n exacta:</label>
		   			<div class="col-sm-9">
		   				<textarea class="form-control" rows="3"id="dir" name="dir" placeholder="Direcci&oacute;n" required></textarea>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="num-casa" class="col-sm-3 control-label">N&uacute;mero de casa:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="num-casa" name="num-casa" placeholder="N° Casa">
		   		 	</div>
		  		</div>
  			</div>
  		</div>

  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Datos Acad&eacmicos</h3>
  			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label for="grado" class="col-sm-3 control-label">¿A que grado va el alumno?</label>
		   			<div class="col-sm-9">
						<select class="form-control" id="grado" name="grado" required>
						  	@for ($i = 1; $i < 12; $i++)
						  	<option value="{{$i}}">{{$i}}er Grado</option>
						  	@endfor
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
		   				@for ($i = 1; $i < 12; $i++)
		      			<label class="checkbox-inline">
  							<input type="checkbox" name="cursos[]" id="cursos" value="{{$i}}"> {{$i}}er Grado
						</label>
						@endfor
    					<div class="input-group">
      						<span class="input-group-addon">
        						<input type="checkbox" id="curso-check"> Otro
      						</span>
      						<input type="text" class="form-control" id="curso-input" name="cursos[]" disabled>	
    					</div>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="num-casa" class="col-sm-3 control-label">Motivo por el que el Alumno está cambiando de Colegio:</label>
		   			<div class="col-sm-9">
		   				<span class="help-block">Puede seleccionar varias opciones.</span>
						@foreach ($motivo as $i => $l)
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
						@foreach ($escogio as $i => $l)
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
						@foreach ($escucho as $i => $l)
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
  			</div>
  		</div>

  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Transporte</h3>
  			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label class="col-sm-3 control-label">¿Utilizar&aacute; el transporte escolar?</label>
		   			<div class="col-sm-9">
			   			<div class="radio">
	  						<label>
	    						<input type="radio" name="transporte" id="optionsRadios1" value="1" required>
	    						Si
	  						</label>
						</div>
						<div class="radio">
  							<label>
    							<input type="radio" name="transporte" id="optionsRadios2" value="2" required>
    							No
  							</label>
						</div>
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
@stop

@section('js')
<script src="{{URL::to('/')}}/js/croppic.min.js"></script>
<script src="{{URL::to('/')}}/js/main.js"></script>
<script>
var croppicContaineroutputOptions = {
	uploadUrl:'img_save_to_file.php',
	cropUrl:'img_crop_to_file.php', 
	outputUrlId:'cropOutput',
	modal:false,
	loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
}
var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);
$(document).ready(function(){
	$(document).on('change', '#tutor', function(){
		if($('#tutor option:selected').text() == 'Otro') $('#tutor-input').show();
		else $('#tutor-input').hide();
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
});
</script>
@stop



