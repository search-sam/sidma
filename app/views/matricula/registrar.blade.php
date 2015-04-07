<?php
$cod_enrollment = isset($_REQUEST['cod_enrollment']) ? $_REQUEST['cod_enrollment'] : '';
?>
<form id="formnewedit" action="{{action('MatriculaController@enroll')}}<?= empty($cod_enrollment) ? '' : "?cod_enrollment=$cod_enrollment" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_enrollment) ? '' : '» Matricula ' ?></h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php
                        $suf = '';
                        if (!is_null($estudiante->academica->level_course)) {
                            if (Nivel::find($estudiante->academica->level_course)->level_name == 'PK-2')
                                $suf = 'Pre-Kinder 2 A&ntilde;o';
                            elseif (Nivel::find($estudiante->academica->level_course)->level_name == 'PK-3')
                                $suf = 'Pre-Kinder 3 A&ntilde;o';
                            elseif (Nivel::find($estudiante->academica->level_course)->level_name == 'K')
                                $suf = 'Kinder';
                            else
                                $suf = '&deg; Grado';
                        }
                        ?>
                        <h3 class="panel-title"><?= empty($cod_enrollment) ? 'Nueva matricula::<b>' . $estudiante->first_name . ' ' . $estudiante->first_last_name . '</b>, último curso ' . (is_null($estudiante->academica->level_course) ? '<label class="label label-danger"><i class="glyphicon glyphicon-warning-sign"></i> No definido</label>' : Nivel::find($estudiante->academica->level_course)->level_name . ' ' . $suf ) : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Tipo de matricula:</label>
                            <div class="col-sm-9 has-feedback">
                                <div class="btn-group" data-toggle="buttons">
                                    @foreach(Util::$enrollment_type as $key=>$value)                               
                                    <label class="btn btn-default {{($matricula->enrollment_type==$key)?'active':''}}"  >
                                        <input {{($matricula->enrollment_type==$key)?'checked':''}}   type="radio" name="enrollment_type" value='{{$key}}' id="{{$key}}" autocomplete="off" > {{$value}}
                                    </label>                                  

                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombreturno" class="col-sm-3 control-label">Grupo:</label>
                            <div class="col-sm-9 has-feedback">
                                <div class="table-resdponsive">

                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table_employees">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="col-md-4" >Grupo</th> 
                                                <th>Cupos disponibles</th>
                                                <th class="col-sm-1" >Turno</th>
                                                <th style="width:400px!important;">Docente guía</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($grupos as $next_grupo)
                                            <tr>
                                                <td><input {{($matricula->cod_year_grupo==$next_grupo->cod_year_grupo)? 'checked':''}} type="radio" value="{{$next_grupo->cod_year_grupo}}" name="cod_year_grupo"/>
                                                </td>
                                                <td><b>{{$next_grupo->grupo}} </b>aula {{$next_grupo->classroom}}</td>
                                                <td>{{$next_grupo->avalaible_seats}}</td>
                                                <td>{{$next_grupo->shift_name}}</td>
                                                <td>{{substr(Empleado::find(Docente::find($next_grupo->cod_teacher)->cod_employee)->degree,0,3)}}. {{$next_grupo->teacher}}</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                    <button id="CloseModal" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="save" ><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
</form>