@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">

<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/bootstrap-datepicker3.min.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav nav-sidebar">
        <li><a href="#periods"><b>Períodos</b> <span class="badge">{{$periodos->count()}}</span></a></li>
        <li><a href="#groupsyear"><b>Grupos/Año lectivo</b> <span class="badge">{{$grupoyears->count()}}</span></a></li>
    </ul>
</div>
@stop
@section('content')
<div id="periods" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h3 class="page-header" id="hschool_year"><a href="{{action('AdmonacademicaController@inicio')}}" ><i class="glyphicon glyphicon-level-up"></i> Académica</a> » {{$year->name_school_year}} » Periodos <?php if (count($periodos) == 0) { ?> <a href="{{action('PeriodoController@generar')}}?cod_school_year={{$year->cod_school_year}}" id="newperiod" type="button" class="btn btn-success" >Generar períodos</a><?php } ?>
        <button id="showperiods" class="btn btn-info"><span class="glyphicon glyphicon-menu-down"></span> Mostrar</button>
    </h3>
    <div id="periodsyear" class="table-responsdive" style="display: none;">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="tableperiod">
            <thead>
                <tr>
                    <th>Nombre Período</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>                   
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($periodos as $periodo)
                <tr>
                    <td>{{$periodo->period_name}}</td>
                    <td><input readonly="readonly" id="date_from_{{$periodo->cod_period}}" class="inputdate form-control" id="fechainicio" nombre="fechainicio" value="{{Util::FormatDate($periodo->date_from)}}" /></td>
                    <td><input readonly="readonly" id="date_to_{{$periodo->cod_period}}" class="inputdate form-control" id="fechafin" nombre="fechafin" value="{{Util::FormatDate($periodo->date_to)}}" /></td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$periodo->cod_period}}"  type="button"  class="editperiod btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <!-- <button id="{{$periodo->cod_period}}" data-toggle="modal" data-target="#DelModal" class="btn btn-warning">Eliminar</button>
                        -->
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="groupsyear" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="page-header mypageheader" id="hschool_year">
        <a href="{{action('AdmonacademicaController@inicio')}}" ><i class="glyphicon glyphicon-level-up"></i> Académica</a> » {{$year->name_school_year}} » Grupos <button id="NewGroup" type="button"   class="btn btn-success" <?= (count($grupos::Notasigned($year->cod_school_year))==0)?'disabled':''?>>Nuevo grupo</button>
    </h2>
    <div class="alert alert-success" <?= Session::has('message_group_year') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_group_year')}}
    </div>
    <div class="alert alert-success" <?= Session::has('message_class') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_class')}}
    </div>
  
    <div class="table-responsivess">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table_grupos">
            <thead>
                <tr> <th>Grupo</th>
                    <th>Docente guía</th>
                    <th>Turno</th>
                    <th>Clases</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $empleado = New Empleado;
                ?>
                @foreach($grupoyears as $grupoyear)
                
                <tr  id="{{$grupoyear->cod_year_grupo}}">
                    <td><b>{{Nivel::find(Grupo::find($grupoyear->cod_grupo)->cod_level)->level_name}}{{$grupos::find($grupoyear->cod_grupo)->grupo_name}}</b>, 
                            {{Classroom::find($grupos::find($grupoyear->cod_grupo)->cod_classroom)->building}}, 
                            aula {{Classroom::find($grupos::find($grupoyear->cod_grupo)->cod_classroom)->classroom_name}}</td>
                    <td>{{$empleado::find($docentes::find($grupoyear->cod_teacher)->cod_employee)->first_name}} {{$empleado::find($docentes::find($grupoyear->cod_teacher)->cod_employee)->first_last_name}}</td>
                    <td>{{$turnos::find($grupoyear->cod_shift)->shift_name}}</td>
                    <td>                        
                        <div class="list-group">                      
                            @foreach($grupoyear->materias as $materia)              
                            <?php
                            ?>
                            <a  id="{{$materia->CodClass($materia->cod_subject,$materia->pivot->cod_year_grupo)->cod_class}}_{{$grupoyear->cod_year_grupo}}" class="subject list-group-item">
                                <h5 class="list-group-item-heading"> <strong> {{$materia->subject_name}}</strong></h5>
                                <h6 class="list-group-item-text" >{{Docente::find(Clase::find($materia->CodClass($materia->cod_subject,$materia->pivot->cod_year_grupo)->cod_class)->cod_teacher)->NameTeacher(Docente::find(Clase::find($materia->CodClass($materia->cod_subject,$materia->pivot->cod_year_grupo)->cod_class)->cod_teacher)->cod_employee)->first_name}} {{Docente::find(Clase::find($materia->CodClass($materia->cod_subject,$materia->pivot->cod_year_grupo)->cod_class)->cod_teacher)->NameTeacher(Docente::find(Clase::find($materia->CodClass($materia->cod_subject,$materia->pivot->cod_year_grupo)->cod_class)->cod_teacher)->cod_employee)->first_last_name}}</h6>
                            </a>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$grupoyear->cod_year_grupo}}"  type="button"  class="editgroup btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span> Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$grupoyear->cod_year_grupo}}"  type="button"  class="addclass btn btn-sm btn-info edit" ><span class="glyphicon glyphicon-plus"></span> Agregar clase</button>
                        </div>
                        <!--<div class="btn-group">
                            <button id="{{$grupoyear->cod_year_grupo}}" data-toggle="modal" data-target="#DelModal" class="bdeletegroup btn btn-sm btn-warning">Eliminar</button>
                        </div>-->
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formdeleteperiod" action="{{action('PeriodoController@borrar')}}?cod_school_year={{$year->cod_school_year}}" method="post">
            <input type="hidden" id="current_period" name="current_period" value=""/>
            <div class="modal-content">
                <div class="modal-header">
                    Año Lectivo » {{$year->name_school_year}}
                </div>
                <div class="alert alert-warning"> Esta seguro que desea eliminar este Período?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="deleteperiod" data-dismiss="modal">Ok, eliminar</button>
                </div>
            </div>
        </form>

    </div>

