<?php
$cod_employee = isset($_REQUEST['cod_employee']) ? $_REQUEST['cod_employee'] : '';
?>
<form id="formnewedit" action="{{action('EmpleadoController@neworedit')}}<?= empty($cod_employee) ? '' : "?cod_employee=$empleado->cod_employee" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div id="neworeditemployee" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_employee) ? '' : '» Empleados » <b style="color:#3498db;">' . $empleado->first_name . ' ' . $empleado->first_last_name.'</b> <i class="glyphicon glyphicon-pencil"></i>' ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_employee) ? 'Nuevo empleado' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="cedula" class="col-sm-2 control-label">Cargo:</label>
                            <div class="col-sm-4 has-feedback">
                                <select <?= (empty($cod_employee)) ? '' : ' disabled="disabled" ' ?> class="form-control" id="cargo" name="cargo" required >
                                    <option value="0" >Seleccionar cargo</option>
                                    @foreach($cargos as $cargo)
                                    <option <?= (empty($cod_employee)) ? '' : ($empleado->cod_employment == $cargo->cod_employment) ? ' selected="selected" ' : '' ?> value="{{$cargo->cod_employment}}">{{$cargo->employment_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="cedula" class="col-sm-2 control-label">Cédula:</label>
                            <div class="col-sm-4 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->cedula ?>" type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="primernombre" class="col-sm-2 control-label">Primer nombre:</label>
                            <div class="col-sm-4 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->first_name ?>" type="text" class="form-control" id="primernombre" name="primernombre" placeholder="Primer Nombre" required >
                            </div>
                            <label for="segundonombre" class="col-sm-2 control-label">Segundo nombre:</label>
                            <div class="col-sm-4">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->second_name ?>" type="text" class="form-control" id="segundonombre" name="segundonombre" placeholder="Segundo Nombre" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="primerapellido" class="col-sm-2 control-label">Primer apellido:</label>
                            <div class="col-sm-4 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->first_last_name ?>" type="text" class="form-control" id="primerapellido" name="primerapellido" placeholder="Primer Apellido" required >
                            </div>
                            <label for="segundoapellido" class="col-sm-2 control-label">Segundo apellido:</label>
                            <div class="col-sm-4">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->second_last_name ?>" type="text" class="form-control" id="segundoapellido" name="segundoapellido" placeholder="Segundo Apellido" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="genero" class="col-sm-2 control-label">Género:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="genero" name="genero" >
                                    @foreach(Util::$genders as $cod_gender => $gender)
                                    <option <?= empty($cod_employee) ? '' : ($empleado->employee_gender == $cod_gender) ? ' selected="selected" ' : ''; ?> value="{{$cod_gender}}">{{$gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
                            <div class="col-sm-3 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->city_live ?>" type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" required >
                            </div>
                            <label for="barrio" class="col-sm-1 control-label">Barrio:</label>
                            <div class="col-sm-3 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->neighborhood_live ?>" type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio" required >
                            </div>
                            <label for="numerocasa" class="col-sm-1 control-label"># casa:</label>
                            <div class="col-sm-2">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->house_number ?>" type="text" class="form-control" id="numerocasa" name="numerocasa" placeholder="Número Casa" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="direccion" class="col-sm-2 control-label">Dirección:</label>
                            <div class="col-sm-10 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->address_detail ?>" type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefono" class="col-sm-2 control-label">Teléfono:</label>
                            <div class="col-sm-2">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->phone ?>" type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" >
                            </div>  
                            <label for="celular" class="col-sm-2 control-label">Celular:</label>
                            <div class="col-sm-2">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->mobile ?>" type="text" class="form-control" id="celular" name="celular" placeholder="Célular" >
                            </div>
                            <label for="otrotelefono" class="col-sm-2 control-label">Otro teléfono:</label>
                            <div class="col-sm-2">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->other_phone ?>" type="text" class="form-control" id="otrotelefono" name="otrotelefono" placeholder="Otro Teléfono" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-4">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->email ?>" type="text" class="form-control" id="email" name="email" placeholder="Email" >
                            </div>
                            <label for="emailempresarial" class="col-sm-2 control-label"><i class="glyphicon glyphicon-envelope"></i> Institucional:</label>
                            <div class="col-sm-4">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->institutional_email ?>" type="text" class="form-control" id="emailempresarial" name="emailempresarial" placeholder="Email Institucional" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nivelestudios" class="col-sm-2 control-label">Profesión:</label>
                            <div class="col-sm-10 has-feedback">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->degree ?>" type="text" class="form-control" id="nivelestudios" name="nivelestudios" placeholder="Profesión" required >
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
                <button data-loading-text="Loading..."  type="button" class="btn btn-primary" id="save" ><i class="glyphicon glyphicon-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</form>