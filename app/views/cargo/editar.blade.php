<?php
$cod_employment = isset($_REQUEST['cod_employment']) ? $_REQUEST['cod_employment'] : '';
?>
<form id="formnewedit" action="{{action('CargoController@neworedit')}}<?= empty($cod_employment) ? '' : "?cod_employment=$cargo->cod_employment" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div id="neworeditemployment" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_employment) ? '' : '» Cargo ' . $cargo->employment_name ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_level) ? 'Nuevo cargo' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombrenivel" class="col-sm-3 control-label">Nombre cargo:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_employment) ? '' : $cargo->employment_name ?>" type="text" class="form-control" id="nombrecargo" name="nombrecargo" placeholder="Nombre Cargo" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-3 control-label">Descripción:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_employment) ? '' : $cargo->description ?>" type="text" class="form-control" id="descripcion"  name="descripcion" placeholder="Descripción" required>
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