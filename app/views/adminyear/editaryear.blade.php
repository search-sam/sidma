<?php
$cod_school_year = isset($_REQUEST['cod_school_year']) ? $_REQUEST['cod_school_year'] : '';
?>
<form id="formnewedit" action="{{action('YearController@neworedit')}}?next_action=AdministrativaController@inicio<?= empty($cod_school_year) ? '' : "&cod_school_year=$year->cod_school_year" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_school_year) ? '' : '» Período ' . $year->name_school_year ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_school_year) ? 'Nuevo año lectivo' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                       <div class="form-group">
                            <label for="recargomora" class="col-sm-3 control-label">Recargo mora (%):</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_school_year) ? '' : $year->surcharge_rate?>" type="text" class="form-control" id="recargomora" name="recargomora" placeholder="Recargo mora (%)" required >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="limitedias" class="col-sm-3 control-label">Limite días:</label>
                            <div class="col-sm-9 has-feedback">
                                <input value="<?= empty($cod_school_year) ? '' : $year->surcharge_limit_days?>" type="text" class="form-control" id="limitediar" name="limitedias" placeholder="Limite días" required >
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
                <button type="button" class="btn btn-primary" id="save" >Guardar</button>
            </div>
        </div>
    </div>
</form>