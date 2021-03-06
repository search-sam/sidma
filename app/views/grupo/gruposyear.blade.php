<?php
$cod_year_grupo = isset($_REQUEST['cod_year_grupo']) ? $_REQUEST['cod_year_grupo'] : '';
?>
<form id="formnewperiod" action="{{action('GrupoController@neworedit')}}?cod_school_year={{$year->cod_school_year}}<?= empty($cod_year_grupo) ? '' : '&cod_year_grupo=' . $grupoyear->cod_year_grupo ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Año lectivo » {{$year->name_school_year}} » Grupos </h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nuevo grupo</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="grupo" class="col-sm-3 control-label">Grupo:</label>
                            <div class="col-sm-9">

                                @if(empty($cod_year_grupo))
                                <select id="grupo" name="grupo" class="form-control" required>
                                     <option value="0">Seleccione a un grupo</option>
                                    @foreach($grupos::Notasigned($year->cod_school_year) as $grupo)
                                    <option value="{{$grupo->cod_grupo}}" >{{Nivel::find($grupo->cod_level)->level_name}}{{$grupo->grupo_name}}, Aula {{Classroom::find($grupo->cod_classroom)->classroom_name}}, {{Classroom::find($grupo->cod_classroom)->building}}</option>
                                    @endforeach
                                </select>

                                @else
                                <input readonly="readonly" class="form-control" id="grupo" name="grupo" value="{{Nivel::find(Grupo::find($grupoyear->cod_grupo)->cod_level)->level_name}}{{Grupo::find($grupoyear->cod_grupo)->grupo_name}}"/>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="docente" class="col-sm-3 control-label">Docente:</label>
                            <div class="col-sm-9">
                                <select id="docente" name="docente" class="form-control" required>
                                    @foreach($docentes::all() as $docente)
                                    <option value="{{$docente->cod_teacher}}"> {{Empleado::find($docente->cod_employee)->EmployeeName}}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="turno" class="col-sm-3 control-label">Turno:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="turno" name="turno" required>
                                   
                                    @foreach($turnos::all() as $turno)
                                    <option <?= empty($cod_year_grupo)?'':($grupoyear->cod_shift==$turno->cod_shift)?'selected="selected"':'' ;?> value="{{$turno->cod_shift}}">{{$turno->shift_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="guardar" class="form-group">

                        </div>

                    </div>
                </div>
                 <div class="alert alert-danger alert-dismissable" style="display: none;">                    
                    <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
                </div>
        <div class="indicator"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save"><i class="glyphicon glyphicon-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</form>