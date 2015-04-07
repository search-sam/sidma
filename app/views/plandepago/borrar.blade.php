<div class="modal-dialog alert alert">
    <form id="formdelete" action="{{action('PlandepagoController@borrarplan')}}?cod_payment_plan={{$payment_plan->cod_payment_plan}}" method="post">

        <div class="modal-content">
            <div class="modal-header">
                Sidma » Admón. académica » Plan de pago {{$payment_plan->plan_name}}
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