@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/bootstrap-datepicker3.min.css">

@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav nav-pills">
        <li><a href="#lectiveyear"><b>Año lectivo</b> <span class="badge"></span></a></li>
        <li><a href="#shifts"><b>Turnos</b> <span class="badge">{{$turnos->count()}}</span></a></li>
        <li><a href="#classrooms"><i class="glyphicon glyphicon-"></i><b>Aula de clases</b> <span class="badge">{{$classrooms->count()}}</span></a></li>
        <li><a href="#levels"><b>Niveles</b> <span class="badge">{{$niveles->count()}}</span></a></li>	
        <li><a href="#subjects"><i class="glyphicon glyphicon-"></i><b>Materias</b> <span class="badge">{{$materias->count()}}</span></a></li>
    </ul>
</div>
@stop

@section('content')

<div id="lectiveyear" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Año lectivo 
        <button data-toggle="tooltip" data-placement="right" title='Se registrará un año lectivo al sistema'  id="NewYear"  class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo año lectivo</button></h1>
    <div class="alert alert-success" <?= Session::has('message_year') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_year')}}
    </div>
    <div class="table-responsivde">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="lectiveyears">
            <thead>
                <tr> 
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th>Inicia</th>
                    <th>Finaliza</th>
                    <th>Evaluaciones semestrales</th>
                    <th>Nota mínima</th>
                    <th>Créditos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($years as $year)
                <tr  id="{{$year->cod_school_year}}">
                    <td> {{($year->state_school_year==1)?'<label class="label label-success">Vigente</label>':'<label class="label label-warning">Inactivo</label>'}}</td>
                    <td  class="trselect" ><a  href="{{action('AdmonacademicaController@periodos').'?cod_school_year='.$year->cod_school_year}}"><i class="glyphicon glyphicon-folder-open"></i> {{$year->name_school_year}}</a></td>
                    <td>{{Util::FormatDate($year->date_from)}}</td>
                    <td>{{Util::FormatDate($year->date_to)}}</td>
                    <td>{{$year->evaluation_quantity_semester}}</td>
                    <td>{{$year->minimum_note}}</td>
                    <td>{{$year->minimum_failed_class}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$year->cod_school_year}}" type="button"  class="edityear btn btn-sm btn-default edit"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="shifts" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Turnos 
        <button data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo turno al sistema' id="NewShift"   class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo turno</button></h1>
       <div class="alert alert-success" <?= Session::has('message_shift') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_shift')}}
    </div>
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
                            <button id="{{$turno->cod_shift}}"  type="button"  class="editshift btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$turno->cod_shift}}"  class="deleteshift btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="classrooms" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Aulas de clases 
        <button data-toggle="tooltip" data-placement="right" title='Se registrará un nueva aula de clases al sistema' id="NewClassroom"  class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nueva aula</button>
   
</h1>
     <div class="alert alert-success" <?= Session::has('message_classroom') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_classroom')}}
    </div>
    <div class="alert alert-success" <?= Session::has('message_reasign') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_reasign')}}
    </div>
    <div class="alert alert-success" <?= Session::has('message_add') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_add')}}
    </div>
<div class="table-responsive">
    <table id="tableclassroom" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr> 
                <th>Aula</th>
                <th>Edificio</th>
                <th>Capacidad</th>
                <th>Descripción</th>
                  <th></th>
                <th>Grupo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classrooms as $classroom)
            <tr  id="{{$classroom->cod_classroom}}">
                <td>{{$classroom->classroom_name}}</td>
               <td>{{$classroom->building}}</td>
                <td>{{$classroom->capacity}}</td>
                <td>{{$classroom->description}}</td>
                <td>
                    <div class="btn-group">
                        <button id="{{$classroom->cod_classroom}}"  type="button"  class="editclassroom btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                    </div>
                    <div class="btn-group">
                        <button id="{{$classroom->cod_classroom}}" class="deleteclassroom btn btn-sm btn-warning">Eliminar</button>
                    </div>
                </td>
                <td><?= empty($classroom->grupo->cod_level)?"<div class='btn-group'><button id='".$classroom->cod_classroom."'  type='button' class='creategroup btn btn-sm btn-info' ><span class='glyphicon glyphicon-edit'></span> Crear grupo</button></div>":'<div class="btn-group"><div class="btn btn-sm btn-primary"><b>'.Nivel::find($classroom->grupo->cod_level)->level_name.''.$classroom->grupo->grupo_name."</b></div> <div class='btn-group'><button id='".$classroom->grupo->cod_grupo."' type='button' class='changegroup btn btn-sm btn-default' ><span class='glyphicon glyphicon-edit'></span> Reasignar</button></div></div>"?></td>
                
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<div id="levels" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Niveles 
        <button  data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo nivel académico al sistema' id="NewLevel"   class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo nivel</button></h1>
       <div class="alert alert-success" <?= Session::has('message_level') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_level')}}
    </div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="niveles">
            <thead>
                <tr> <th>Nombre nivel</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($niveles as $nivel)
                <tr  id="{{$nivel->cod_level}}">

                    <td>{{$nivel->level_name}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$nivel->cod_level}}"  type="button"  class="editlevel btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$nivel->cod_level}}"  class="deletelevel btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="subjects" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Materias 
        <button data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo materia de estudio al sistema' id="NewSubject"   class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nueva materia</button></h1>
       <div class="alert alert-success" <?= Session::has('message_subject') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_subject')}}
    </div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="materias">
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
                            <button id="{{$materia->cod_subject}}"  type="button"  class="editsubject btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$materia->cod_subject}}"  class="deletesubject btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal" id="DelClassroomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


