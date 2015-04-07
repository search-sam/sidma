@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
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
<div class="col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 sidebar bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
	<ul class="nav bs-docs-sidenav">
		<li><a href="#guardar"><b>Guardar</b></a></li>
		<li><a href="#inicio"><b>Inicio</b></a></li>	
	</ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-md-10 main">
	<h1 class="page-header">Nuevo Estudiante</h1>
	<form action="{{action('EstudianteController@guardar')}}" method="post" class="form-horizontal" role="form">
		<input type="text" name="familia" id="asignar-familia" style="display:none;"/>

		{{-- Informacion del Estudiante --}}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n del Estudiante</h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="nombre1" class="col-sm-3 control-label">Primer nombre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer Nombre" >
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
		      			<input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" >
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
		   				<select class="form-control" id="genero" name="genero" >
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
  		
  				<div class="form-group">
		    		<label for="dia" class="col-sm-3 control-label">D&iacute;a de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="dia" name="dia" >
		      				@for ($i = 0; $i < 31; $i++)
						  	<option value="{{$i+1}}">{{$i+1}}</option>
						  	@endfor
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="mes" class="col-sm-3 control-label">Mes de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="mes" name="mes" >
		      				@foreach ($meses as $j => $mes)
						  	<option value="{{$j}}">{{$mes}}</option>
						  	@endforeach
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="anyo" class="col-sm-3 control-label">A&ntilde;o de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="anyo" name="anyo" >
		      				@for ($i = 1990; $i <= date('Y'); $i++)
						  	<option value="{{$i}}">{{$i}}</option>
						  	@endfor
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="nacimiento-pais" class="col-sm-3 control-label">Pa&iacute;s de Nacimiento:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nacimiento-pais" name="nacimiento-pais" placeholder="Pa&iacute;s" >
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="nacimiento-ciudad" class="col-sm-3 control-label">Ciudad de Nacimiento:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="nacimiento-ciudad" name="nacimiento-ciudad" placeholder="Ciudad" >
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="ciudad-casa" class="col-sm-3 control-label">Cuidad:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="ciudad-casa" name="ciudad-casa" placeholder="Ciudad" >
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="barrio" class="col-sm-3 control-label">Barrio/Reparto:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio/Reparto" >
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="dir" class="col-sm-3 control-label">Direcci&oacute;n exacta:</label>
		   			<div class="col-sm-9">
		   				<textarea class="form-control" rows="3"id="dir" name="dir" placeholder="Direcci&oacute;n" ></textarea>
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
  		{{-- ==================================================================================================== --}}

  		{{-- Informacion Academica --}}
  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Informac&oacute;n Acad&eacute;mica</h3>
  			</div>
  			<div class="panel-body">
  				<div class="form-group">
		    		<label for="grado" class="col-sm-3 control-label">¿Último grado que cursó?</label>
		   			<div class="col-sm-9">
						<select class="form-control" id="grado" name="grado" >
						  	@foreach ($grados as $grado)
						  	<option value="{{$grado->cod_level}}">
							  	<?php
							  	if ($grado->level_name == 'PK-2')
							  		echo 'Pre-Kinder 2 A&ntilde;o';
							  	elseif ($grado->level_name == 'PK-3')
							  		echo 'Pre-Kinder 3 A&ntilde;o';
							  	elseif ($grado->level_name == 'K')
							  		echo 'Kinder';
							  	else echo $grado->level_name.'&deg; Grado';
							  	?>
						  	</option>
						  	@endforeach
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="checkbox" class="col-sm-3 control-label">¿A estudiado antes?</label>
		   			<div class="col-sm-9">
			   			<input type="checkbox" name="estudiado" id="checkbox" value="1">
		   		 	</div>
		  		</div>
		  		{{-- Colegio anterior --}}
		  		<div id="antes" style="display:none;">
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
	  							<input type="checkbox" name="cursos[]" value="{{$grado->cod_level}}" class="elemento"> 
	  							<?php
							  	if ($grado->level_name == 'PK-2')
							  		echo 'Pre-Kinder 2 A&ntilde;o';
							  	elseif ($grado->level_name == 'PK-3')
							  		echo 'Pre-Kinder 3 A&ntilde;o';
							  	elseif ($grado->level_name == 'K')
							  		echo 'Kinder';
							  	else echo $grado->level_name.'&deg; Grado';
							  	?>
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
  		{{-- ==================================================================================================== --}}

  		{{-- Informacion Administrativa --}}
  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Informaci&oacute;n Administrativa</h3>
  			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="tutor" class="col-sm-3 control-label">¿Con quien vive el estudiante?</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="tutor" name="tutor" >
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
		    		<label for="pago" class="col-sm-3 control-label">¿Quien es el responsable del pago de aranceles?</label>
		   			<div class="col-sm-9">
		   				<input type="text" class="form-control" id="pago" name="pago" placeholder="Responsable">
		   		 	</div>
		  		</div>
  			</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Informacion Medica --}}
  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Informaci&oacute;n Medica</h3>
  			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="alergia" class="col-sm-3 control-label">Alergias comunes:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="alergia" name="alergia" placeholder="Alergias">
		      			{{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="medicamento" class="col-sm-3 control-label">Alergia a medicamentos:</label>
		   			<div class="col-sm-9">
		   				<input type="text" class="form-control" id="medicamento" name="medicamento" placeholder="Medicamentos">
		      			{{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
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
		   				{{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="emergencia" class="col-sm-3 control-label">En caso de emergencia llamar a:</label>
		   			<div class="col-sm-9" style="margin-bottom: 15px;">
		   				<input type="text" class="form-control" id="emergencia1" name="emergencia-nombre" placeholder="Nombre">
		   		 	</div>
		   		 	<div class="col-sm-9 col-md-offset-3">
		   				<input type="text" class="form-control" id="emergencia2" name="emergencia" placeholder="Telefono">
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
  		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Documentos</h3>
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

  		<div class="form-group">
    		<div class="col-sm-12 ">
    			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Agregar Familia</button>
      			<button type="submit" class="btn btn-primary pull-right">Continuar</button>
    		</div>
  		</div>
	</form>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        			<h4 class="modal-title" id="myModalLabel">Asignar Familia</h4>
      			</div>

      			<div class="modal-body">
        			<div class="table-responsive">
					    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
					      	<thead>
					        	<tr>
					          		<th>Familia</th>
					          		<th></th>
					        	</tr>
					      	</thead>
					      	<tbody>
					      		@foreach ($familias as $familia)
					        	<tr>
					          		<td><input type="radio" name="cod-familia" value="{{$familia->cod_family}}"/></td>
					          		<td>{{$familia->family_identity}}</td>
					        	</tr>
					        	@endforeach
					      </tbody>
					    </table>
					</div>
      			</div>

      			<div id="guardar" class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        			<button type="button" class="btn btn-primary" id="asignar" data-dismiss="modal">Asignar</button>
      			</div>
    		</div>
  		</div>
	</div>

</div>
@stop

@section('js')
<script src="{{URL::to('/')}}/js/croppic.min.js"></script>
<script src="{{URL::to('/')}}/js/main.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>

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
	$('#example').dataTable();

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



