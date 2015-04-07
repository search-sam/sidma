<?php
$cod_grupo = $_REQUEST['cod_grupo'];

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form id="formnewedit" action="{{action('GrupoController@reasignargrupo')}}<?= '?cod_grupo='.$grupo->cod_grupo ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  » Grupo <b>{{Nivel::find($grupo->cod_level)->level_name}}{{$grupo->grupo_name}}</b></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reasignar grupo</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="cedula" class="col-sm-4 control-label">Aula actual:</label>
                            <div class="col-sm-8">
                                <?php $myclassrooms = new Classroom; ?>
                                <input type="hidden" id="actual_cod_classroom" name="actual_cod_classroom" value="{{$grupo->cod_classroom}}"/>
                                <input readonly="readonly" class="form-control"  type="text" id="aula" name="aula" value="Aula {{$myclassrooms::find($grupo->cod_classroom)->classroom_name}}, {{$myclassrooms::find($grupo->cod_classroom)->building}} {{$grupo->classrooms}}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cedula" class="col-sm-4 control-label">Cambiar con:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="new_cod_classroom" name="new_cod_classroom">
                                  
                                    @foreach(Grupo::where('cod_classroom','!=',$grupo->cod_classroom)->get() as $cc => $mygrupo)
                                    <option  value="{{$mygrupo->cod_classroom}}">(Grupo {{Nivel::find($mygrupo->cod_level)->level_name}}{{$mygrupo->grupo_name}}) Aula {{$myclassrooms::find($mygrupo->cod_classroom)->classroom_name}}, {{$myclassrooms::find($mygrupo->cod_classroom)->building}}</option>
                                    @endforeach
                                </select>
                             </div>
                        </div>
                    </div>
                </div>
                 <div class="alert alert-danger alert-dismissable" style="display: none;">                    
                    <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
                </div>
        <div class="indicator"></div>
            </div>

            <div class="modal-footer">
                <button id="CloseModal" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="save" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</form>
