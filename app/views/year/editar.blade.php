<?php
$cod_school_year = isset($_REQUEST['cod_school_year']) ? $_REQUEST['cod_school_year'] : '';
?>
<form id="formneweditclassroom" action="{{action('YearController@neworedit')}}<?= empty($cod_school_year) ? '' : "?cod_school_year=$year->cod_school_year" ?>" method="post" class="form-horizontal" role="form">
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
                            <label for="nombreyear" class="col-sm-3 control-label">Año lectivo:</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_school_year) ? '' : $year->name_school_year ?>" type="text" class="form-control" id="nombreyear" name="nombreyear" placeholder="Año lectivo" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fechainicio" class="col-sm-3 control-label">Fecha inicio:</label>
                            <div class="col-sm-9">
                                <input class="inputdate form-control" value="<?= empty($cod_school_year) ? '':Util::FormatDate($year->date_from)?>" type="text"  id="fechainicio"  name="fechainicio" placeholder="Fecha inicio">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fechafin" class="col-sm-3 control-label">Fecha fin:</label>
                            <div class="col-sm-9">
                                <input class="inputdate form-control" value="<?= empty($cod_school_year) ? '': Util::FormatDate($year->date_to)?>" type="text"  id="fechafin" name="fechafin" placeholder="Fecha fin" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="evaluaciones" class="col-sm-3 control-label">Cantidad Evaluaciones:</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_school_year) ? '' : $year->evaluation_quantity_semester ?>" type="text" class="form-control" id="evaluaciones" name="evaluaciones" placeholder="Evaluaciones semestrales" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notaminima" class="col-sm-3 control-label">Nota mínima:</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_school_year) ? '' : $year->minimum_note?>" type="text" class="form-control" id="notaminima" name="notaminima" placeholder="Nota mínima" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="creditos" class="col-sm-3 control-label">Créditos:</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_school_year) ? '' : $year->minimum_failed_class?>" type="text" class="form-control" id="creditos" name="creditos" placeholder="Créditos disponibles" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="recargomora" class="col-sm-3 control-label">Recargo mora (%):</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_school_year) ? '' : $year->surcharge_rate?>" type="text" class="form-control" id="recargomora" name="recargomora" placeholder="Recargo mora (%)" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="limitedias" class="col-sm-3 control-label">Limite días:</label>
                            <div class="col-sm-9">
                                <input value="<?= empty($cod_school_year) ? '' : $year->surcharge_limit_days?>" type="text" class="form-control" id="limitediar" name="limitedias" placeholder="Limite días" >
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