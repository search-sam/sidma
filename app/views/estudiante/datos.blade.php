@extends('layouts.home')

@section('css')
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav bs-docs-sidenav">
        <li><a href="#acedemica"><b>Informaci&oacute;n Académica</b></a></li>
        <li><a href="#administrativa"><b>Informaci&oacute;n Administrativa</b></a></li>
        <li><a href="#medica"><b>Informaci&oacute;n Médica</b></a></li>
        <li><a href="#documentos"><b>Documentos</b></a></li>
        <li><a href="#guardar"><b><?= ($newfamily==0)? 'Guardar':' » Continuar'; ?></b></a></li>
        <li><a href="#inicio"><b>Inicio</b></a></li>	
    </ul>
</div>
@stop

@section('content')
<div id="inicio" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h4 class="page-header">Nuevo estudiante » <b>{{$estudiante->first_name}} {{$estudiante->first_last_name}}</b> » <b style="color:#3498db;"><i class="glyphicon glyphicon-info-sign"></i> Académica, Administrativa, Médica</b> <?= ($newfamily==0)? '':' » Familia'; ?></h4>
    <div class="alert alert-success" <?= Session::has('message_student') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_student')}}
    </div>
    <form action="{{action('EstudianteController@guardardatos')}}" method="post" class="form-horizontal" role="form">
        <input type="hidden" name="cod_family" id="cod_family" value="{{$cod_family}}"/>
        <input type="hidden" name="newfamily" id="newfamily" value="{{$newfamily}}"/>
        <input value="{{$id}}" type="text" style="display:none" name="estudiante_id">
        {{-- Informacion Academica --}}
        <div id="acedemica" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n Académica</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="checkbox" class="col-sm-3 control-label">¿A estudiado antes?</label>
                    <div class="col-sm-9">
                        <input type="checkbox" name="estudiado" class="checkbox-inline" id="checkbox" value="1">
                    </div>
                </div>

                {{-- Colegio anterior --}}
                <div id="antes" style="display:none;">
                    <div class="col-sm-12">  
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3  class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Complete la siguiente información.
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="grado" class="col-sm-3 control-label">¿Último grado que cursó?</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="grado" name="grado">
                                            @foreach ($grados as $grado)
                                            <option value="{{$grado->cod_level}}">
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
                                     <label for="colegio" class="col-sm-3 control-label">Colegio del que proviene el estudiante:</label>
                                    <div class="col-sm-3 has-feedback">
                                        <input type="text" class="form-control" id="colegio" name="colegio" placeholder="Colegio" required>
                                        <span class="help-block">No aplica si el alumno no ha asistido al colegio.</span>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="col-pais" class="col-sm-3 control-label">Cuidad del colegio al que asistió el estudiante:</label>
                                    <div class="col-sm-3 has-feedback">
                                        <input type="text" class="form-control" id="col-pais" name="col-pais" placeholder="Ciudad" required>
                                        <span class="help-block">Pa&iacute;s en caso que quede fuera de Nicaragua.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="grados" class="col-sm-3 control-label">Grados/A&ntilde;os que curso el estudiante:</label>
                                    <div class="col-sm-9">
                                        <span class="help-block">Seleccionar todos los grados que estudió en ese colegio.</span>
                                        @foreach ($grados as $grado)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="cursos[]" class="elemento" value="{{$grado->cod_level}}"> 
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
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="num-casa" class="col-sm-3 control-label">Motivo por el que el Alumno está cambiando de Colegio:</label>
                                    <div class="col-sm-9">
                                        <span class="help-block">Puede seleccionar varias opciones.</span>
                                        @foreach (Util::$motivo as $i => $l)
                                        <label class="col-sm-4 checkbox-inline">
                                            <input type="checkbox" id="grados" name="cambios[]" value="{{$i}}"> {{$l}}
                                        </label>
                                        <?= ($i%2==0)?'<br/>':'';?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- -------------------------------------------------- --}}

                <div class="form-group">
                    <label for="num-casa" class="col-sm-3 control-label">¿Por qu&eacute; escogi&oacute; el Angloameriacano?</label>
                    <div class="col-sm-9">
                        <span class="help-block">Puede seleccionar varias opciones.</span>
                        @foreach (Util::$escogio as $i => $l)
                        <label class="col-sm-3 checkbox-inline">
                            <input type="checkbox" id="grados" name="escogio[]" value="{{$i}}"> {{$l}}
                        </label>
                        <?= ($i % 3 == 0) ? '<br/>' : ''; ?>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="num-casa" class="col-sm-3 control-label">¿C&oacute;mo escuch&oacute; del Angloamericano?</label>
                    <div class="col-sm-9">
                        <span class="help-block">Puede seleccionar varias opciones.</span>
                        @foreach (Util::$escucho as $i => $l)
                        <label class="col-sm-3 checkbox-inline">
                            <input type="checkbox" name="saber[]" value="{{$i}}"> {{$l}}
                        </label>
                        <?= ($i % 3 == 0) ? '<br/>' : ''; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        {{-- Informacion Administrativa --}}
        <div id="administrativa" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n Administrativa</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="tutor" class="col-sm-3 control-label">¿Con quien vive el estudiante?</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="tutor" name="tutor">
                            @foreach (Util::$tutor as $indice => $valor)
                            <option value="{{$indice}}">{{$valor}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="pago" class="col-sm-3 control-label">¿Responsable del pago de aranceles?</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="pago" name="pago">
                            @foreach (Util::$tutor as $indice => $valor)
                            <option value="{{$indice}}">{{$valor}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h4 class="page-header"></h4>
                <div class="form-group">
                    <label for="plandepago" class="col-sm-3 control-label">Plan de pago</label>
                    <div class="col-sm-3">  
                        <select class="form-control" id="plandepago" name="plandepago">
                            <option value="0" selected>Seleccione un plan de pago</option>
                            @foreach ($year_payment_plans as $payment_plan)
                            <option value="{{$payment_plan->cod_year_payment_plan}}">{{Plandepago::find($payment_plan->cod_payment_plan)->plan_name}} ( {{$payment_plan->discount_rate}}% Descuento ) </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" id="detalleplandepago" style="display: none;">
                    <div class="col-sm-12">  
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3  class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Debe especificar el mes que iniciarán los pagos y el límite de días de pago. El descuento aplica para todos los conceptos de pago.
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Método de pago</label> 
                                    <div class="col-sm-3">
                                        <select id="metododepago" name="metododepago" class="form-control">
                                            @foreach(Metododepago::all() as $payment_method)
                                            <option value="{{$payment_method->cod_payment_method}}">{{$payment_method->payment_method}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-3 control-label">Descuento</label> 
                                    <div class="col-sm-3">
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
                                            <option {{$disabled}} value="{{$year_discount->cod_year_discount}}">{{Descuento::find($year_discount->cod_discount)->discount_name}} ( {{$year_discount->discount_rate}}%)</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>                               
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Inicia pago ( Mes )</label> 
                                    <div class="col-sm-3">
                                          <select id="iniciames" name="iniciames" class="form-control">
                                                <?php
                                                $inicia_mes_lectivo = date('m', strtotime($year->vigente()->date_from));
                                                $inicia_pago = date('Y', strtotime($year->vigente()->date_from)) . '-' . date('m', strtotime($year->vigente()->date_from)) . '-01';
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $value = intval(date('m', strtotime($inicia_pago)));                                                   
                                                        ?>
                                                        <option  value="<?= $i ?>">mes <?= $i . ' :: ' . Util::$meses[$value] . ' - ' . date('Y', strtotime($inicia_pago)); ?></option>
                                                        <?php
                                                  
                                                    $inicia_pago = date('Y-m-d', strtotime('+1 month', strtotime($inicia_pago)));
                                              
                                                }
                                                ?>
                                            </select>
                                    </div>
                                    <label class="col-sm-3 control-label">Límite de días de pago</label> 
                                    <div class="col-sm-3">
                                        <input id="limitedias" name="limitedias" class="form-control" value="5" readonly/>
                                    </div>
                                </div>

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        {{-- Informacion Medica --}}
        <div id="medica" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informaci&oacute;n Médica</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="alergia" class="col-sm-3 control-label">Alergias comunes:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alergia" name="alergia" placeholder="Alergias">
                        <span class="help-block">Si es mas de una por favor separelas con comas.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="medicamento" class="col-sm-3 control-label">Alergia a medicamentos:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="medicamento" name="medicamento" placeholder="Medicamentos">
                        <span class="help-block">Si es mas de una por favor separelas con comas.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="impedimento" class="col-sm-3 control-label">Impedimento f&iacute;sico:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="impedimento" name="impedimento" placeholder="Impedimento">	
                    </div>
                </div>
                <div class="form-group">
                    <label for="enfermedad" class="col-sm-3 control-label">Enfermedades permanentes:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="enfermedad" id="enfermedad" placeholder="Enfermedad">
                        <span class="help-block">Si es mas de una por favor separelas con comas.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="emergencia" class="col-sm-3 control-label">N&uacute;mero de emergencia</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="emergencia" name="emergencia" placeholder="Telefono">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comentario" class="col-sm-3 control-label">Comentario:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="3" id="comentario" name="comentario" style="resize: none;"></textarea>
                    </div>
                </div>
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        {{-- Documentos --}}
        <div id="documentos" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Verificaci&oacute;n de documentos</h3>
            </div>
            <div class="panel-body">
                {{-- Documentos Academicos --}}
                <div class="form-group">
                    <label for="partida" class="col-sm-3 control-label">Partida de Nacimiento:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="partida" name="partida" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="conducta" class="col-sm-3 control-label">Certificado de Conducta:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="conducta" name="conducta" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="solvencia" class="col-sm-3 control-label">Solvencia de pago:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="solvencia" name="solvencia" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="seguro" class="col-sm-3 control-label">Seguro escolar:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="seguro" name="seguro" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="compromiso-tutor" class="col-sm-3 control-label">Compromiso del tutor:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="compromiso-tutor" name="compromiso-tutor" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="compromiso-estudiante" class="col-sm-3 control-label">Compromiso del estudiante:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="compromiso-estudiante" name="compromiso-estudiante" value="1">
                    </div>
                </div>
                {{-- -------------------------------------------------- --}}

                <div style="border-bottom: 1px solid #eee;"></div>

                {{-- Documentos Administrativos --}}
                <div class="form-group">
                    <label for="plan-pago" class="col-sm-3 control-label">Plan de pago:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="plan-pago" name="plan-pago" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contrato" class="col-sm-3 control-label">Contrato de la escuela:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="contrato" name="contrato" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="transporte" class="col-sm-3 control-label">Transporte escolar:</label>
                    <div class="col-sm-9 checkbox-inline">
                        <input type="checkbox" id="transporte" name="transporte" value="1">
                    </div>
                </div>
                {{-- -------------------------------------------------- --}}
            </div>
        </div>
        {{-- ==================================================================================================== --}}

        <div id="guardar" class="form-group">
            <div class="col-sm-12 ">
                <button type="submit" class="btn btn-primary pull-right"><?= ($newfamily==0)? 'Guardar':' » Continuar'; ?></button>
            </div>
        </div>
    </form>

</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $(document).on('change','#plandepago', function() {
            if ($(this).val() != 0) {
                $('#detalleplandepago').fadeIn('slow');
            } else {
                $('#detalleplandepago').fadeOut('fast');
            }
        });
        $(document).on('change','#pago', function() {
            if ($('#pago option:selected').val() == 5)
                $('#pago-input').show();
            else
                $('#pago-input').hide();
        });

        $(document).on('click','#grado-check', function() {
            if ($(this).is(':checked'))
                $('#grado-input').removeAttr('disabled');
            else
                $('#grado-input').attr('disabled', 'disabled');
        });

        $(document).on('click','#asignar', function() {
            $('#asignar-familia').val($('input[name=cod-familia]:checked').val());
        });

        $(document).on('click','#grado', function() {
            var limite = $('#grado option:selected').val();
            $('.elemento').each(function(i, elem) {
                if (parseInt($(elem).val()) > limite) {
                    $(elem).attr('disabled', 'disabled');
                } else {
                    $(elem).removeAttr('disabled');
                }
            });
        });

        $(document).on('change','#checkbox', function() {
            if($(this).is(':checked')){
                 $('#antes').fadeIn('slow');
            }else{
               $('#antes').fadeOut('slow'); 
            }
           
        });
    });
</script>
@stop



