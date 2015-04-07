<?php
$cod_payment_method = isset($_REQUEST['cod_payment_method']) ? $_REQUEST['cod_payment_method'] : '';
?>
<form id="formnewedit" action="{{action('MetododepagoController@neworedit')}}<?= empty($cod_payment_method) ? '' : "?cod_payment_method=$payment_method->cod_payment_method" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_payment_method) ? '' : '» Método de pago ' . $payment_method->payment_method ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_payment_method) ? 'Nuevo método de pago' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Método:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_payment_method) ? '' : $payment_method->payment_method ?>" type="text" class="form-control" id="nombremetodo" name="nombremetodo" placeholder="Nombre Método" required >
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