</div>
<input type="hidden" id="current_cod_school_year" value="{{$year->cod_school_year}}" />
<div class="modal fade" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


@section('js')

<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.es.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript">
$(document).ready(function() {
 $('#table_grupos').dataTable();
    $(document).on('change',".inputdate", function() {
        $.ajax({
            type: "POST",
            url: "../periodo/actualizarfechaperiodo",
            dataType: "text",
            data: {
                field: $(this).attr("id"),
                value: $(this).val()
            },
            success: function() {
            },
            complete: function() {
            }
        });
    });
    $(document).on("click",".subject", function() {
         $('#NewOrEditModal').html('<div class="modal-dialog">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+               
                '<h5 class="modal-title " id="myModalLabel">SIDMA :: Cargando...</h5>'+ 
            '</div>'+ 
            '<div class="modal-body">'+ 
                '<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Cargando...</span>'+ 
                    '</div>'+ 
                '</div>'+ 
            '</div>'+ 
        '</div>'+
       '</div>');
        $('#NewOrEditModal').modal('show');
        var div = $(this).attr('id').split('_');
        var cod_class = div[0];
        var cod_year_grupo = div[1];
        $("#NewOrEditModal").load("../clase/editarclase?cod_class=" + cod_class + '&cod_year_grupo=' + cod_year_grupo);
    });
    $(document).on('click','.close', function() {
        $("#NewOrEditModal").html('');
    });
    $(document).on("click",".addclass", function() {
        $("#NewOrEditModal").load("../clase/editarclase?cod_year_grupo=" + $(this).attr('id'));
    });
    $(document).on("click","#NewGroup",function() {
        $("#NewOrEditModal").load("../grupo/gruposyear?cod_school_year=" + $("#current_cod_school_year").val());
    });
    $(document).on("click",".editgroup", function() {
        $("#NewOrEditModal").load("../grupo/gruposyear?cod_school_year=" + $("#current_cod_school_year").val() + '&&cod_year_grupo=' + $(this).attr('id'));
    });
    $(document).on("click",".editperiod",function() {
        var id = $(this).attr("id");
        var text = $(this).text();
        if (text === "Editar") {
            $(this).text('');
            $(this).append('<span class="glyphicon glyphicon-edit"></span>Listo');
            $(this).addClass("btn-info");
            $(".inputdate[id=date_from_" + id + "]").datepicker({dateFormat: 'dd/mm/yy'});
            $(".inputdate[id=date_to_" + id + "]").datepicker({dateFormat: 'dd/mm/yy'});
            $(".inputdate[id=date_from_" + id + "]").removeAttr('readonly');
            $(".inputdate[id=date_to_" + id + "]").removeAttr('readonly');
        } else {
            $(".inputdate[id=date_from_" + id + "]").attr('readonly', 'readonly');
            $(".inputdate[id=date_to_" + id + "]").attr('readonly', 'readonly');
            $(this).removeClass("btn-info");
            $(this).text('');
            $(this).append('<span class="glyphicon glyphicon-edit"></span>Editar');
        }
    });
    $(document).on('click','#showperiods', function() {
        var div = $(this);
        if (div.html() === '<span class="glyphicon glyphicon-menu-down"></span> Mostrar') {
            div.html('<span class="glyphicon glyphicon-menu-up"></span> Ocultar')
        } else {
            div.html('<span class="glyphicon glyphicon-menu-down"></span> Mostrar')
        }
        $('#periodsyear').toggle('slow', function() {


        })
    });
    $(document).on('click',"table#tableperiod button", function() {
        var cod_period = $(this).attr("id");
        $("#current_period").val(cod_period);
    });

    $(document).on('click',"#deleteperiod", function() {
        $("#formdeleteperiod").submit();
    });
});
</script>
@stop
