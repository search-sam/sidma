<?php
$cod_employee = isset($_REQUEST['cod_employee']) ? $_REQUEST['cod_employee'] : '';
?>
<form id="formnewedit" action="{{action('EmpleadoController@neworedit')}}<?= empty($cod_employee) ? '' : "?cod_employee=$empleado->cod_employee" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title " id="myModalLabel">Sidma » Admón. académica  <?= empty($cod_employee) ? '' : '» Empleado ' . $empleado->first_name . ' ' . $empleado->first_last_name ?></h4>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= empty($cod_employee) ? 'Nuevo empleado' : 'Editar' ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="cedula" class="col-sm-4 control-label">Cargo:</label>
                            <div class="col-sm-8">
                                <select <?= (empty($cod_employee))?'':' disabled="disabled" '?> class="form-control" id="cargo" name="cargo" >
                                    @foreach($cargos as $cargo)
                                    <option <?= (empty($cod_employee))?'':($empleado->cod_employment==$cargo->cod_employment)?' selected="selected" ':'' ?> value="{{$cargo->cod_employment}}">{{$cargo->employment_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cedula" class="col-sm-4 control-label">Cédula:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->cedula ?>" type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="primernombre" class="col-sm-4 control-label">Primer nombre:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->first_name ?>" type="text" class="form-control" id="primernombre" name="primernombre" placeholder="Primer Nombre" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="segundonombre" class="col-sm-4 control-label">Segundo nombre:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->second_name ?>" type="text" class="form-control" id="segundonombre" name="segundonombre" placeholder="Segundo Nombre" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="primerapellido" class="col-sm-4 control-label">Primer apellido:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->first_last_name ?>" type="text" class="form-control" id="primerapellido" name="primerapellido" placeholder="Primer Apellido" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="segundoapellido" class="col-sm-4 control-label">Segundo apellido:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->second_last_name ?>" type="text" class="form-control" id="segundoapellido" name="segundoapellido" placeholder="Segundo Apellido" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="genero" class="col-sm-4 control-label">Género:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="genero" name="genero" >
                                    @foreach(Util::$genders as $cod_gender => $gender)
                                    <option <?= empty($cod_employee)?'':($empleado->employee_gender==$cod_gender)?' selected="selected" ':'';?> value="{{$cod_gender}}">{{$gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ciudad" class="col-sm-4 control-label">Ciudad:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->city_live ?>" type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barrio" class="col-sm-4 control-label">Barrio:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->neighborhood_live ?>" type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="col-sm-4 control-label">Dirección:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->address_detail ?>" type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numerocasa" class="col-sm-4 control-label">Número casa:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->house_number ?>" type="text" class="form-control" id="numerocasa" name="numerocasa" placeholder="Número Casa" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="telefono" class="col-sm-4 control-label">Teléfono:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->phone ?>" type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" >
                            </div>                            
                        </div>
                         <div class="form-group">
                            <label for="celular" class="col-sm-4 control-label">Celular:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->mobile ?>" type="text" class="form-control" id="celular" name="celular" placeholder="Célular" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="otrotelefono" class="col-sm-4 control-label">Otro teléfono:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->other_phone ?>" type="text" class="form-control" id="otrotelefono" name="otrotelefono" placeholder="Otro Teléfono" >
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->email ?>" type="text" class="form-control" id="email" name="email" placeholder="Email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailempresarial" class="col-sm-4 control-label">Email institucional:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado->institutional_email ?>" type="text" class="form-control" id="emailempresarial" name="emailempresarial" placeholder="Email Institucional" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nivelestudios" class="col-sm-4 control-label">Profesión:</label>
                            <div class="col-sm-8">
                                <input value="<?= empty($cod_employee) ? '' : $empleado ->degree?>" type="text" class="form-control" id="nivelestudios" name="nivelestudios" placeholder="Profesión" >
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="CloseModal" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="saveemployee" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</form>