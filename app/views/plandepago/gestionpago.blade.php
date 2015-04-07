<?php
$cod_student = isset($_REQUEST['cod_student']) ? $_REQUEST['cod_student'] : '';
$recibo = new Recibo;
if (empty($recibo::all()->last())) {
    $num_recibo = Util::formatonumerorecibo(1);
} else {
    $num_recibo = Util::formatonumerorecibo($recibo::all()->last()->cod_receipt);
}
?>

<form id="formnewedit" action="{{action('PlandepagoController@realizarpago')}}" method="post" class="form-horizontal" role="form">
    <input type="hidden" id="cod_student" name="cod_student" value="{{$estudiante->cod_student}}" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma <?= empty($cod_student) ? '' : '» Realizar pago | <i class="glyphicon glyphicon-education"></i> ' . $estudiante->first_name . ' ' . $estudiante->second_name . ' ' . $estudiante->first_last_name . ' ' . $estudiante->second_last_name ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label style="font-weight: normal;font-size: 13px;text-align: left;"  class="col-sm-3 control-label"><?= Util::$dias[date('w')] ?>, <?= date('d') . ' ' . substr(Util::$meses[date('n')], 0, 3) . ' ' . date('Y') ?></label>
                                <label style="font-weight: normal;font-size: 13px;"  class="col-sm-9 control-label"><b >Recibo <span style="color:red;">N° {{$num_recibo}}</span></b></label>
                            </div>
                        </h4>
                    </div>
                    <div id="paymentform"  class="panel-body">
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-2 control-label">A nombre de:</label>
                            <div class="col-sm-4 has-feedback">
                                <input id='payer_name' type="text" class="form-control" value="<?= isset($_REQUEST['payer_name']) ? $_REQUEST['payer_name'] : ''?>" placeholder="Nombre quien realiza el pago" required/>
                            </div>
                            <label for="nombreturno" class="col-sm-2 control-label">Concepto(s)/pagar:</label>
                            <div class="col-sm-3 has-feedback">
                                <select id="estudiantepago" multiple="multiple">
                                    <?php $i = 0; ?>
                                    @foreach(EstudiantePlandepago::inforce($cod_school_year,$cod_student) as $plandepago)
                                    <option <?= ($i == 0) ? 'selected' : '' ?>  value="{{$plandepago->cod_student_payment_plan}}">{{$plandepago->yearconcepto->conceptodepago->concept_name}}</option>
                                    <?php $i++; ?>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="tipo_moneda" name="tipo_moneda"/>
                            <label  class="col-sm-2 control-label">Monto/pagar: </label>                          
                            <label  class="col-sm-4 control-label"><b id="amount_to_pay" name="amount_to_pay"></b> <b style="font-size: 20px;">|</b>
                                <b id="amount_to_pay_cor" name="amount_to_pay_cor" ></b>
                                <b style="font-size: 20px;">|</b> <span style="font-weight: normal;">T/C 27.00</span>
                            </label>
                            <label  for="nombreturno" class="col-sm-2 control-label">Recibido (U$):</label>
                            <div class="col-sm-2 has-feedback">
                                <input data-toogle="tooltip" title="Sólo números" type="text"  id="amount_usd" name="amount_usd" class="numbers form-control" placeholder="Monto (U$)"/>
                            </div>
                            <label class="cambio btn btn-danger"  id="left_usd" >
                            </label>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Método de pago:</label>
                            <div class="col-sm-4 has-feedback">
                                <select id="payment_method" class="form-control">
                                    @foreach(Metododepago::all() as $payment_method)
                                    <option value="{{$payment_method->cod_payment_method}}">{{$payment_method->payment_method}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="nombreturno" class="col-sm-2 control-label">Recibido (C$):</label>
                            <div class="col-sm-2 has-feedback">
                                <input data-toggle="tooltip" title="Sólo números" type="text"  id="amount_cor" name="amount_cor" class="numbers form-control" placeholder="Monto (C$)"/>
                            </div>
                            <label id="left_cor" class="cambio btn btn-danger">
                            </label>
                        </div>
                        <div class="form-group">                           
                            <div class="col-sm-6 has-feedback">
                                <div id="credit_cards" class="btn-group" style="display: none;">
                                    @foreach(Util::$credit_cards as $codigo =>$credit_card)
                                    <label id="{{$codigo}}" class="btn btn-default"><i class="glyphicon glyphicon-credit-card"></i> {{$credit_card}}</label>
                                    @endforeach                                        
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
                </div>
                <div class="indicator"></div>
                <div class="sub_indicator" style="display: none;"> 
                    <span style="color:#333;font-size: 11px;" id="label_quota">Registrando accion...</span>
                    <div class="progress progress-striped active" style="height: 0.5em;">                       
                        <div id="subi" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" ariavolummin="0" ariavolummax="100" style="width:15%;">
                            <span class="sr-only">Registrando acción...</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="test" class="btn btn-default" type="button">Verificar pago/abono</button>
                <button id="CloseModal" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save_payment" ><i class="glyphicon glyphicon-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</form>
@section('js')


@stop