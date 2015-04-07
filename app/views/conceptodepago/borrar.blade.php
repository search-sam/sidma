<div class="modal-dialog alert alert">
    <form id="formdelete" action="{{action('ConceptodepagoController@borrarconcepto')}}?cod_concept={{$payment_concept->cod_concept}}" method="post">

        <div class="modal-content">
            <div class="modal-header">
                Sidma » Admón. académica » Concepto de pago {{$payment_concept->concept_name}}
            </div>
            <div class="modal-body">
            <div class="alert alert-warning"> Esta seguro que desea eliminar este concepto?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="delete" >Ok, eliminar</button>
            </div>
        </div>
    </form>

</div>