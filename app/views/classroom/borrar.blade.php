 <div class="modal-dialog">
           <form id="formdeleteclassroom" action="{{action('ClassroomController@borrarclase')}}?cod_classroom={{$classroom->cod_classroom}}" method="post">
               <input type="hidden" id="current_classroom" name="current_classroom" value=""/>
               <div class="modal-content">
                    <div class="modal-header">
                        Sidma » Admón. académica
                    </div>
                    <div class="alert alert-warning"> Esta seguro que desea eliminar este sección?</div>
                    <div class="modal-footer">
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" id="deleteclassroom" data-dismiss="modal">Ok, eliminar</button>
      			</div>
                </div>
           </form>
           
       </div>