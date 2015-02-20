<?php
   $cod_level = isset($_REQUEST['cod_level'])?$_REQUEST['cod_level']:'';
?>
<form id="formneweditclassroom" action="{{action('NivelController@neworedit')}}<?= empty($cod_level)?'':"?cod_level=$nivel->cod_level"?>" method="post" class="form-horizontal" role="form">
                    <div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        			<h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_level)?'':'» Nivel '.$nivel->level_name ?></h4>
      			</div>

      			<div class="modal-body">
        			   <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= empty($cod_level)?'Nuevo nivel':'Editar' ?></h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="nombrenivel" class="col-sm-3 control-label">Nombre nivel:</label>
		   			<div class="col-sm-9">
                                            <input value="<?= empty($cod_level)?'':$nivel->level_name ?>" type="text" class="form-control" id="nombrenivel" name="nombrenivel" placeholder="Nombre Nivel" >
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="descripcion" class="col-sm-3 control-label">Descripción:</label>
		   			<div class="col-sm-9">
		      			<input value="<?= empty($cod_level)?'':$nivel->description ?>" type="text" class="form-control" id="descripcion"  name="descripcion" placeholder="Descripción">
		   		 	</div>
		  		</div>
		  		
		  		
  		</div>
        </div>
      			</div>

      			<div class="modal-footer">
        			<button id="CloseModal" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        			<button type="submit" class="btn btn-success" id="savelevel" data-dismiss="modal">Guardar</button>
      			</div>
    		</div>
  		</div>
             </form>