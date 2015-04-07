
<div class="modal-header">
</div>
<div class="modal-body">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="modal-title " id="myModalLabel">Concepto :: <b>{{$estudiante_plandepago->yearconcepto->conceptodepago->concept_name}} | {{$estudiante_plandepago->yearplandepago->plandepago->plan_name}}</b> ( {{$estudiante_plandepago->yearplandepago->discount_rate}}% descuento plan) {{$estudiante_plandepago->metododepago->payment_method}} | {{$estudiante_plandepago->yeardescuento->descuento->discount_rate}}% {{$estudiante_plandepago->yeardescuento->descuento->discount_name}}</h5>
        </div>
        <div class="panel-body">
                <table id="table{{$estudiante_plandepago->cod_student_payment_plan}}" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr> 
                            <th>Cuotas</th>
                            <th>Fecha pago</th>
                            <th>Fecha límite</th>
                            <th>Monto (U$)</th>
                            <th>Mora (U$)</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total=0;
                         $i = 0;
                                 $disabled = 'disabled';
                        ?>
                        @foreach ($cuotas as $cuota)
                       
                        <tr>
                            <td> <div class="checkbox"><label><?php if($cuota->quota_payment_state==2){ ?><span class="glyphicon glyphicon-check"></span><?php }else{?><input <?= ($i==0)?'':$disabled;?> value="{{$cuota->cod_quota_payment}}" id="{{$cuota->cod_quota_payment}}"  name="cuotas[]" type="checkbox"/><?php }?> cuota {{$cuota->quota}} </label></div></td>
                            <td><div class="checkbox"><label>{{Util::$dias[date('w',strtotime($cuota->regular_payment_date))]}}, {{date('d',strtotime($cuota->regular_payment_date))}} <?= substr(Util::$meses[date('n', strtotime($cuota->regular_payment_date))], 0, 3) . ' ' . date('Y', strtotime($cuota->regular_payment_date)) ?></label></div></td>
                            <td><div class="checkbox"><label>{{Util::$dias[date('w',strtotime($cuota->limit_date))]}}, {{date('d',strtotime($cuota->limit_date))}} <?= substr(Util::$meses[date('n', strtotime($cuota->limit_date))], 0, 3) . ' ' . date('Y', strtotime($cuota->limit_date)) ?></label></div></td>
                            <td><div class="checkbox"><label><?= number_format($cuota->SaldoCuota, 2) ?></label></div></td>
                            <td><div class="checkbox"><label><?= number_format($cuota->Monto_mora, 2) ?></label></div></td>
                            <td><div class="checkbox"><?= Util::$quota_payment_state[$cuota->quota_payment_state] ?></div></td>
                        </tr>
                        <?php 
                        $i++;
                        $total+= number_format($cuota->SaldoCuota, 2);
                        ?>
                        @endforeach
                        <tr>
                             <th>Total</th>
                            <th></th>
                            <th></th>
                            <th><div class="checkbox"><label style="font-weight: bold;"><?= number_format($total,2)?></label></div></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tbody>                
                </table>
        </div>
    </div>
</div>
