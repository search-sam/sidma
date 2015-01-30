@extends('layouts.home')

@section('css')
@stop

@section('side')
<div class="col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 sidebar bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
	<ul class="nav bs-docs-sidenav">
		<li><a href="#personal"><b>Informaci&oacute;n Personal</b></a></li>
		<li><a href="#domicilio"><b>Informaci&oacute;n del Domicilio</b></a></li>
		<li><a href="#laboral"><b>Informaci&oacute;n Laboral</b></a></li>
		<li><a href="#comunicacion"><b>Medio de Comunicaci&oacute;n</b></a></li>
		<li><a href="#guardar"><b>Guardar</b></a></li>
		<li><a href="#inicio"><b>Inicio</b></a></li>	
	</ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-md-10 main">
	<h1 class="page-header">Nuevo Tutor</h1>
	<form action="{{action('FamiliaController@padreguardar')}}" method="post" class="form-horizontal" role="form">

		<input type="text" id="familia" name="familia_id" value="{{$familia_id}}" style="display:none;">

		{{-- Informacion Personal --}}
		<div id="personal" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n Personal</h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="primer-nombre" class="col-sm-3 control-label">Primer nombre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="primer-nombre" name="primer-nombre" placeholder="Primer Nombre">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="segundo-nombre" class="col-sm-3 control-label">Segundo nombre:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="segundo-nombre" name="segundo-nombre" placeholder="Segundo Nombre">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="primer-apellido" class="col-sm-3 control-label">Primer apellido:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="primer-apellido" name="primer-apellido" placeholder="Primer Apellido">
		    		 </div>
		  		</div>
		  		<div class="form-group">
		    		<label for="segundo-apellido" class="col-sm-3 control-label">Segundo apellido:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="segundo-apellido" name="segundo-apellido" placeholder="Segundo Apellido">
		    		 </div>
		  		</div>
		  		<div class="form-group">
		    		<label for="relacion" class="col-sm-3 control-label">Relaci&oacute;n con el alumno:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="relacion" name="relacion" >
						  	<option value="1">Padre/Madre</option>
						  	<option value="2">Padrastro/Madrastra</option>
						  	<option value="3">Tutor Legal</option>
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="tel-convencional" class="col-sm-3 control-label">Telefono Convencional:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="tel-convencional" name="tel-convencional" placeholder="Telefono Convencional">
		    		 </div>
		  		</div>
		  		<div class="form-group">
		    		<label for="tel-celular" class="col-sm-3 control-label">Telefono Celular:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="tel-celular" name="tel-celular" placeholder="Telefono Celular">
		    		 </div>
		  		</div>
		  		<div class="form-group">
		    		<label for="tel-otro" class="col-sm-3 control-label">Otro Telefono:</label>
		   			<div class="col-sm-9">
		      			<input type="text" class="form-control" id="tel-otro" name="tel-otro" placeholder="Otro Telefono">
		    		 </div>
		  		</div>
  			</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Informaci&oacute;n Domicilio --}}
  		<div id="domicilio" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n del Domicilio</h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label class="col-sm-3 control-label">¿Vive en la misma direcci&oacute;n<br/> del alumno?</label>
		   			<div class="col-sm-9">
			   			<div class="checkbox">
	  						<label class="checkbox-inline">
	    						<input type="checkbox" id="vive"> No
	  						</label>
						</div>
		   		 	</div>
		  		</div>
		  		{{-- Datos Vivienda --}}
		  		<div id="tutor-domicilio" style="display:none;">
		  			<div class="form-group">
			    		<label for="tutor-cuidad" class="col-sm-3 control-label">Cuidad:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="tutor-cuidad" name="tutor-cuidad" placeholder="Ciudad">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="tutor-barrio" class="col-sm-3 control-label">Barrio/Reparto:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="tutor-barrio" name="tutor-barrio" placeholder="Barrio/Reparto">
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="tutor-dir" class="col-sm-3 control-label">Direcci&oacute;n exacta:</label>
			   			<div class="col-sm-9">
			   				<textarea class="form-control" rows="3"id="tutor-dir" name="tutor-dir" placeholder="Direcci&oacute;n"></textarea>
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="tutor-num-casa" class="col-sm-3 control-label">N&uacute;mero de casa:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="tutor-num-casa" name="tutor-num-casa" placeholder="N° Casa">
			   		 	</div>
			  		</div>
		  		</div>
		  		{{-- -------------------------------------------------- --}}
  			</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Informacion Laboral --}}
  		<div id="laboral" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informaci&oacute;n Laboral</h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label class="col-sm-3 control-label">¿Esta actualmente laborando?</label>
		   			<div class="col-sm-9">
			   			<div class="checkbox">
	  						<label class="checkbox-inline">
	    						<input type="checkbox" id="labora" name="labora" value="1"> Si
	  						</label>
						</div>
		   		 	</div>
		  		</div>
		  		{{-- Datos Empresa --}}
		  		<div id="tutor-laboral" style="display:none;">
		  			<div class="form-group">
			    		<label for="tutor-empresa" class="col-sm-3 control-label">Nombre de la Empresa:</label>
			   			<div class="col-sm-9">
			      			<input type="text" class="form-control" id="tutor-empresa" name="tutor-empresa" placeholder="Empresa" >
			   		 	</div>
			  		</div>
			  		<div class="form-group">
			    		<label class="col-sm-3 control-label">¿Es propietario(a) de este negocio?</label>
			   			<div class="col-sm-9">
				   			<div class="radio">
							  	<label>
							    	<input type="radio" name="propietario" id="propietario1" value="1"> Si
							  	</label>
							</div>
							<div class="radio">
							  	<label>
							    	<input type="radio" name="propietario" id="propietario2" value="0"> No
							  	</label>
							</div>
			   		 	</div>
			  		</div>
			  		{{-- Datos Propiedad --}}
			  		<div id="tutor-propietario" style="display:none;">
			  			<div class="form-group">
				    		<label for="empresa-correo" class="col-sm-3 control-label">Correo Electronico:</label>
				   			<div class="col-sm-9">
				      			<input type="text" class="form-control" id="empresa-correo" name="empresa-correo" placeholder="Correo Electronico de la Empresa" >
				   		 	</div>
				  		</div>
				  		<div class="form-group">
				    		<label for="empresa-convencional" class="col-sm-3 control-label">Telefono Convencional:</label>
				   			<div class="col-sm-9">
				      			<input type="text" class="form-control" id="empresa-convencional" name="empresa-convencional" placeholder="Telefono Convencional de la Empresa" >
				   		 	</div>
				  		</div>
				  		<div class="form-group">
				    		<label for="empresa-extension" class="col-sm-3 control-label">Extensi&oacute;n:</label>
				   			<div class="col-sm-9">
				      			<input type="text" class="form-control" id="empresa-extension" name="empresa-extension" placeholder="Extensi&oacute;n del Telefono de la Empresa">
				   		 	</div>
				  		</div>
				  		<div class="form-group">
				    		<label for="empresa-celular" class="col-sm-3 control-label">Telefono Celular:</label>
				   			<div class="col-sm-9">
				      			<input type="text" class="form-control" id="empresa-celular" name="empresa-celular" placeholder="Telefono Celular de la Empresa" >
				   		 	</div>
				  		</div>	
			  		</div>
			  		{{-- ......................... --}}
			  		<div id="tutor-no-propietario" style="display:none;">
			  			<div class="form-group">
				    		<label for="cargo" class="col-sm-3 control-label">Cargo en la Empresa:</label>
				   			<div class="col-sm-9">
				      			<input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo en la Empresa" >
				   		 	</div>
				  		</div>
			  		</div>
			  		{{-- -------------------------------------------------- --}}
		  		</div>
		  		{{-- -------------------------------------------------- --}}
  			</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		{{-- Comunicacion --}}
  		<div id="comunicacion" class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Medio de Comunicaci&oacute;n</h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="tutor-correo" class="col-sm-3 control-label">Cuenta de Correo:</label>
		   			<div class="col-sm-9">
		   				<span class="help-block">Por favor proporcione la cuenta de correo electronico a la que le enviaremos las circulares y los comunicados oficiales.</span>
		      			<input type="text" class="form-control" id="tutor-correo" name="tutor-correo" placeholder="Correo Electronico" >
		   		 	</div>
		  		</div>
  			</div>
  		</div>
  		{{-- ==================================================================================================== --}}

  		<div id="guardar" class="form-group">
    		<div class="col-sm-12 ">
    			<button type="button" ref="{{action('FamiliaController@tutoragregar')}}" class="btn btn-default" id="agregar">Agregar Nuevo</button>
      			<button type="submit" class="btn btn-primary pull-right">Continuar</button>
    		</div>
  		</div>
	</form>
</div>
@stop

@section('js')
<script>
$(document).ready(function(){
	$(document).on('click', '#vive', function(){
		$('#tutor-domicilio').toggle('slow');
	});

	$(document).on('click', '#labora', function(){
		$('#tutor-laboral').toggle('slow');
	});

	$(document).on('click', '#propietario1', function(){
		$('#tutor-propietario').toggle('slow');
		$('#tutor-no-propietario').fadeOut( "slow" );
	});

	$(document).on('click', '#propietario2', function(){
		$('#tutor-no-propietario').toggle('slow');
		$('#tutor-propietario').fadeOut( "slow" );
	});

	$(document).on('click', '#agregar', function(){
		$('form').attr('action', $(this).attr('ref'));
		$('form').submit();
	});
});
</script>
@stop


