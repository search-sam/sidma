<?php
$cod_school_year = isset($_REQUEST['cod_school_year']) ? $_REQUEST['cod_school_year'] : '';
$cod_year_discount = isset($_REQUEST['cod_year_discount']) ? $_REQUEST['cod_year_discount'] : '';
?>
<form id="formnewedit" action="{{action('DescuentoController@addtoyear')}}?cod_year_discount={{$cod_year_discount}}" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_school_year) ? '' : '» Descuento ' ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_year_discount) ? 'Seleccione los descuentos a agregar' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id='my_year_payment_concepts' class="table table-striped table-hover">
                                <thead>
                                    <?= empty($cod_year_discount) ? '<th><input id="todo" type="checkbox" value="Todos" > <label>Todos</label></th>' : '' ?>
                                <th>Nombre</th>
                                <th>( % ) Descuento</th>                                
                                </thead>
                                <tbody>
                                    @if(empty($cod_year_discount))
                                    @foreach(Descuento::NotAsigned($cod_school_year) as $discount)
                                    <tr>
                                        <td><input id="{{$discount->cod_discount}}" type="checkbox" name='planes'></td>
                                        <td>{{$discount->discount_name}}</td>
                                        <td><div class="col-sm-9 has-feedback"><input type="text" class="form-control" value="{{$discount->discount_rate}}" style="width: 80%;" required/></div></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>{{Descuento::find($my_year_discount->cod_discount)->discount_name}}</td>
                                        <td><div class="col-sm-9 has-feedback"><input id="discount_rate" name='discount_rate' type="text" class="form-control" value="{{$my_year_discount->discount_rate}}" style="width: 80%;" required/></div></td>

                                    </tr>                                    
                                    @endif
                                </tbody>
                            </table>     
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
                <button type="button" class="btn btn-primary" id="{{empty($cod_year_discount)?'adddiscount':'save'}}" >{{empty($cod_year_discount)?'Agregar':'Guardar'}}</button>
            </div>
        </div>
    </div>
</form>