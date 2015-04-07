<?php
$cod_payment_plan = isset($_REQUEST['cod_payment_plan']) ? $_REQUEST['cod_payment_plan'] : '';
?>
<form id="formnewedit" action="{{action('PlandepagoController@neworedit')}}<?= empty($cod_payment_plan) ? '' : "?cod_payment_plan=$payment_plan->cod_payment_plan" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_payment_plan) ? '' : '» Plan de pago ' . $payment_plan->plan_name ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_payment_plan) ? 'Nuevo plan de pago' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Nombre plan de pago:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_payment_plan) ? '' : $payment_plan->plan_name ?>" type="text" class="form-control" id="nombreplandepago" name="nombreplandepago" placeholder="Nombre plan de pago" required >
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Cantidad de pago:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_payment_plan) ? '' : $payment_plan->payment_quantity ?>" type="text" class="form-control" id="cantidadpagos" name="cantidadpagos" placeholder="Cantidad de pago" required >
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">( % ) Descuento:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_payment_plan) ? '' : $payment_plan->discount_rate ?>" type="text" class="form-control" id="descuento" name="descuento" placeholder="( % ) Descuento" required >
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