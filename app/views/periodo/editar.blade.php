<?php
   $cod_period = isset($_REQUEST['cod_period'])?$_REQUEST['cod_period']:'';
?>
<form id="formneweditclassroom" action="{{action('PeriodoController@neworedit')}}<?= empty($cod_period)?'':"?cod_period=$periodo->cod_period"?>" method="post" class="form-horizontal" role="form">
                    <div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        			<h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_period)?'':'» Período '.$periodo->cod_period ?></h4>
      			</div>

      			<div class="modal-body">
        			   <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= empty($cod_period)?'Nuevo período':'Editar' ?></h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="nombreaula" class="col-sm-3 control-label">Nombre aula:</label>
		   			<div class="col-sm-9">
                                            <input value="<?= empty($cod_period)?'':$periodo->classroom_name ?>" type="text" class="form-control" id="nombreaula" name="nombreaula" placeholder="Nombre Aula" >
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="edificio" class="col-sm-3 control-label">Edificio:</label>
		   			<div class="col-sm-9">
		      			<input value="<?= empty($cod_period)?'':$periodo->building ?>" type="text" class="form-control" id="edifio"  name="edificio" placeholder="Edificio">
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="capacidad" class="col-sm-3 control-label">Capacidad:</label>
		   			<div class="col-sm-9">
		      			<input value="<?= empty($cod_period)?'':$periodo->capacity ?>" type="text" class="form-control" id="capacidad" name="capacidad" placeholder="Capacidad" >
		    		 	</div>
		  		</div>
                            <div class="form-group">
                         <label for="descripcion" class="col-sm-3 control-label">Descripción:</label>
		   			<div class="col-sm-9">
		      			<input value="<?= empty($cod_period)?'':$periodo->description ?>" type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" >
		    		 	</div>
		  		</div>
		  		
  		</div>
        </div>
      			</div>

      			<div class="modal-footer">
        			<button id="CloseModal" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        			<button type="submit" class="btn btn-success" id="saveclassroom" data-dismiss="modal">Guardar</button>
      			</div>
    		</div>
  		</div>
             </form>