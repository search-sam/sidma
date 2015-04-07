<div class="modal-dialog alert alert">
    <form id="formdelete" action="{{action('MetododepagoController@borrarmetodo')}}?cod_payment_method={{$payment_method->cod_payment_method}}" method="post">

        <div class="modal-content">
            <div class="modal-header">
                Sidma » Admón. académica » Método de pago {{$payment_method->payment_method}}
            </div>
            <div class="modal-body">
            <div class="alert alert-warning"> Esta seguro que desea eliminar este plan?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete" >Ok, eliminar</button>
            </div>
        </div>
    </form>

</div>