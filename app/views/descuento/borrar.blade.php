<div class="modal-dialog alert alert">
    <form id="formdelete" action="{{action('DescuentoController@borrardescuento')}}?cod_discount={{$discount->cod_discount}}" method="post">

        <div class="modal-content">
            <div class="modal-header">
                Sidma » Admón. académica » Concepto de pago {{$discount->discount_name}}
            </div>
            <div class="modal-body">
            <div class="alert alert-warning"> Esta seguro que desea eliminar este concepto?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete" >Ok, eliminar</button>
            </div>
        </div>
    </form>

</div>