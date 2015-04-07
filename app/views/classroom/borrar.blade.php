 <div class="modal-dialog">
           <form id="formdeleteclassroom" action="{{action('ClassroomController@borrarclase')}}?cod_classroom={{$classroom->cod_classroom}}" method="post">
               <input type="hidden" id="current_classroom" name="current_classroom" value=""/>
               <div class="modal-content">
                    <div class="modal-header">
                        Sidma » Admón. académica » Aula {{$classroom->classroom_name}}
                    </div>
                   <div class="modal-body">
                       <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Esta seguro que desea eliminar este sección?</div>
                   </div>
                    <div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" id="deleteclassroom" data-dismiss="modal">Ok, eliminar</button>
      			</div>
                </div>
           </form>
           
       </div>