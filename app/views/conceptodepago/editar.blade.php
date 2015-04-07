<?php
$cod_concept = isset($_REQUEST['cod_concept']) ? $_REQUEST['cod_concept'] : '';
?>
<form id="formnewedit" action="{{action('ConceptodepagoController@neworedit')}}<?= empty($cod_concept) ? '' : "?cod_concept=$payment_concept->cod_concept" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_concept) ? '' : '» Concepto de pago ' . $payment_concept->payment_method ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_concept) ? 'Nuevo concepto de pago' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Concepto:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_concept) ? '' : $payment_concept->concept_name ?>" type="text" class="form-control" id="nombreconcepto" name="nombreconcepto" placeholder="Nombre Concepto" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Cantidad:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_concept) ? '' : $payment_concept->concept_normal_quantity ?>" type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Pago regular:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_concept) ? '' : $payment_concept->normal_payment ?>" type="text" class="form-control" id="normalpago" name="normalpago" placeholder="Valor regular" required >
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