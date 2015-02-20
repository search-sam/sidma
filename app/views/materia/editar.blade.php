<?php
   $cod_subject = isset($_REQUEST['cod_subject'])?$_REQUEST['cod_subject']:'';
?>
<form id="formneweditclassroom" action="{{action('MateriaController@neworedit')}}<?= empty($cod_subject)?'':"?cod_subject=$materia->cod_subject"?>" method="post" class="form-horizontal" role="form">
                    <div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        			<h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_subject)?'':'» Materia '.$materia->subject_name ?></h4>
      			</div>

      			<div class="modal-body">
        			   <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= empty($cod_subject)?'Nueva materia':'Editar' ?></h3>
			</div>
  			<div class="panel-body">
		  		<div class="form-group">
		    		<label for="nombremateria" class="col-sm-3 control-label">Nombre materia:</label>
		   			<div class="col-sm-9">
                                            <input value="<?= empty($cod_subject)?'':$materia->subject_name ?>" type="text" class="form-control" id="nombremateria" name="nombremateria" placeholder="Nombre Materia" >
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