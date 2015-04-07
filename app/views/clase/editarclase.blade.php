<?php
$cod_year_grupo = isset($_REQUEST['cod_year_grupo']) ? $_REQUEST['cod_year_grupo'] : '';
$cod_class = isset($_REQUEST['cod_class'])? $_REQUEST['cod_class'] : '';
echo($cod_class);
?>
<form id="formnewperiod" action="{{action('ClaseController@agregarmateria')}}?cod_year_grupo={{$cod_year_grupo}}<?= empty($cod_class)?'':'&cod_class='.$cod_class?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica » Grupo <strong>{{Grupo::find($yeargrupo->cod_grupo)->grupo_name}}</strong> </h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_class)?'Agregar materia':'Editar materia';?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="materia" class="col-sm-3 control-label">Materia:</label>
                            <div class="col-sm-9">
                                @if(empty($cod_class))
                                <select   class="form-control" id="materia" name="materia"  >
                                    @foreach($materias::NotAdded($cod_year_grupo) as $materia)
                                    <option value="{{$materia->cod_subject}}">{{$materia->subject_name}}</option>
                                    @endforeach
                                </select>
                                @else
                                <input class="form-control"  readonly="readonly" value="{{$materias::find($clase->cod_subject)->subject_name}}" />
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="docente" class="col-sm-3 control-label">Docente:</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="docente" name="docente"  >
                                    @foreach(Docente::all() as $docente)
                                    <option<?= empty($cod_class)?'':(($clase->cod_teacher==$docente->cod_teacher)?' selected="selected" ':'') ?> value="{{$docente->cod_teacher}}">{{Empleado::find($docente->cod_employee)->EmployeeName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="semestre" class="col-sm-3 control-label">Semester quantity:</label>
                            <div class="col-sm-9">

                                <input class="form-control" placeholder="Semester quantity" type="text" id="semestre" name="semestre" value="{{empty($cod_class)?'':$clase->semester_quantity}}" />

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
                <button type="submit" class="btn btn-success" id="save">Guardar</button>
            </div>
        </div>
    </div>
</form><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

