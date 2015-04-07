<?php
$cod_classroom = isset($_REQUEST['cod_classroom']) ? $_REQUEST['cod_classroom'] : '';
?>
<form id="formnewedit" action="{{action('ClassroomController@neworedit')}}<?= empty($cod_classroom) ? '' : "?cod_classroom=$classroom->cod_classroom" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_classroom) ? '' : '» Aula ' . $classroom->classroom_name ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_classroom) ? 'Nuevo Aula' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombreaula" class="col-sm-3 control-label">Nombre aula:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_classroom) ? '' : $classroom->classroom_name ?>" type="text" class="form-control" id="nombreaula" name="nombreaula" placeholder="Nombre Aula" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edificio" class="col-sm-3 control-label">Edificio:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_classroom) ? '' : $classroom->building ?>" type="text" class="form-control" id="edifio"  name="edificio" placeholder="Edificio" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capacidad" class="col-sm-3 control-label">Capacidad:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_classroom) ? '' : $classroom->capacity ?>" type="text" class="form-control" id="capacidad" name="capacidad" placeholder="Capacidad" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-3 control-label">Descripción:</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_classroom) ? '' : $classroom->description ?>" type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" >
                            </div>
                        </div>

                    </div>
                </div>
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
                </div>
                <div class="indicator"></div>
            </div>

            <div class="modal-footer">
                <button id="CloseModal" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save" ><i class="glyphicon glyphicon-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</form>