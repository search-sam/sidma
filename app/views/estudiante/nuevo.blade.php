@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav nav-pills">
        <li><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Familia</button></li>
        <li><a href="#guardar"><b>» Continuar</b></a></li>
        <li><a href="#inicio"><i class="glyphicon glyphicon-home"></i><b> Inicio</b></a></li>	
    </ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h4 class="page-header" style="margin-bottom: 10px;"><?php if(!isset($_REQUEST['ref'])){ ?><a href="{{action('EstudianteController@inicio')}}"><i class="glyphicon glyphicon-level-up"></i> Estudiantes</a><?php }else{ ?><a href="{{action('MatriculaController@inicio')}}"><i class="glyphicon glyphicon-level-up"></i> Matriculas</a><?php }?> » Nuevo estudiante :: <b style="color:#3498db;"><i class="glyphicon glyphicon-info-sign"></i> Informacion personal</b> » Académica, Administrativa, Médica</h4>
    <form id="formsavestudent" action="{{action('EstudianteController@guardar')}}" method="post" class="form-horizontal" role="form">
        <input type="text" name="familia" id="asignar-familia" style="display:none;"/>
        <input type="hidden" name="cod_family" id="cod_family" value="0"/>
        {{-- Informacion del Estudiante --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n del Estudiante <i class="glyphicon glyphicon-pencil"></i>  </h3>
            </div>
            <div class="panel-body">
                <div class="indicator"></div>
                <div class="alert alert-danger alert-dismissable" style="display: none;">                    
                    <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
                </div>
                <div class="form-group">
                    <label for="nombre1" class="col-sm-2 control-label">Primer nombre:</label>
                    <div class="col-sm-4 has-feedback">
                        <input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer Nombre" required >
                    </div>
                    <label for="nombre2" class="col-sm-2 control-label">Segundo nombre:</label>
                    <div class="col-sm-4 has-feedback">
                        <input type="text" class="form-control" id="nombre2"  name="nombre2" placeholder="Segundo Nombre">
                    </div>
                </div>                
                <div class="form-group">
                    <label for="apellido1" class="col-sm-2 control-label">Primer apellido:</label>
                    <div class="col-sm-4 has-feedback">
                        <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" required >
                    </div>
                    <label for="apellido2" class="col-sm-2 control-label">Segundo apellido:</label>
                    <div class="col-sm-4 has-feedback">
                        <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Apellido" >
                    </div>
                </div>               
                <div class="form-group">
                    <label for="genero" class="col-sm-2 control-label">Género:</label>
                    <div class="col-sm-4 ">
                        <select class="form-control" id="genero" name="genero" >
                            <option value="0">Masculino</option>
                            <option value="1">Femenino</option>
                        </select>
                    </div>
                    <label for="correo" class="col-sm-2 control-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Email">
                    </div>
                </div>
                <!--
                 <div class="form-group">
                     <label for="correo" class="col-sm-3 control-label">Foto:</label>
                     <div class="col-lg-3 ">
                         <div id="cropContaineroutput"></div>
                         <input type="text" id="cropOutput" name="foto" style="display:none;"/>
                     </div>
                 </div>-->
                <div class="form-group">
                    <label for="dia" class="col-sm-2 control-label">Nacimiento (d/m/a):</label>
                    <div class="col-sm-1" style="width:9.3333%">
                        <select class="form-control" id="dia" name="dia" >
                            @for ($i = 0; $i < 31; $i++)
                            <option value="{{$i+1}}">{{$i+1}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-2" style="width:13.6666%;">
                        <select class="form-control" id="mes" name="mes" >
                            @foreach (Util::$meses as $j => $mes)
                            <option value="{{$j}}">{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2" style="width:10.5555%;">
                        <select class="form-control" id="anyo" name="anyo" >
                            @for ($i = (date('Y')-30); $i <= date('Y'); $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <h4 class="page-header"></h4>             
                <div class="form-group">
                    <label for="nacimiento-pais" class="col-sm-2 control-label">Pa&iacute;s/Nacimiento:</label>
                    <div class="col-sm-2 has-feedback">
                        <input type="text" class="form-control" id="nacimiento-pais" name="nacimiento-pais" placeholder="Pa&iacute;s/Nacimiento" required >
                    </div>
                    <label for="nacimiento-ciudad" class="col-sm-2 control-label">Ciudad/Nacimiento:</label>
                    <div class="col-sm-2 has-feedback">
                        <input type="text" class="form-control" id="nacimiento-ciudad" name="nacimiento-ciudad" placeholder="Ciudad/Nacimiento" required >
                    </div>
                    <label for="ciudad-casa" class="col-sm-2 control-label">Cuidad (actual):</label>
                    <div class="col-sm-2 has-feedback">
                        <input type="text" class="form-control" id="ciudad-casa" name="ciudad-casa" placeholder="Ciudad" required >
                    </div> 
                </div>
                <h4 class="page-header"></h4>
                <div class="form-group has-feedback">
                    <label for="barrio" class="col-sm-2 control-label">Barrio/Reparto:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio/Reparto" required >
                    </div>
                    <label for="num-casa" class="col-sm-2 control-label">N&uacute;mero de casa:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="num-casa" name="num-casa" placeholder="N° Casa">
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="dir" class="col-sm-2 control-label">Direcci&oacute;n exacta:</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none;" class="form-control" rows="1" id="dir" name="dir" placeholder="Direcci&oacute;n exacta" required></textarea>
                    </div>
                </div>

            </div>
        </div>
        {{-- ==================================================================================================== --}}

        <div id="guardar" class="form-group">
            <div class="col-sm-12 ">                
                <button id="doContinue"  type="button"  class="btn btn-primary pull-right"> » Continuar</button>
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
                    <div class="table-respondsive">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="fam">
                            <thead>
                                <tr>
                                    <th><input checked class="familia"  type="radio" id="rcod_family1" name="rcod_family" value="0"/></th>
                                    <th></th>
                                    <th ><strong>Nueva familia</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>Identificación</td>
                                    <td>Familia</td>
                                </tr>
                                @foreach ($familias as $familia)
                                <tr>
                                    <td><input type="radio" class="familia" id="rcod_family{{$familia->cod_family}}" name="rcod_family" value="{{$familia->cod_family}}"/></td>
                                    <td>{{$familia->family_identity}}</td>
                                    <td>
                                        <div class="btn-group"> 
                                            @foreach($familia->detallefamilia as $tutor)
                                            <button type="button" class="btn btn-default">{{$tutor->NombreFamilia}}</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="doAsignFamilyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
@stop

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>

<script>
$(document).ready(function() {
    $(document).on('click', "#asignFamilyModal", function() {
        $("#doAsignFamilyModal").html('').removeClass('in').fadeOut('fast');
    });
    $(document).on('click', "#doContinue", function() {
        if (formIsvalid($('.form-control[required]'))) {
            var cod_family = $("#cod_family").val();
            if (cod_family === "0") {
                //console.log(cod_family);
                // alert("no asigno familia");
                //$('.modal-backdrop').addClass('in').fadeIn('fast');
                $("#doAsignFamilyModal").load("../estudiante/doasignfamily").addClass('in').fadeIn('fast');
            } else {
                $("#doAsignFamilyModal").load("../estudiante/docontinue").addClass('in').fadeIn('fast');

            }
        }
    });
    $(document).on('click', '#savestudent', function() {
        $("#doAsignFamilyModal").html('');

        if (formIsvalid($('.form-control[required]'))) {
            $('#formsavestudent').submit();
        }
    });
    $('.familia').change(function() {
        $("#cod_family").val($(this).val());
    });
    $('#fam').dataTable();
});
</script>
<script src="{{URL::to('/')}}/js/croppic.min.js"></script>
<script>
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