</div>
<div class="modal" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.es.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable//jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
   // $("#testinput").datepicker(/*{dateFormat: 'dd/mm/yy'}*/);
    //$("#classrooms").load("../classroom/inicio");
    $(document).on("click","#NewClassroom",  function() {
        $("#NewOrEditModal").load("../classroom/editar");
    });
    $(document).on("click","#NewYear",function() {
        $("#NewOrEditModal").load("../year/editar", function() {
            $(".inputdate").each(function() {
                $(".inputdate").each(function() {
                    var id = $(this).attr("id");
                    $("#" + id).datepicker({dateFormat: 'dd/mm/yy'});
                });
            });

        });
    });
    $(document).on("click","#NewLevel", function() {
        $("#NewOrEditModal").load("../nivel/editar");
    });
    $(document).on("click","#NewSubject", function() {
        $("#NewOrEditModal").load("../materia/editar");
    });
    $(document).on("click","#NewShift", function() {
        $("#NewOrEditModal").load("../turno/editar");
    });
    $(document).on("click","#CloseModal", function() {
        $("#NewOrEditModal").html("");
    });
    $(document).on("click",".close", function() {
        $("#NewOrEditModal").html("");
    });

    $(document).on("click",".deleteclassroom", function() {
        $("#DelClassroomModal").load("../classroom/borrar?current_classroom=" + $(this).attr('id'));
    });
    $(document).on("click",".deletelevel", function() {
        $("#DelClassroomModal").load("../nivel/borrar?current_level=" + $(this).attr('id'));
    });
    $(document).on("click",".deletesubject", function() {
        $("#DelClassroomModal").load("../materia/borrar?current_subject=" + $(this).attr('id'));
    });
    $(document).on("click",".deleteshift", function() {
        $("#DelClassroomModal").load("../turno/borrar?current_shift=" + $(this).attr('id'));
    });
    $(document).on("click",".creategroup", function() {
        $("#NewOrEditModal").load("../grupo/agregar?cod_classroom=" + $(this).attr('id'));
    });
    $(document).on("click",".changegroup", function() {
        $("#NewOrEditModal").load("../grupo/reasignar?cod_grupo=" + $(this).attr('id'));
    });
    $(document).on("click",".editclassroom",function() {
        $("#NewOrEditModal").load("../classroom/editar?cod_classroom=" + $(this).attr('id'));
    });
    $(document).on("click",".edityear", function() {
        $("#NewOrEditModal").load("../year/editar?cod_school_year=" + $(this).attr('id'), function() {
            $(".inputdate").each(function() {
                var id = $(this).attr("id");
                $("#" + id).datepicker({dateFormat: 'dd/mm/yy'});
            });



        });
    });
    $(document).on("click",".editlevel", function() {
        $("#NewOrEditModal").load("../nivel/editar?cod_level=" + $(this).attr('id'));
    });
    $(document).on("click",".editsubject", function() {
        $("#NewOrEditModal").load("../materia/editar?cod_subject=" + $(this).attr('id'));
    });
    $(document).on("click",".editshift", function() {
        $("#NewOrEditModal").load("../turno/editar?cod_shift=" + $(this).attr('id'));
    });
  
    $(document).on('click',"#changegroup", function() {
        $("#formnewedit").submit();
    });
    $(document).on('click',"table#tableclassroom button", function() {
        var cod_classroom = $(this).attr("id");
        $("#current_classroom").val(cod_classroom);
    });
    $(document).on('click',"#deleteclassroom", function() {
        $("#formdeleteclassroom").submit();
    });   

    $(document).on('click', '.edit', function() {
        $(location).attr('href', $(this).attr('ref'));
    });
    $(document).on("click",".trselect", function() {
        var cod_school_year = $(this).parent().attr("id");

    });
   

});
</script>

@stop


