@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav bs-docs-sidenav">
        <li><a href="#lectiveyear"><b>Año lectivo</b></a></li>
        <li><a href="#shifts"><b>Turnos</b></a></li>
        <li><a href="#classrooms"><b>Aula de clases</b></a></li>
        <li><a href="#levels"><b>Niveles</b></a></li>
        <li><a href="#subjects"><b>Materias </b></a></li>
    </ul>
</div>
@stop

@section('content')
<div id="lectiveyear" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header" id="hschool_year">Año lectivo
        <button data-toggle="modal" data-target="#NewOrEditModal" id="NewYear"  class="btn btn-success">Nuevo año lectivo</button></h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> <th>Estado</th>
                    <th>Año Lectivo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Evaluaciones Semestrales</th>
                    <th>Nota Mínima</th>
                    <th>Créditos clases</th>
                    <th>Recargo Mora %</th>
                    <th>Limite Días </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($years as $year)
                <tr  id="{{$year->cod_school_year}}">
                    <td></td>
                    <td  class="trselect" ><a  href="{{action('AdmonacademicaController@periodos').'?cod_school_year='.$year->cod_school_year}}">{{$year->name_school_year}}</a></td>
                    <td>{{Util::FormatDate($year->date_from)}}</td>
                    <td>{{Util::FormatDate($year->date_to)}}</td>
                    <td>{{$year->evaluation_quantity_semester}}</td>
                    <td>{{$year->minimum_note}}</td>
                    <td>{{$year->minimum_failed_class}}</td>
                    <td>{{$year->surcharge_rate}}</td>
                    <td>{{$year->surcharge_limit_days}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$year->cod_school_year}}" type="button" data-toggle="modal" data-target="#NewOrEditModal" class="edityear btn btn-sm btn-default edit"><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="shifts" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header" id="hschool_year">Turnos <button id="NewShift" data-toggle="modal" data-target="#NewOrEditModal"  class="btn btn-success">Nuevo turno</button></h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> <th>Nombre turno</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnos as $turno)
                <tr  id="{{$turno->cod_shift}}">

                    <td>{{$turno->shift_name}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$turno->cod_shift}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editshift btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$turno->cod_shift}}" data-toggle="modal" data-target="#DelClassroomModal" class="bdeleteshift btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="classrooms" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    Loading classrooms...
</div>
<div id="levels" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header" id="hschool_year">Niveles <button id="NewSubject" data-toggle="modal" data-target="#NewOrEditModal"  class="btn btn-success">Nuevo nivel</button></h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> <th>Nombre nivel</th>
                    <th>Descripción</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($niveles as $nivel)
                <tr  id="{{$nivel->cod_level}}">

                    <td>{{$nivel->level_name}}</td>
                    <td>{{$nivel->description}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$nivel->cod_level}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editlevel btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$nivel->cod_level}}" data-toggle="modal" data-target="#DelClassroomModal" class="bdeletelevel btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="subjects" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header" id="hschool_year">Materias <button id="NewSubject" data-toggle="modal" data-target="#NewOrEditModal"  class="btn btn-success">Nueva materia</button></h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> <th>Nombre materia</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materias as $materia)
                <tr  id="{{$materia->cod_subject}}">

                    <td>{{$materia->subject_name}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$materia->cod_subject}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editsubject btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$materia->cod_subject}}" data-toggle="modal" data-target="#DelClassroomModal" class="bdeletesubject btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="DelClassroomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div class="modal fade" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
@stop


@section('js')
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#testinput").datepicker(/*{dateFormat: 'dd/mm/yy'}*/);
    $("#classrooms").load("../classroom/inicio");
    $("#NewClassroom").live("click", function() {
        $("#NewOrEditModal").load("../classroom/editar");
    });
    $("#NewYear").live("click", function() {
        $("#NewOrEditModal").load("../year/editar",function(){
             $(".inputdate").each(function() {
                $(".inputdate").each(function() {
                    var id = $(this).attr("id");
                    $("#" + id).datepicker({dateFormat: 'dd/mm/yy'});
                });
            });

        });
    });
    $("#NewLevel").live("click", function() {
        $("#NewOrEditModal").load("../nivel/editar");
    });
    $("#NewSubject").live("click", function() {
        $("#NewOrEditModal").load("../materia/editar");
    });
    $("#NewShift").live("click", function() {
        $("#NewOrEditModal").load("../turno/editar");
    });
    $("#CloseModal").live("click", function() {
        $("#NewOrEditModal").html("");
    });
    $(".close").live("click", function() {
        $("#NewOrEditModal").html("");
    });

    $(".bdeleteclassroom").live("click", function() {
        $("#DelClassroomModal").load("../classroom/borrar?current_classroom=" + $(this).attr('id'));
    });
    $(".bdeletelevel").live("click", function() {
        $("#DelClassroomModal").load("../nivel/borrar?current_level=" + $(this).attr('id'));
    });
    $(".bdeletesubject").live("click", function() {
        $("#DelClassroomModal").load("../materia/borrar?current_subject=" + $(this).attr('id'));
    });
    $(".bdeleteshift").live("click", function() {
        $("#DelClassroomModal").load("../turno/borrar?current_shift=" + $(this).attr('id'));
    });
    $(".creategroup").live("click", function() {
        $("#NewOrEditModal").load("../grupo/agregar?cod_classroom=" + $(this).attr('id'));
    });
     $(".changegroup").live("click", function() {
        $("#NewOrEditModal").load("../grupo/reasignar?cod_grupo=" + $(this).attr('id'));
    });
    $(".editclassroom").live("click", function() {
        $("#NewOrEditModal").load("../classroom/editar?cod_classroom=" + $(this).attr('id'));
    });
    $(".edityear").live("click", function() {
        $("#NewOrEditModal").load("../year/editar?cod_school_year=" + $(this).attr('id'), function() {
            $(".inputdate").each(function() {
                $(".inputdate").each(function() {
                    var id = $(this).attr("id");
                    $("#" + id).datepicker({dateFormat: 'dd/mm/yy'});
                });
            });


        });
    });
    $(".editlevel").live("click", function() {
        $("#NewOrEditModal").load("../nivel/editar?cod_level=" + $(this).attr('id'));
    });
    $(".editsubject").live("click", function() {
        $("#NewOrEditModal").load("../materia/editar?cod_subject=" + $(this).attr('id'));
    });
    $(".editshift").live("click", function() {
        $("#NewOrEditModal").load("../turno/editar?cod_shift=" + $(this).attr('id'));
    });
    $("#saveclassroom").live('click', function() {
        $("#formneweditclassroom").submit();
    });
    $("#savelevel").live('click', function() {
        $("#formneweditclassroom").submit();
    });
     $("#changegroup").live('click', function() {
        $("#formnewedit").submit();
    });
    $("table#tableclassroom button").live('click', function() {
        var cod_classroom = $(this).attr("id");
        $("#current_classroom").val(cod_classroom);
    });
    $("#deleteclassroom").live('click', function() {
        $("#formdeleteclassroom").submit();
    });
    $('#example').dataTable();

    $(document).live('click', '.edit', function() {
        $(location).attr('href', $(this).attr('ref'));
    });
    $(".trselect").live("click", function() {
        var cod_school_year = $(this).parent().attr("id");
    });
});
</script>
@stop
