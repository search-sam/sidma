<?php
$cod_discount = isset($_REQUEST['cod_discount']) ? $_REQUEST['cod_discount'] : '';
?>
<form id="formnewedit" action="{{action('DescuentoController@neworedit')}}<?= empty($cod_discount) ? '' : "?cod_discount=$discount->cod_discount" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_discount) ? '' : '» Concepto de pago ' . $discount->discount_name ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_discount) ? 'Nuevo descuento' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombredescuento" class="col-sm-3 control-label">Nombre:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_discount) ? '' : $discount->discount_name ?>" type="text" class="form-control" id="nombredescuento" name="nombredescuento" placeholder="Nombre Descuento" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tasadescuento" class="col-sm-3 control-label">Tasa descuento:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_discount) ? '' : $discount->discount_rate ?>" type="text" class="form-control" id="tasadescuento" name="tasadescuento" placeholder="( % ) Descuento" required >
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