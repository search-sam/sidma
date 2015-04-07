@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@stop

@section('content')
<<<<<<< HEAD
<div id="students" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
    <h1 class="page-header mypageheader">Estudiante <a data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo estudiante al sistema' href="{{action('EstudianteController@nuevo')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Estudiante</a> </h1>
    <div class="alert alert-success" <?= Session::has('message_student') ? '' : 'style="display:none"' ?> >
        <button  type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_student')}}
    </div>
    <div class="table-responive">
=======
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
    <h1 class="page-header">Estudiante <a href="{{action('EstudianteController@nuevo')}}" class="btn btn-success">Nuevo Estudiante</a> </h1>
    <div class="table-responsive">
>>>>>>> b248824688b330e9e66101235b80bafb5ae5f18a
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th>Plan de pago</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                <tr>
                    <td>

                        <?php
                        $student_can_enroll = 1;
                        $disabled = '';
                        $documentos = array();
                        $documents = $estudiante->academica->documentos($estudiante->cod_student);
                        $documentos['Partida de nacimiento'] = $documents->birth_certificate;
                        $documentos['Certificado de conducta'] = $documents->good_standing;
                        $documentos['Solvencia de pago'] = $documents->payment_solvency;
                        $documentos['Seguro escolar'] = $documents->insurance_student;
                        // $documentos['Compromiso del tutor'] = $documents->tutor_compromise_signature;
                        // $documentos['Compromiso del estudiante'] = $documents->student_compromise_signature;
                        //---------------------------------------------------------------------------------------
                       // echo "<div class='alert alert-danger' style='padding:5px;'>";
                        foreach ($documentos as $documento => $state) {
                            if ($state != 1) {
                                $student_can_enroll = 0;
                               // echo "<h6><i class='glyphicon glyphicon-warning-sign'></i> <strong>$documento</strong></h6>";
                            }
                        }
                       // echo "</div>";
                        if ($student_can_enroll == 0) {
                            $disabled = 'disabled';
                        }
                        ?>
                        {{($estudiante->student_state>0)?$estudiante->student_card:'<div class="btn-group"><div class="btn btn-sm btn-default"><i class="glyphicon glyphicon-info-sign"></i><strong> Registro previo</strong></div>'}}
                        <!--{{'<button id="'.$estudiante->cod_student.'" type="button" class="generate_enrollment btn btn-sm btn-primary '.$disabled.'"><strong> Registrar matricula</strong></button>'}}--></td>

                    <td>
                        {{$estudiante->first_name}}
                        <?= empty($estudiante->second_name) ? '' : $estudiante->second_name; ?>
                        {{$estudiante->first_last_name}}
                        <?= empty($estudiante->second_last_name) ? '' : $estudiante->second_last_name; ?>
                        <address style="color:#555;font-size: 12px;">
                            {{$estudiante->address_detail}}, <b>{{$estudiante->neighborhood_live}}</b>
                        </address>
                    </td>
                    <td>
                        <?php
                        $year = new Year;
                        $cod_school_year = $year->vigente()->cod_school_year;
                           $cod_concept_month = YearConcepto::whereRaw('cod_concept=4 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
                        $student_payment_plan = EstudiantePlandepago::where('cod_student', $estudiante->cod_student)->where('cod_year_payment_concept', $cod_concept_month)->first();
                        if (count($student_payment_plan)) {?>
                        <label class="label label-primary" style="padding: 7px 10px;">
                            <i class="glyphicon glyphicon-check"></i> {{Plandepago::find(YearPlandepago::find($student_payment_plan->cod_year_payment_plan)->cod_payment_plan)->plan_name}}
                        </label>
                            <?php }else{ ?>
                        <label class="label label-warning" style="padding: 7px 10px;">
                            <i class="glyphicon glyphicon-warning-sign"></i> No se ha definido
                        </label>
                       <?php } ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="edit btn btn-sm btn-default" href="{{action('EstudianteController@editar').'?id='.$estudiante->cod_student}}#estudiante"><span class="glyphicon glyphicon-edit"></span> Editar</a>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<<<<<<< HEAD
    <div class="modal fade" id='enrollment' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    </div>
</div>

=======
</div>
>>>>>>> b248824688b330e9e66101235b80bafb5ae5f18a
@stop

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {    
     $('[data-toggle="tooltip"]').tooltip();
   $(document).on('click','.generate_enrollment', function() {// función para generar la matricula
        $.ajax({
            type: "POST",
            url: "../estudiante/documents",
            dataType: "text",
            data: {cod_student: $(this).attr("id")},
            success: function() {
            },
            complete: function(response) {
                $("#enrollment").html(response.responseText).removeClass('fade').fadeIn('fast');
            }
        });
    });

    $(document).on('click', '.edit', function() {
        $(location).attr('href', $(this).attr('ref'));
    });
<<<<<<< HEAD


    $('#example').dataTable();

=======
>>>>>>> b248824688b330e9e66101235b80bafb5ae5f18a
});
</script>
@stop
