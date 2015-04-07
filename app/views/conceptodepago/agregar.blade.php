<?php
$cod_school_year = isset($_REQUEST['cod_school_year']) ? $_REQUEST['cod_school_year'] : '';
$cod_year_payment_concept = isset($_REQUEST['cod_year_payment_concept']) ? $_REQUEST['cod_year_payment_concept'] : '';
?>
<form id="formnewedit" action="{{action('ConceptodepagoController@addtoyear')}}?cod_year_payment_concept={{$cod_year_payment_concept}}" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_school_year) ? '' : '» Concepto de pago ' ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_year_payment_concept) ? 'Seleccione los conceptos de pago a agregar' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id='my_year_payment_concepts' class="table table-striped table-hover">
                                <thead>
                                    <?= empty($cod_year_payment_concept) ? '<th><input id="todo" type="checkbox" value="Todos" > <label>Todos</label></th>' : '' ?>
                                <th>Concepto de pago</th>
                                <th>Cantidad de pagos</th>
                                <th>Monto</th>
                                
                                </thead>
                                <tbody>
                                    @if(empty($cod_year_payment_concept))
                                    @foreach(Conceptodepago::NotAsigned($cod_school_year) as $payment_concept)
                                    <tr>
                                        <td><input id="{{$payment_concept->cod_concept}}" type="checkbox" name='planes'></td>
                                        <td>{{$payment_concept->concept_name}}</td>
                                         <td align='center'>{{$payment_concept->concept_normal_quantity}}</td>
                                        <td><div class="col-sm-9 has-feedback"><input type="text" class="form-control" value="{{$payment_concept->normal_payment}}" style="width: 80%;" required/></div></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>{{Conceptodepago::find($my_year_payment_concept->cod_concept)->concept_name}}</td>
                                        <td>{{Conceptodepago::find($my_year_payment_concept->cod_concept)->concept_normal_quantity}}</td>
                                        <td><div class="col-sm-9 has-feedback"><input id="normal_payment" name='normal_payment' type="text" class="form-control" value="{{$my_year_payment_concept->normal_payment}}" style="width: 80%;" required/></div></td>
                                 
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
                <button type="button" class="btn btn-primary" id="{{empty($cod_year_payment_concept)?'addconcept':'save'}}" >{{empty($cod_year_payment_concept)?'Agregar':'Guardar'}}</button>
            </div>
        </div>
    </div>
</form>