<?php
$cod_school_year = isset($_REQUEST['cod_school_year']) ? $_REQUEST['cod_school_year'] : '';
$cod_year_payment_plan = isset($_REQUEST['cod_year_payment_plan']) ? $_REQUEST['cod_year_payment_plan'] : '';
?>
<form id="formnewedit" action="{{action('PlandepagoController@addtoyear')}}?cod_year_payment_plan={{$cod_year_payment_plan}}" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_school_year) ? '' : '» Plan de pago ' ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_year_payment_plan) ? 'Seleccione los plan de pago a agregar' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="my_year_payment_plans" class="table table-striped table-hover">
                                <thead>
                                    <?= empty($cod_year_payment_plan) ? '<th><input id="todo" type="checkbox" value="Todos" > <label>Todos</label></th>' : '' ?>
                                <th>Plan de pago</th>
                                <th>Cantidad de pagos</th>
                                <th>(%)Descuento</th>
                                </thead>
                                <tbody>
                                    @if(empty($cod_year_payment_plan))
                                    @foreach(Plandepago::NotAsigned($cod_school_year) as $payment_plan)
                                    <tr>
                                        <td><input id="{{$payment_plan->cod_payment_plan}}" type="checkbox" name='planes'></td>
                                        <td align='center'>{{$payment_plan->plan_name}}</td>
                                        <td align='center'>{{$payment_plan->payment_quantity}}</td>
                                        <td><div class="col-sm-9 has-feedback"><input type="text" class="form-control" value="{{$payment_plan->discount_rate}}" style="width: 70%;" required/></div></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>{{Plandepago::find($my_year_payment_plan->cod_payment_plan)->plan_name}}</td>
                                        <td>{{Plandepago::find($my_year_payment_plan->cod_payment_plan)->payment_quantity}}</td>
                                        <td><div class="col-sm-9 has-feedback"><input id="discount_rate" name='discount_rate' type="text" class="form-control" value="{{$my_year_payment_plan->discount_rate}}" style="width: 70%;" required/></div></td>
                                 
                                    </tr>                                    
                                    @endif
                                </tbody>
                            </table>     </div>



                    </div>
                </div>
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
                </div>
                <div class="indicator"></div>
            </div>
            <div class="modal-footer">
                <button id="CloseModal" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="{{empty($cod_year_payment_plan)?'add':'save'}}" >{{empty($cod_year_payment_plan)?'Agregar':'Guardar'}}</button>
            </div>
        </div>
    </div>
</form>