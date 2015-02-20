<?php
   $cod_classroom = $_REQUEST['cod_classroom'];
?>
<form id="formneweditclassroom" action="{{action('GrupoController@agregargrupo')}}?cod_classroom={{$classroom->cod_classroom}}" method="post" class="form-horizontal" role="form">
                    <div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        			<h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_classroom)?'':'» Aula '.$classroom->classroom_name ?></h4>
      			</div>

      			<div class="modal-body">
        			   <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo grupo</h3>
			</div>
  			<div class="panel-body">
                            <div class="form-group">
		    		<label for="nombregrupo" class="col-sm-3 control-label">Nivel:</label>
		   			<div class="col-sm-9">
                                            <select type="text" class="form-control" id="nivel" name="nivel" placeholder="Nivel" >
                                            @foreach($niveles as $nivel)
                                            <option value="{{$nivel->cod_level}}">{{$nivel->level_name}}</option>
                                            @endforeach
                                            </select>
		   		 	</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="nombregrupo" class="col-sm-3 control-label">Nombre grupo:</label>
		   			<div class="col-sm-9">
                                            <input value='<?= substr($classroom->classroom_name, 0,1)?>' type="text" class="form-control" id="nombregrupo" name="nombregrupo" placeholder="Nombre Grupo" >
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