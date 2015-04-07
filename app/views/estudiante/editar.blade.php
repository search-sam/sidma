@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/croppic.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/docs.css" rel="stylesheet">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav bs-docs-sidenav">
        <li><a href="#guardar"><i class="glyphicon glyphicon-save"></i> <b>Guardar</b></a></li>
        <li><a href="#inicio"><i class="glyphicon glyphicon-home"></i> <b>Inicio</b></a></li>	
    </ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h4 class="page-header" style="margin-bottom: 3px;"><a href="{{action('EstudianteController@inicio')}}"><i class="glyphicon glyphicon-level-up"></i> Estudiante</a> » <b>{{$estudiante->first_name}} {{$estudiante->first_last_name}}</b> <i class="glyphicon glyphicon-pencil"></i></h4>
    <div class="">
        <!-- Pestañas -->
        <ul id="mytab" class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#estudiante">Información del Estudiante</a></li>
            <!--<li><a href="#familiainfo">Información Familiar</a></li>-->
            <li><a href="#academica">Información Académica</a></li>
            <li><a href="#administrativa">Información Administrativa</a></li>
            <li><a href="#medica">Información Médica</a></li>
            <li><a href="#documentos">Documentos</a></li>
        </ul>

        <!-- Paneles -->
        <div class="tab-content">
            <?php $year = new Year; ?>
            <div class="alert alert-danger alert-dismissable" style="display: none;">                    
                <i class="glyphicon glyphicon-info-sign"></i> Complete los campos vacios. <strong>No se guardaron los datos.</strong>
            </div>
            <div class="indicator"></div>
            <form id="formupdate" action="{{action('EstudianteController@actulizar')}}" method="post" class="form-horizontal" role="form">
                <input type="text" name="estudiante_id" id="estudiante_id" value="{{$estudiante->cod_student}}" style="display:none;"/>
                <div class="tab-pane active" id="estudiante">
                    {{-- Informacion del Estudiante --}}
                    <div class="form-group">
                        <label for="nombre1" class="col-sm-2 control-label">Primer nombre:</label>
                        <div class="col-sm-4 has-feedback">
                            <input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer Nombre" value="{{$estudiante->first_name}}" required>
                        </div>
                        <label for="nombre2" class="col-sm-2 control-label">Segundo nombre:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nombre2"  name="nombre2" placeholder="Segundo Nombre" value="{{$estudiante->second_name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="apellido1" class="col-sm-2 control-label">Primer apellido:</label>
                        <div class="col-sm-4 has-feedback">
                            <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" value="{{$estudiante->first_last_name}}" required>
                        </div>
                        <label for="apellido2" class="col-sm-2 control-label">Segundo apellido:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Nombre" value="{{$estudiante->second_last_name}}">
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <label for="genero" class="col-sm-2 control-label">Genero:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="genero" name="genero" >
                                <option {{$estudiante->student_gender==0?'selected':''}} value="0">Masculino</option>
                                <option {{$estudiante->student_gender==1?'selected':''}} value="1">Femenino</option>
                            </select>
                        </div>
                        <label for="correo" class="col-sm-2 control-label">Email:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="correo" name="correo" placeholder="Email" value="{{$estudiante->email}}">
                        </div>
                    </div>

                    <!--
                    <div class="form-group">
                        <label for="correo" class="col-sm-3 control-label">Foto:</label>
                        <div class="col-lg-3 ">
                            <div id="cropContaineroutput">
                                <img class="croppedImg" src="{{$estudiante->student_photo}}">
                            </div>
                            <input type="text" id="cropOutput" name="foto" style="display:none;"/>
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label for="dia" class="col-sm-2 control-label">Nacimiento (d/m/a):</label>
                        <div class="col-sm-1" style="width:9.3333%">
                            <select class="form-control" id="dia" name="dia" >
                                @for ($i = 0; $i < 31; $i++)
                                <option {{date('j',$estudiante->birth_date)==($i+1)?'selected':''}} value="{{$i+1}}">{{$i+1}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-2" style="width:13.6666%;">
                            <select class="form-control" id="mes" name="mes" >
                                @foreach (Util::$meses as $j => $mes)
                                <option {{date('n',$estudiante->birth_date)==$j?'selected':''}} value="{{$j}}">{{$mes}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2" style="width:10.5555%;">
                            <select class="form-control" id="anyo" name="anyo" >
                                @for ($i = 1990; $i <= date('Y'); $i++)
                                <option {{date('Y',$estudiante->birth_date)==$i?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <h4 class="page-header" ></h4>
                    <div class="form-group">
                        <label for="nacimiento-pais" class="col-sm-2 control-label">Pa&iacute;s/Nacimiento:</label>
                        <div class="col-sm-2 has-feedback">
                            <input type="text" class="form-control" id="nacimiento-pais" name="nacimiento-pais" placeholder="Pa&iacute;s" value="{{$estudiante->birth_country}}" required/>
                        </div>
                        <label for="nacimiento-ciudad" class="col-sm-2 control-label">Ciudad/Nacimiento:</label>
                        <div class="col-sm-2 has-feedback">
                            <input type="text" class="form-control" id="nacimiento-ciudad" name="nacimiento-ciudad" placeholder="Ciudad" value="{{$estudiante->birth_city}}" required/>
                        </div>
                        <label for="ciudad-casa" class="col-sm-2 control-label">Cuidad (actual):</label>
                        <div class="col-sm-2 has-feedback">
                            <input type="text" class="form-control" id="ciudad-casa" name="ciudad-casa" placeholder="Ciudad" value="{{$estudiante->city_live}}" required />
                        </div>
                    </div>
                    <h4 class="page-header" ></h4>
                    <div class="form-group">
                        <label for="barrio" class="col-sm-2 control-label">Barrio/Reparto:</label>
                        <div class="col-sm-4 has-feedback">
                            <input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio/Reparto" value="{{$estudiante->neighborhood_live}}" required/>
                        </div>
                        <label for="num-casa" class="col-sm-2 control-label">N&uacute;mero de casa:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="num-casa" name="num-casa" placeholder="N° Casa" value="{{$estudiante->house_number}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dir" class="col-sm-2 control-label">Direcci&oacute;n exacta:</label>
                        <div class="col-sm-10 has-feedback">
                            <textarea class="form-control" style="resize: none;" rows="1"id="dir" name="dir" placeholder="Direcci&oacute;n" required>{{$estudiante->address_detail}}</textarea>
                        </div>
                    </div>

                    {{-- ==================================================================================================== --}}
                </div>
                {{-- Informacion Parental --}}
                <!-- <div class="tab-pane" id="familiainfo" style="display:none;">
 
                 </div>-->
                {{-- ==================================================================================================== --}}

                <div class="tab-pane" id="academica" style="display:none;">
                    {{-- Informacion Academica --}}
                    <div class="form-group">
                        <label for="grado" class="col-sm-3 control-label">¿Último grado que cursó?</label>
                        <div class="col-sm-9 has-feedback">
                            <select class="form-control" id="grado" name="grado" required >
                                @foreach ($grados as $grado)
                                <option {{$estudiante->academica->level_course==$grado->cod_level?'selected':''}} value="{{$grado->cod_level}}">
                                    @if ($grado->level_name == 'PK-2')
                                    Pre-Kinder 2 A&ntilde;o
                                    @elseif ($grado->level_name == 'PK-3')
                                    Pre-Kinder 3 A&ntilde;o
                                    @elseif ($grado->level_name == 'K')
                                    Kinder
                                    @else
                                    {{$grado->level_name}}&deg; Grado
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="checkbox" class="col-sm-3 control-label">¿A estudiado antes?</label>
                        <div class="col-sm-9">
                            <input type="checkbox" name="estudiado" id="checkbox" {{$estudiante->academica->studied_before==1?'checked':''}} value="1">
                        </div>
                    </div>
                    {{-- Colegio anterior --}}
                    <div id="antes" {{$estudiante->academica->studied_before==1?'':'style="display:none;"'}}>
                        <div class="form-group">
                            <label for="colegio" class="col-sm-3 control-label">Colegio del que proviene el estudiante:</label>
                            <div class="col-sm-9 has-feedback">
                                <input type="text" class="form-control" id="colegio" name="colegio" placeholder="Colegio" value="{{$estudiante->academica->last_school}}" required>
                                <span class="help-block">No Aplica si el alumno no ha asistido al colegio.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="col-pais" class="col-sm-3 control-label">Cuidad del colegio al que asistio el estudiante:</label>
                            <div class="col-sm-9 has-feedback">
                                <input type="text" class="form-control" id="col-pais" name="col-pais" placeholder="Ciudad" value="{{$estudiante->academica->city_last_school}}" required>
                                <span class="help-block">Pa&iacute;s en caso que quede fuera de Nicaragua.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="grados" class="col-sm-3 control-label">Grados/A&ntilde;os que curso el estudiante:</label>
                            <div class="col-sm-9">
                                <span class="help-block">Seleccionar todos los grados que estudió en ese colegio.</span>
                                <?php
                                $other_completed_grade_checked = '';
                                $grados_disabled = 'disabled';
                                $other_grades = '';
                                foreach (Util::strtoarr($estudiante->academica->completed_grade) as $completed_grade => $cg) {
                                    if (intval($cg) == 0) {
                                        $other_completed_grade_checked = 'checked="checked"';
                                        $grados_disabled = '';
                                        $other_grades = $cg;
                                        break;
                                    }
                                }
                                ?>
                                @foreach ($grados as $grado)
                                <?php
                                $grados_checked = '';

                                if (in_array($grado->cod_level, Util::strtoarr($estudiante->academica->completed_grade))) {
                                    $grados_checked = "checked='checked'";
                                }
                                ?>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="cursos[]" {{$grados_checked}} value="{{$grado->cod_level}}" class="elemento"> 
                                    @if ($grado->level_name == 'PK-2')
                                    Pre-Kinder 2 A&ntilde;o
                                    @elseif ($grado->level_name == 'PK-3')
                                    Pre-Kinder 3 A&ntilde;o
                                    @elseif ($grado->level_name == 'K')
                                    Kinder
                                    @else 
                                    {{$grado->level_name}}&deg; Grado
                                    @endif
                                </label>
                                @endforeach
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input {{$other_completed_grade_checked}} type="checkbox" id="curso-check"> Otro
                                    </span>
                                    <input value='{{$other_grades}}' type="text" class="form-control" id="curso-input" name="cursos[]" {{$grados_disabled}}>	
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- -------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="num-casa" class="col-sm-3 control-label">Motivo por el que el alumno está cambiando de Colegio:</label>
                        <div class="col-sm-9">
                            <span class="help-block">Puede seleccionar varias opciones.</span>
                            <?php
                            $reason_checked = '';
                            $other_reason = '';
                            $reason_disabled = 'disabled';
                            foreach (Util::strtoarr($estudiante->academica->reason_changing_school) as $reason => $rcs) {
                                if (intval($rcs) == 0) {
                                    $reason_checked = 'checked="checked"';
                                    $other_reason = $rcs;
                                    $reason_disabled = '';
                                    break;
                                }
                            }
                            ?>
                            @foreach (Util::$motivo as $i => $l)                            
                            <?php
                            $motivo_checked = "";
                            if (in_array($i, Util::strtoarr($estudiante->academica->reason_changing_school))) {
                                $motivo_checked = "checked='checked'";
                            }
                            ?>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="grados" {{$motivo_checked}} name="cambios[]" value="{{$i}}"> {{$l}}
                            </label>
                            @endforeach
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input {{ $reason_checked}} type="checkbox" id="cambio-check"> Otro
                                </span>
                                <input type="text" value='{{$other_reason}}' class="form-control" name="cambios[]" id="cambio-input" {{$reason_disabled}}>	
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num-casa" class="col-sm-3 control-label">¿Por qu&eacute; escogi&oacute; el Angloameriacano?</label>
                        <div class="col-sm-9">
                            <span class="help-block">Puede seleccionar varias opciones.</span>
                            <?php
                            $choose_checked = '';
                            $choose_disabled = 'disabled';
                            $other_choose = '';
                            foreach (Util::strtoarr($estudiante->academica->reason_chose_school) as $choose => $ch) {
                                if (intval($ch) == 0) {
                                    $choose_checked = 'checked="checked"';
                                    $choose_disabled = '';
                                    $other_choose = $ch;
                                    break;
                                }
                            }
                            ?>
                            @foreach (Util::$escogio as $i => $l)
                            <?php
                            $escogio_checked = '';
                            if (in_array($i, Util::strtoarr($estudiante->academica->reason_chose_school))) {
                                $escogio_checked = "checked='checked'";
                            }
                            ?>
                            <label class="checkbox-inline">
                                <input type="checkbox" {{$escogio_checked}} id="grados" name="escogio[]" value="{{$i}}"> {{$l}}
                            </label>
                            @endforeach
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input {{$choose_checked}} type="checkbox" id="escogio-check"> Otro
                                </span>
                                <input type="text" value='{{$other_choose}}' class="form-control" id="escogio-input" name="escogio[]" {{$choose_disabled}}>	
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num-casa" class="col-sm-3 control-label">¿C&oacute;mo escuch&oacute; del Angloamericano?</label>
                        <div class="col-sm-9">
                            <span class="help-block">Puede seleccionar varias opciones.</span>
                            <?php
                            $met_checked = '';
                            $other_met = '';
                            $met_disabled = 'disabled';
                            foreach (Util::strtoarr($estudiante->academica->way_met_school) as $wey_met => $wms) {
                                if (intval($wms) == 0) {
                                    $met_checked = 'checked="checked"';
                                    $other_met = $wms;
                                    $met_disabled = '';
                                    break;
                                }
                            }
                            ?>
                            @foreach (Util::$escucho as $i => $l)
                            <?php
                            $escucho_checked = "";
                            if (in_array($i, Util::strtoarr($estudiante->academica->way_met_school))) {
                                $escucho_checked = "checked='checked'";
                            }
                            ?>
                            <label class="checkbox-inline">
                                <input type="checkbox" {{$escucho_checked}} name="saber[]" value="{{$i}}"> {{$l}}
                            </label>
                            @endforeach
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input {{$met_checked}} type="checkbox" id="grado-check"> Otro
                                </span>
                                <input type="text" value='{{$other_met}}' id="grado-input" class="form-control"  name="saber[]" {{$met_disabled}}>	
                            </div>
                        </div>            </div>
                    {{-- ==================================================================================================== --}}
                </div>
                <div class="tab-pane" id="administrativa" style="display:none;">
                    {{-- Informacion Administrativa --}}
                    <div class="form-group">
                        <label for="tutor" class="col-sm-3 control-label">¿Con quien vive el estudiante?</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="tutor" name="tutor">
                                <?php
                                $tutor = Util::$tutor;
                                ?>
                                @foreach ($tutor as $indice => $valor)                     

                                <option <?= ($estudiante->administrativa->whom_student_live == $indice) ? ' selected="selected" ' : '' ?> value="{{$indice}}">{{$valor}}</option>
                                @endforeach
                            </select>
                            <div id="tutor-input" <?= ($estudiante->administrativa->whom_student_live != 5) ? ' style="display:none;" ' : '' ?> >
                                <br/>
                                <input type="text" class="form-control" name="tutorinput" placeholder="Otro" value="
                                       @if($estudiante->administrativa->whom_student_live==5)
                                       {{$estudiante->administrativa->other_tutor}}
                                       @endif 
                                       ">
                            </div>
                        </div>
                        <label for="pago" class="col-sm-3 control-label">¿Responsable del pago de aranceles?</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="pago" name="pago">
                                @foreach ($tutor as $indice => $valor)
                                <option <?= ($estudiante->administrativa->payment_responsable == $indice) ? ' selected="selected" ' : '' ?> value="{{$indice}}">{{$valor}}</option>
                                @endforeach
                            </select>
                            <div id="pago-input" <?= ($estudiante->administrativa->payment_responsable != 5) ? ' style="display:none; "' : '' ?>>
                                <br/>
                                <input type="text" class="form-control" name="pagoinput" placeholder="Otro" value="
                                       @if($estudiante->administrativa->payment_responsable==5)
                                       {{$estudiante->administrativa->other_payment_responsable}}
                                       @endif
                                       ">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                        $cod_year_payment_plan = '';
                        $cod_concept_month = YearConcepto::whereRaw('cod_concept=4 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
                        $student_payment_plan = EstudiantePlandepago::where('cod_student', $estudiante->cod_student)->where('cod_year_payment_concept', $cod_concept_month)->first();
                        if (count($student_payment_plan)) {
                            $cod_year_payment_plan = $student_payment_plan->cod_year_payment_plan;
                        }
                        ?>
                        <input type="hidden" id="cod_student_payment_plan" name="cod_student_payment_plan"  value="<?= empty($cod_year_payment_plan) ? '' : $student_payment_plan->cod_student_payment_plan ?>"/>
                        <label for="plandepago" class="col-sm-3 control-label">Plan de pago</label>
                        <input id="myplandepago" name="myplandepago" type="hidden" value="{{$cod_year_payment_plan}}"/>
                        <div class="col-sm-9">  
                            <select <?= empty($cod_year_payment_plan) ? '' : 'disabled' ?>  class="form-control" id="plandepago" name="plandepago">
                                <option value="0">Seleccione un plan de pago</option>
                                @foreach ($year_payment_plans as $payment_plan)
                                <option <?= empty($cod_year_payment_plan) ? '' : (($cod_year_payment_plan == $payment_plan->cod_year_payment_plan) ? 'selected' : '') ?> value="{{$payment_plan->cod_year_payment_plan}}">{{Plandepago::find($payment_plan->cod_payment_plan)->plan_name}} ( {{$payment_plan->discount_rate}}% Descuento ) </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="detalleplandepago" style="display: none;" >
                        <div class="col-sm-12">  
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3  class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Debe especificar el mes que iniciarán los pagos y el límite de días de pago. El descuento aplica para todos los conceptos de pago.
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Método de pago</label> 
                                        <div class="col-sm-9">                                       
                                            <select id="metododepago" name="metododepago" class="form-control">
                                                @foreach(Metododepago::all() as $payment_method)
                                                <option <?= empty($cod_year_payment_plan) ? '' : (($student_payment_plan->cod_payment_method == $payment_method->cod_payment_method) ? 'selected' : '') ?> value="{{$payment_method->cod_payment_method}}">{{$payment_method->payment_method}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Descuento</label> 
                                        <div class="col-sm-9">
                                            <select id="descuento" name="descuento" class="form-control">
                                                @foreach($year_discounts as $year_discount)
                                                <?php
                                                $disabled = '';
                                                if (preg_match('/herman/i', Descuento::find($year_discount->cod_discount)->discount_name)) {
                                                    $descuento = explode(' ', Descuento::find($year_discount->cod_discount)->discount_name);
                                                    $disabled = 'disabled';
                                                    if (count(Familia::find($estudiante->cod_family)->estudiantes) == intval($descuento[1])) {
                                                        $disabled = '';
                                                    }
                                                }
                                                ?>
                                                <option <?= empty($cod_year_payment_plan) ? '' : (($student_payment_plan->cod_year_discount == $year_discount->cod_year_discount) ? 'selected' : '') ?> {{$disabled}} value="{{$year_discount->cod_year_discount}}">{{Descuento::find($year_discount->cod_discount)->discount_name}} ( {{$year_discount->discount_rate}}%)</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Inicia pago ( Mes )</label> 
                                        <div class="col-sm-9">
                                            <select id="iniciames" name="iniciames" class="form-control">
                                                <?php
                                                $inicia_mes_lectivo = date('m', strtotime($year->vigente()->date_from));
                                                $inicia_pago = date('Y', strtotime($year->vigente()->date_from)) . '-' . date('m', strtotime($year->vigente()->date_from)) . '-01';
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $value = intval(date('m', strtotime($inicia_pago)));                                                   
                                                        ?>
                                                        <option <?= empty($cod_year_payment_plan) ? '' : (($student_payment_plan->begin_payment_month == $i) ? 'selected' : '') ?> value="<?= $i ?>">mes <?= $i . ' :: ' . Util::$meses[$value] . ' - ' . date('Y', strtotime($inicia_pago)); ?></option>
                                                        <?php
                                                  
                                                    $inicia_pago = date('Y-m-d', strtotime('+1 month', strtotime($inicia_pago)));
                                              
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Límite de días de pago</label> 
                                        <div class="col-sm-9">
                                            <input id="limitedias" name="limitedias" class="form-control" value="<?= empty($cod_year_payment_plan) ? '5' : $student_payment_plan->limit_payment_days ?>" readonly/>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    {{-- ==================================================================================================== --}}
                </div>
                <div class="tab-pane" id="medica" style="display:none;">
                    {{-- Informacion Medica --}}
                    <div class="form-group">
                        <label for="alergia" class="col-sm-3 control-label">Alergias comunes:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alergia" name="alergia" placeholder="Alergias" value="{{$estudiante->medica->common_allergie}}">
                            {{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="medicamento" class="col-sm-3 control-label">Alergia a medicamentos:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="medicamento" name="medicamento" placeholder="Medicamentos" value="{{$estudiante->medica->medicine_allergie}}">
                            {{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="impedimento" class="col-sm-3 control-label">Impedimento f&iacute;sico:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="impedimento" name="impedimento" placeholder="Impedimento" value="{{$estudiante->medica->physical_impediment}}">	
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="enfermedad" class="col-sm-3 control-label">Enfermedades permanentes:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="enfermedad" id="enfermedad" placeholder="Enfermedad" value="{{$estudiante->medica->permanet_illness}}">
                            {{-- <span class="help-block">Si es mas de una por favor separelas con comas.</span> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emergencia" class="col-sm-3 control-label">N&uacute;mero de emergencia</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="emergencia" name="emergencia" placeholder="Telefono" value="{{$estudiante->medica->emergency_cal}}">
                            <br>
                            <input type="text" class="form-control" name="emergencia-nombre" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comentario" class="col-sm-3 control-label">Comentario:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" id="comentario" name="comentario">{{$estudiante->medica->comment}}</textarea>
                        </div>
                    </div>
                    {{-- ==================================================================================================== --}}
                </div>
                <div class="tab-pane" id="documentos" style="display:none;">
                    {{-- Documentos --}}
                    {{-- Documentos Academicos --}}
                    <div class="form-group">
                        <label for="partida" class="col-sm-3 control-label">Partida de Nacimiento:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="partida" name="partida" value="1" {{$estudiante->academica->birth_certificate==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="conducta" class="col-sm-3 control-label">Certificado de Conducta:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="conducta" name="conducta" value="1" {{$estudiante->academica->good_standing==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="solvencia" class="col-sm-3 control-label">Solvencia de pago:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="solvencia" name="solvencia" value="1" {{$estudiante->academica->payment_solvency==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="seguro" class="col-sm-3 control-label">Seguro escolar:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="seguro" name="seguro" value="1" {{$estudiante->academica->insurance_student==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="compromiso-tutor" class="col-sm-3 control-label">Compromiso del tutor:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="compromiso-tutor" name="compromiso-tutor" value="1" {{$estudiante->academica->tutor_compromise_signature==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="compromiso-estudiante" class="col-sm-3 control-label">Compromiso del estudiante:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="compromiso-estudiante" name="compromiso-estudiante" value="1" {{$estudiante->academica->student_compromise_signature==1?'checked':''}}>
                        </div>
                    </div>
                    {{-- -------------------------------------------------- --}}

                    <div style="border-bottom: 1px solid #eee;"></div>

                    {{-- Documentos Administrativos --}}
                    <div class="form-group">
                        <label for="plan-pago" class="col-sm-3 control-label">Plan de pago:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="plan-pago" name="plan-pago" value="1" {{$estudiante->administrativa->payment_plan_signature==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contrato" class="col-sm-3 control-label">Contrato de la escuela:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="contrato" name="contrato" value="1" {{$estudiante->administrativa->school_contract_signature==1?'checked':''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transporte" class="col-sm-3 control-label">Transporte escolar:</label>
                        <div class="col-sm-9 checkbox-inline">
                            <input type="checkbox" id="transporte" name="transporte" value="1" {{$estudiante->administrativa->transport_take==1?'checked':''}}>
                        </div>
                    </div>
                    {{-- -------------------------------------------------- --}}
                    {{-- ==================================================================================================== --}}
                </div>
            </form>
        </div>

        <div class="form-group" style="margin-top:50px;">
            <div id="guardar" class="col-sm-12 ">
                <button type="button" id="savechanges" name="savechanges" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
            </div>
        </div>

    </div>

</div>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        var hash = window.location.hash;

        //$('#mytab a[href=' + hash + ']').tab('show');
        $(document).on('click', '#savechanges', function() {
            if (formIsvalid($('.form-control[required]'))) {
                $('#formupdate').submit();
            }
        });

        if ($('#plandepago').val() != 0) {
            $('#detalleplandepago').fadeIn('slow');
        }
        $(document).on('change', '#plandepago', function() {
            $("#myplandepago").val($(this).val());
            if ($(this).val() != 0) {
                $('#detalleplandepago').fadeIn('slow');
            } else {
                $('#detalleplandepago').fadeOut('fast');
            }
        });

        $(document).on('click', '.nav-tabs a', function() {
            var id = $(this).attr('href');
            $('.tab-pane').each(function(index, element) {
                $(element).removeClass('active');
                $(element).hide();
            });
            $(id).addClass('active');
            $(id).show();
            $('.nav-tabs li').each(function(index, element) {
                $(element).removeClass('active');
            });
            $(this).parent('li').addClass('active');
        });

        $(document).on('change', '#tutor', function() {
            if ($('#tutor option:selected').val() == 5)
                $('#tutor-input').show();
            else
                $('#tutor-input').hide();
        });

        $(document).on('change', '#pago', function() {
            if ($('#pago option:selected').val() == 5)
                $('#pago-input').show();
            else
                $('#pago-input').hide();
        });

        $(document).on('click', '#curso-check', function() {
            if ($(this).is(':checked'))
                $('#curso-input').removeAttr('disabled');
            else
                $('#curso-input').attr('disabled', 'disabled');
        });

        $(document).on('click', '#cambio-check', function() {
            if ($(this).is(':checked'))
                $('#cambio-input').removeAttr('disabled');
            else
                $('#cambio-input').attr('disabled', 'disabled');
            u
        });

        $(document).on('click', '#escogio-check', function() {
            if ($(this).is(':checked'))
                $('#escogio-input').removeAttr('disabled');
            else
                $('#escogio-input').attr('disabled', 'disabled');
        });

        $(document).on('click', '#grado-check', function() {
            if ($(this).is(':checked'))
                $('#grado-input').removeAttr('disabled');
            else
                $('#grado-input').attr('disabled', 'disabled');
        });

        $(document).on('click', '#asignar', function() {
            $('#asignar-familia').val($('input[name=cod-familia]:checked').val());
        });

        $(document).on('click', '#grado', function() {
            var limite = $('#grado option:selected').val();
            $('.elemento').each(function(i, elem) {
                if (parseInt($(elem).val()) > limite) {
                    $(elem).attr('disabled', 'disabled');
                } else {
                    $(elem).removeAttr('disabled');
                }
            });
        });

        $(document).on('click', '#checkbox', function() {
            $('#antes').toggle('slow');
        });

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