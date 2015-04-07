 <div class="modal-dialog alert aler">
           <form id="formdeleteclassroom" action="{{action('TurnoController@borrarclase')}}?cod_shift={{$turno->cod_shift}}" method="post">
              
               <div class="modal-content">
                    <div class="modal-header">
                        Sidma » Admón. académica » Turno {{$turno->shift_name}}
                    </div>
                   <div class="modal-body">
                    <div class="alert alert-warning"> Esta seguro que desea eliminar este turno?</div>
                   </div>
                    <div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" id="deleteclassroom" data-dismiss="modal">Ok, eliminar</button>
      			</div>
                </div>
           </form>
           
       </div>