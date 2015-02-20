@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav bs-docs-sidenav">
        <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar Familia</button></li>
        <li><a href="#guardar"><b>Guardar</b></a></li>
        <li><a href="#inicio"><b>Inicio</b></a></li>	
    </ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h3 class="page-header">Nuevo estudiante » Informacion personal » Académica, Administrativa, Medica » Familia</h3>
    <form id="formsavestudent" action="{{action('EstudianteController@guardar')}}" method="post" class="form-horizontal" role="form">
        <input type="text" name="familia" id="asignar-familia" style="display:none;"/>
        <input type="hidden" name="cod_family" id="cod_family" value="0"/>
        {{-- Informacion del Estudiante --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n del Estudiante</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="nombre1" class="col-sm-3 control-label">Primer nombre:</label>
                    <div class="col-sm-9 has-feedback">
                        <input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer Nombre" required >

                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre2" class="col-sm-3 control-label">Segundo nombre:</label>
                    <div class="col-sm-9 has-feedback">
                        <input type="text" class="form-control" id="nombre2"  name="nombre2" placeholder="Segundo Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellido1" class="col-sm-3 control-label">Primer apellido:</label>
                    <div class="col-sm-9 has-feedback">
                        <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" required >
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellido2" class="col-sm-3 control-label">Segundo apellido:</label>
                    <div class="col-sm-9 has-feedback">
                        <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="genero" class="col-sm-3 control-label">Género:</label>
                    <div class="col-sm-9 ">
                        <select class="form-control" id="genero" name="genero" >
                            <option value="0">Masculino</option>
                            <option value="1">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo" class="col-sm-3 control-label">Foto:</label>
                    <div class="col-lg-3 ">
                        <div id="cropContaineroutput"></div>
                        <input type="text" id="cropOutput" name="foto" style="display:none;"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dia" class="col-sm-3 control-label">D&iacute;a de Nacimiento:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="dia" name="dia" >
                            @for ($i = 0; $i < 31; $i++)
                            <option value="{{$i+1}}">{{$i+1}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mes" class="col-sm-3 control-label">Mes de Nacimiento:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="mes" name="mes" >
                            @foreach (Util::$meses as $j => $mes)
                            <option value="{{$j}}">{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="anyo" class="col-sm-3 control-label">A&ntilde;o de Nacimiento:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="anyo" name="anyo" >
                            @for ($i = (date('Y')-30); $i <= date('Y'); $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nacimiento-pais" class="col-sm-3 control-label">Pa&iacute;s de Nacimiento:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nacimiento-pais" name="nacimiento-pais" placeholder="Pa&iacute;s" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="nacimiento-ciudad" class="col-sm-3 control-label">Ciudad de Nacimiento:</label>
                    <div class="col-sm-9 has-feedback">
                        <input type="text" class="form-control" id="nacimiento-ciudad" name="nacimiento-ciudad" placeholder="Ciudad" required >
                    </div>
                </div>
                <div class="form-group">
                    <label for="ciudad-casa" class="col-sm-3 control-label">Cuidad:</label>
                    <div class="col-sm-9 has-feedback">
                        <input type="text" class="form-control" id="ciudad-casa" name="ciudad-casa" placeholder="Ciudad" required >
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="barrio" class="col-sm-3 control-label">Barrio/Reparto:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio/Reparto" required >
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="dir" class="col-sm-3 control-label">Direcci&oacute;n exacta:</label>
                    <div class="col-sm-9">
                        <textarea style="resize: none;" class="form-control" rows="3"id="dir" name="dir" placeholder="Direcci&oacute;n" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="num-casa" class="col-sm-3 control-label">N&uacute;mero de casa:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="num-casa" name="num-casa" placeholder="N° Casa">
                    </div>
                </div>
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        <div id="guardar" class="form-group">
            <div class="col-sm-12 ">                
                <button  type="button" data-toggle="modal" data-target="#doAsignFamilyModal" class="btn btn-primary pull-right">Continuar</button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Asignar Familia</h4>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Familia</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input checked class="familia"  type="radio" id="rcod_family1" name="rcod_family" value="0"/></td>
                                    <td>Nueva familia</td>
                                </tr>
                                @foreach ($familias as $familia)
                                <tr>
                                    <td><input type="radio" class="familia" id="rcod_family{{$familia->cod_family}}" name="rcod_family" value="{{$familia->cod_family}}"/></td>
                                    <td>
                                        <div class="btn-group"> 
                                            @foreach($familia->detallefamilia as $tutor)
                                            <button type="button" class="btn btn-default">
                                                {{$tutor->NombreFamilia}}

                                            </button>
                                            @endforeach

                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="asignar" data-dismiss="modal">Asignar</button>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="doAsignFamilyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-heading">
                <h4>Sidma » Nuevo estudiante</h4>
            </div>
            <div class="panel-body">
                <div class="alert alert-warning"> <h5><i class="glyphicon glyphicon-info-sign"></i> No asignó una <strong>familia</strong> al nuevo estudiante ¿desea continuar de todas formas? <br/><br/><i class="glyphicon glyphicon-info-sign"></i> Si continua el sistema creará una nueva familia para el estudiante</h5>
                </div>
            </div>

            <div class="modal-footer">
                <button id="asignFamilyModal" type="button" class="btn btn-info" data-dismiss="modal">Regresar</button>
                <button type="button" class="btn btn-success" id="savestudent" data-dismiss="modal">Si, continuar</button>
            </div>
        </div>

    </div>
</div>
@stop

@section('js')
<script src="{{URL::to('/')}}/js/croppic.min.js"></script>

<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>

<script>
$(document).ready(function() {
    var valform = 1;
    $('#savestudent').live('click', function() {
        //Primernombre, Segundonombre, PrimerApellido, Segundoapellido, genero, Email,foto
        //dia nacimiento, mes nacimiento, año nacimiento, pais nacimiento, ciudad nacimiento
        //barrio, dirección, Num casa
        $(".form-control").live('focus', function() {
            $(this).parent().removeClass('has-error');
            $(this).parent().find('span').remove();
        });
        $(".form-control[required]").each(function() {
            if ($(this).val() === "") {
                valform = 0;
                $(this).parent().append('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
                $(this).parent().addClass('has-error');
            }
        });
        if (valform == 1) {//Si se validó el formulario
           
            $('#formsavestudent').submit();
        } else {
       
        }

    });
    $('.familia').change(function() {
        $("#cod_family").val($(this).val());
    }
    );
});
var croppicContaineroutputOptions = {
    uploadUrl: 'img_save_to_file.php',
    cropUrl: 'img_crop_to_file.php',
    outputUrlId: 'cropOutput',
    modal: false,
    loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
}
var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);

</script>
@stop



