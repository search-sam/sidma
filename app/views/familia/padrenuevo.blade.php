@extends('layouts.home')

@section('css')
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav bs-docs-sidenav">
        <li><a href="#personal"><b>Informaci&oacute;n Personal</b></a></li>
        <li><a href="#domicilio"><b>Informaci&oacute;n del Domicilio</b></a></li>
        <li><a href="#laboral"><b>Informaci&oacute;n Laboral</b></a></li>
        <li><a href="#comunicacion"><b>Medio de Comunicaci&oacute;n</b></a></li>
        <li><a href="#guardar"><b>Guardar</b></a></li>
        <li><a href="#inicio"><b>Inicio</b></a></li>	
    </ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h4 class="page-header">Nuevo estudiante » <b>{{$estudiante->first_name}} {{$estudiante->first_last_name}}</b> » Académica, Administrativa, Médica  » <b style="color:#3498db;"><i class="glyphicon glyphicon-info-sign"></i> Familia</b></h4>
    <div class="alert alert-success" <?= Session::has('message_student') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_student')}}
    </div>
    <div class="alert alert-success" <?= Session::has('message_tutor') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_tutor')}}
    </div>
    <div class="alert-danger alert alert-dismissable" style="display: none;">                    
        <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
    </div>
    <form id="agregartutor" action="{{action('FamiliaController@tutoragregar')}}?familia_id{{$familia_id}}&cod_student={{$estudiante->cod_student}}" method="post" class="form-horizontal" role="form">
        <input type="text" id="familia" name="familia_id" value="{{$familia_id}}" style="display:none;">
        <input type="hidden" id="return" name="return" value="0" />
        {{-- Informacion Personal --}}
        <div id="personal" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n Personal</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="primer-nombre" class="col-sm-2 control-label">Primer nombre:</label>
                    <div class="col-sm-4 has-feedback">
                        <input type="text" class="form-control" id="primer-nombre" name="primer-nombre" placeholder="Primer Nombre" required>
                    </div>
                    <label for="segundo-nombre" class="col-sm-2 control-label">Segundo nombre:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="segundo-nombre" name="segundo-nombre" placeholder="Segundo Nombre">
                    </div>
                </div>

                <div class="form-group">
                    <label for="primer-apellido" class="col-sm-2 control-label">Primer apellido:</label>
                    <div class="col-sm-4 has-feedback">
                        <input type="text" class="form-control" id="primer-apellido" name="primer-apellido" placeholder="Primer Apellido" required>
                    </div>
                    <label for="segundo-apellido" class="col-sm-2 control-label">Segundo apellido:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="segundo-apellido" name="segundo-apellido" placeholder="Segundo Apellido">
                    </div>
                </div>

                <div class="form-group">
                    <label for="relacion" class="col-sm-2 control-label">Relaci&oacute;n/Alumno:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="relacion" name="relacion" >
                            <option value="1">Padre/Madre</option>
                            <option value="2">Padrastro/Madrastra</option>
                            <option value="3">Tutor Legal</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tel-convencional" class="col-sm-2 control-label">Teléfono:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="tel-convencional" name="tel-convencional" placeholder="Teléfono">
                    </div>
                    <label for="tel-celular" class="col-sm-2 control-label"> Celular:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="tel-celular" name="tel-celular" placeholder="Celular">
                    </div>
                    <label for="tel-otro" class="col-sm-2 control-label">Otro Telefono:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="tel-otro" name="tel-otro" placeholder="Otro Teléfono">
                    </div>
                </div>


            </div>
        </div>
        {{-- ==================================================================================================== --}}

        {{-- Informaci&oacute;n Domicilio --}}
        <div id="domicilio" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n del Domicilio</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">¿Vive en la misma direcci&oacute;n<br/> del alumno?</label>
                    <div class="col-sm-9">
                        <div class="checkbox">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="vive"> No
                            </label>
                        </div>
                    </div>
                </div>
                {{-- Datos Vivienda --}}
                <div id="tutor-domicilio" style="display:none;">
                    <div class="form-group">
                        <label for="tutor-cuidad" class="col-sm-2 control-label">Cuidad:</label>
                        <div class="col-sm-4 has-feedback">
                            <input type="text" class="form-control" id="tutor-cuidad" name="tutor-cuidad" placeholder="Ciudad" required>
                        </div>
                        <label for="tutor-barrio" class="col-sm-2 control-label">Barrio/Reparto:</label>
                        <div class="col-sm-4 has-feedback">
                            <input type="text" class="form-control" id="tutor-barrio" name="tutor-barrio" placeholder="Barrio/Reparto" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tutor-dir" class="col-sm-2 control-label">Direcci&oacute;n exacta:</label>
                        <div class="col-sm-10 has-feedback">
                            <textarea  style="resize: none;"class="form-control" rows="2"id="tutor-dir" name="tutor-dir" placeholder="Direcci&oacute;n" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tutor-num-casa" class="col-sm-2 control-label">N&uacute;mero de casa:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tutor-num-casa" name="tutor-num-casa" placeholder="N° Casa">
                        </div>
                    </div>
                </div>
                {{-- -------------------------------------------------- --}}
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        {{-- Informacion Laboral --}}
        <div id="laboral" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n Laboral</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">¿Esta actualmente laborando?</label>
                    <div class="col-sm-9">
                        <div class="checkbox">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="labora" name="labora" value="1"> Si
                            </label>
                        </div>
                    </div>
                </div>
                {{-- Datos Empresa --}}
                <div id="tutor-laboral" style="display:none;">
                    <div class="form-group">
                        <label for="tutor-empresa" class="col-sm-3 control-label">Nombre de la Empresa:</label>
                        <div class="col-sm-9 has-feedback">
                            <input type="text" class="form-control" id="tutor-empresa" name="tutor-empresa" placeholder="Empresa" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">¿Es propietario(a) de este negocio?</label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="propietario" id="propietario1" value="1"> Si
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="propietario" id="propietario2" value="0"> No
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- Datos Propiedad --}}
                    <div id="tutor-propietario" style="display:none;">
                        <div class="form-group">
                            <label for="empresa-correo" class="col-sm-3 control-label">Correo Electronico:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="empresa-correo" name="empresa-correo" placeholder="Correo Electronico de la Empresa" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa-convencional" class="col-sm-3 control-label">Telefono Convencional:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="empresa-convencional" name="empresa-convencional" placeholder="Telefono Convencional de la Empresa" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa-extension" class="col-sm-3 control-label">Extensi&oacute;n:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="empresa-extension" name="empresa-extension" placeholder="Extensi&oacute;n del Telefono de la Empresa">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa-celular" class="col-sm-3 control-label">Telefono Celular:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="empresa-celular" name="empresa-celular" placeholder="Telefono Celular de la Empresa" >
                            </div>
                        </div>	
                    </div>
                    {{-- ......................... --}}
                    <div id="tutor-no-propietario" style="display:none;">
                        <div class="form-group">
                            <label for="cargo" class="col-sm-3 control-label">Cargo en la Empresa:</label>
                            <div class="col-sm-9 has-feedback">
                                <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo en la Empresa" required >
                            </div>
                        </div>
                    </div>
                    {{-- -------------------------------------------------- --}}
                </div>
                {{-- -------------------------------------------------- --}}
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        {{-- Comunicacion --}}
        <div id="comunicacion" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Medio de Comunicaci&oacute;n</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="tutor-correo" class="col-sm-3 control-label">Cuenta de Correo:</label>
                    <div class="col-sm-9">
                        <span class="help-block">Por favor proporcione la cuenta de correo electronico a la que le enviaremos las circulares y los comunicados oficiales.</span>
                        <input type="text" class="form-control" id="tutor-correo" name="tutor-correo" placeholder="Correo Electronico" >
                    </div>
                </div>
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        <div id="guardar" class="form-group">
            <div class="col-sm-12 ">
                <button type="button" id="doContinueAgain"  class="btn btn-primary" id="agregar">Guardar y agregar nuevo tutor</button>
                <button type="button" id="doContinue" class="btn btn-info pull-right">Continuar</button>
            </div>
        </div>
    </form>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {

        /*ref="{{action('FamiliaController@tutoragregar')}}?return=true&familia_id={{$familia_id}}"*/
        $(document).on('change',"#vive", function() {
            $('#tutor-domicilio').toggle('slow');
        });

        $(document).on('change','#labora', function() {
            $('#tutor-laboral').toggle('slow');
        });

        $(document).on('click','#propietario1', function() {
            $('#tutor-propietario').toggle('slow');
            $('#tutor-no-propietario').fadeOut("slow");
        });

        $(document).on('click','#propietario2', function() {
            $('#tutor-no-propietario').toggle('slow');
            $('#tutor-propietario').fadeOut("slow");
        });



        $(document).on('click',"#doContinue", function() {
            if (formIsvalid($('.form-control[required]'))) {
                $('#agregartutor').submit();
            }
        });
        $(document).on('click',"#doContinueAgain", function() {

            if (formIsvalid($('.form-control[required]'))) {
                $('#return').val(1);
                $('#agregartutor').submit();
            }
        });
    });
</script>
@stop


