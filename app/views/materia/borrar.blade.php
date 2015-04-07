 <div class="modal-dialog">
           <form id="formdeleteclassroom" action="{{action('MateriaController@borrarclase')}}?cod_subject={{$materia->cod_subject}}" method="post">
              
               <div class="modal-content">
                    <div class="modal-header">
                        Sidma » Admón. académica » Materia {{$materia->subject_name}}
                    </div>
                   <div class="modal-body">
                       <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Esta seguro que desea eliminar esta materia?</div>
                   </div>
                    <div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" id="deleteclassroom" data-dismiss="modal">Ok, eliminar</button>
      			</div>
                </div>
           </form>
           
       </div>