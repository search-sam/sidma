@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 sidebar bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
	<ul class="nav bs-docs-sidenav">
		<li><a href="#guardar"><b>Agregar Familia</b></a></li>
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
						  	<option value="0">Masculino</option>
						  	<option value="1">Femenino</option>
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
		      				@foreach (Util::$meses as $j => $mes)
						  	<option value="{{$j}}">{{$mes}}</option>
						  	@endforeach
						</select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="anyo" class="col-sm-3 control-label">A&ntilde;o de Nacimiento:</label>
		   			<div class="col-sm-9">
		   				<select class="form-control" id="anyo" name="anyo" >
		      				@for ($i = (date('Y')-20); $i <= date('Y'); $i++)
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

  		<div id="guardar" class="form-group">
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

      			<div class="modal-footer">
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        			<button type="button" class="btn btn-success" id="asignar" data-dismiss="modal">Asignar</button>
      			</div>
    		</div>
  		</div>
	</div>

</div>
@stop

@section('js')
<script src="{{URL::to('/')}}/js/croppic.min.js"></script>
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
</script>
@stop



