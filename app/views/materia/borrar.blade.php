 <div class="modal-dialog">
           <form id="formdeleteclassroom" action="{{action('MateriaController@borrarclase')}}?cod_subject={{$materia->cod_subject}}" method="post">
              
               <div class="modal-content">
                    <div class="modal-header">
                        Sidma » Admón. académica » Materia {{$materia->subject_name}}
                    </div>
                    <div class="alert alert-warning"> Esta seguro que desea eliminar esta materia?</div>
                    <div class="modal-footer">
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" id="deleteclassroom" data-dismiss="modal">Ok, eliminar</button>
      			</div>
                </div>
           </form>
           
       </div>