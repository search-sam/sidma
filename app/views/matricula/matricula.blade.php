@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/bootstrap-multiselect.css">
@stop

@section('side')
@stop

@section('content')
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
    <h1 class="page-header mypageheader">
        <i class="glyphicon glyphicon-file"></i> Registros | Año lectivo <b>{{$year->vigente()->name_school_year}}</b>
        <a data-toggle="tooltip" data-placement="right" title='Se registrará un nuevo estudiante al sistema' href="{{action('EstudianteController@nuevo')}}?ref=module_enrollment" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nueva Matricula</a>
        <input type="hidden" id='vigente' name='vigente' value="{{$year->vigente()->cod_school_year}}"/>
    </h1>
    <div class="indicator"></div>
    <div class="table-resposnsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table_enrollments">

        </table>
    </div>
</div>
<div class="modal" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
@stop


@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var usd_rate = 27;
    $('#table_enrollments').load('../matricula/registrosactuales', function() {
        $('#table_enrollments').dataTable();
    });
    function formato_numero(numero, decimales, separador_decimal, separador_miles) { // v2007-08-06
        // numero = parseFloat(numero);
        if (isNaN(numero)) {
            return "";
        }

        if (decimales !== undefined) {
            // Redondeamos
            numero = numero.toFixed(decimales);
        }

        // Convertimos el punto en separador_decimal
        numero = numero.toString().replace(".", separador_decimal !== undefined ? separador_decimal : ",");

        if (separador_miles) {
            // Añadimos los separadores de miles
            var miles = new RegExp("(-?[0-9]+)([0-9]{3})");
            while (miles.test(numero)) {
                numero = numero.replace(miles, "$1" + separador_miles + "$2");
            }
        }

        return numero;
    }

    $(document).on('change', '#payment_method', function() {
        if ($(this).val() == 2) {//2 es el codigo de tarjeta de debito/credito
            $('#credit_cards').fadeIn('slow');
        } else {
            $('#credit_cards').fadeOut('slow');
        }
    });

    $(document).on('click', '.cambio', function() {
        $('.cambio').removeClass('active');
        $(this).addClass('active');
        $('#tipo_moneda').val($(this).attr('id') + '/' + $(this).text());
    });
    $(document).on('click', '#test', function() {
        var receipt = new Array();
        var payment = new Array();
        var cod_student = $('#cod_student').val();
        var payer_name = $('#payer_name').val();
        var payment_method = $('#payment_method').val();
        //usd_rate es la misma
        var cod_payment_method;
        //-----------------------------------------------------------------------------------
        var UsdRecibido = parseFloat($('#amount_usd').val().replace(',', ''));
        if (isNaN(UsdRecibido)) {
            UsdRecibido = 0;
        }
        var CorRecibido = parseFloat($('#amount_cor').val().replace(',', ''));
        if (isNaN(CorRecibido)) {
            CorRecibido = 0;
        }
        var MontoAbonar = UsdRecibido + (CorRecibido / usd_rate);
        var monto_a_pagar = parseFloat($('#amount_to_pay').html().replace(',', '').replace('U$ ', ''));
        var MontoCuotaAbono;
        if (payer_name.trim() != '') {
            if (MontoAbonar != 0) {
                if ((parseFloat($('#left_usd').text()) < 0 && $('#tipo_moneda').val().trim() != '') || parseFloat($('#left_usd').text()) >= 0 ) {//Si es negativo debemos dar cambio y debe haberse seleccionado como el cambio
                    // Solamente no pongo la fecha esa la pongo en php
                    //Creamos el nuevo recibo
                    //hay que aumentar un 85 porciento de la barra
                    //Obtenemos la cantidad de quotas checkeadas
                    var cant_inc = $('div.detallepago input:checked').length;
                    var width_parent = 960;

                    var incrementos = 80 / cant_inc;
                    $('.sub_indicator').show();
                    $('#label_quota').html('Creando recibo a nombre de <b>' + payer_name + '</b>...');

                    $.ajax({
                        type: "POST",
                        url: "../estudiante/new_receipt",
                        dataType: "text",
                        async: false,
                        data: {cod_student: cod_student, payer_name: payer_name, payment_method: payment_method, amount_cor: CorRecibido, amount_usd: UsdRecibido, total_amount_usd: MontoAbonar, usd_rate: usd_rate, amount_to_pay: monto_a_pagar, tipo_moneda: $('#tipo_moneda').val()},
                        success: function(cod_receipt) {
                            $('#label_quota').html('Recibo creado');
                            $('#subi').css('width', '20%');
                            $('div.detallepago input[type=checkbox]').each(function(i) {

                                //Llenar la tabla payment, se requiere haber llenado la tabla receipt
                                //cod_receipt,  cod_quota_payment, payment_amount
                                //Table receipt: cod_student, payer_name, amount_cor, amount_usd, usd_rate, total_amount_usd,cod_payment_method
                                var SaldoCuota = parseFloat($(this).parent().parent().parent().parent().find("td").eq(3).find('label').html().replace(',', ''));
                                var cod_quota_payment = $(this).val();
                                if ($(this).prop('checked')) {


                                    if (MontoAbonar > 0) {
                                        //var label_abono = 'Cuota completa ';
                                        if ((MontoAbonar >= SaldoCuota)) {
                                            MontoCuotaAbono = SaldoCuota;
                                        }
                                        else {
                                            MontoCuotaAbono = MontoAbonar;
                                            //  label_abono = 'Abono de ';
                                        }
                                        setTimeout(function() {
                                            $('#label_quota').html('Abonando/pagando U$' + MontoCuotaAbono + ' a cuota...');
                                        }, 100);


                                        $.ajax({
                                            type: "POST",
                                            url: "../estudiante/new_payment",
                                            dataType: "text",
                                            async: false,
                                            data: {cod_quota_payment: cod_quota_payment, cod_receipt: cod_receipt, payment_amount: MontoCuotaAbono},
                                            success: function() {
                                                setTimeout(function() {
                                                    var actual = parseInt($('#subi').css('width'));//192px
                                                    actual = (actual / width_parent) * 100 + incrementos;
                                                    $('#subi').css('width', actual + '%');
                                                    $('#label_quota').html('Guardando registro de cuota abonada/cancelada...');
                                                    // console.log(i + ' ' + label_abono + ' ' + formato_numero(MontoCuotaAbono, 2, '.', ','));
                                                    //Ya se puede llenar la tabla quota_payment

                                                    MontoAbonar = MontoAbonar - SaldoCuota;

                                                }, 100);
                                            }});




                                    }

                                }
                            });

                            setTimeout(function() {
                                $('#NewOrEditModal').load('../plandepago/gestionpago?cod_student=' + cod_student + '&payer_name=' + payer_name, function() {
                                    var valor = $('#estudiantepago').val();
                                    if (valor != 0) {
                                        $('#estudiantepago option:selected').attr('disabled', 'disabled');
                                        $('#estudiantepago').multiselect(
                                                {nonSelectedText: 'Seleccione un concepto',
                                                    numberDisplayed: 2,
                                                    allSelectedText: 'Todos seleccionados',
                                                    onChange: function(option, checked) {
                                                        if (checked) {
                                                            $('.numbers').tooltip({placement: 'right', trigger: 'focus'});
                                                            $('<div id="' + option.val() + '" class="detallepago"><div class="indicator">Cargando el detalle...<div class="progress progress-striped active" style="height:0.8em;">' +
                                                                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">' +
                                                                    '<span class="sr-only">Registrando acción...</span>' +
                                                                    '</div>' +
                                                                    '</div></div></div>').appendTo('#paymentform').load('../estudiante/detalleplandepago?cod_student_payment_plan=' + option.val(), function() {
                                                                $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]').eq(0).prop('checked', true).change().prop('disabled', true);

                                                            }
                                                            );
                                                        } else {
                                                            $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]:checked').eq(0).prop('disabled', false).prop('checked', false).change();
                                                            $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]:checked').prop('checked', false).change();
                                                            // console.log( $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]:checked').eq(0).prop('disabled'));
                                                            $('div.detallepago[id=' + option.val() + ']').remove();
                                                        }
                                                    }
                                                });
                                        // $('.numbers').tooltip({placement:'right',trigger:'focus'});
                                        $('<div id="' + valor + '" class="detallepago"><div class="indicator">Cargando el detalle...<div class="progress progress-striped active" style="height:0.8em;">' +
                                                '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">' +
                                                '<span class="sr-only">Registrando acción...</span>' +
                                                '</div>' +
                                                '</div></div></div>').appendTo('#paymentform').load('../estudiante/detalleplandepago?cod_student_payment_plan=' + valor, function() {
                                            $('div.detallepago[id=' + valor + ']').find('input[type=checkbox]').eq(0).prop('checked', true).change();
                                            $('div.detallepago[id=' + valor + ']').find('input[type=checkbox]').eq(0).prop('disabled', true);
                                        });
                                    }
                                    $('#table_enrollments').load('../matricula/registrosactuales', function() {
                                        $('#table_enrollments').dataTable();
                                    });

                                });

                            }, 100);


                        }
                    });



                }
            }
        }
    });
    $(document).on('keydown', '#amount_cor', function(e) {
        var monto_usd = parseFloat($('#amount_usd').val().replace(',', ''));
        var monto_a_pagar = parseFloat($('#amount_to_pay').html().replace(',', '').replace('U$ ', ''));
        if (isNaN(monto_usd)) {
            monto_usd = 0;
        }

        if (monto_a_pagar > monto_usd) {

        } else {
            e.preventDefault();
        }
    });
    $(document).on('keyup', '#amount_cor', function(e) {
        var monto_usd = parseFloat($('#amount_usd').val().replace(',', ''));
        if (isNaN(monto_usd)) {
            monto_usd = 0;
        }
        var monto_a_pagar = parseFloat($('#amount_to_pay').html().replace(',', '').replace('U$ ', ''));
        if (monto_a_pagar > monto_usd) {
            var left_usd = monto_a_pagar - monto_usd;
            var left_cor = parseFloat(left_usd * usd_rate);
            $('#left_usd').removeClass('btn-default');
            $('#left_cor').removeClass('btn-default');
            var monto_cor = parseFloat($(this).val().replace(',', ''));
            if (isNaN(monto_cor)) {
                monto_cor = 0;
            }
            if ((monto_cor - left_cor) != 0) {
                $('#left_usd').removeClass('btn-primary').addClass('btn-danger');
                $('#left_cor').removeClass('btn-primary').addClass('btn-danger');
                if (monto_cor > left_cor) {
                    $('#left_usd').removeClass('btn-danger').addClass('btn-primary');
                    $('#left_cor').removeClass('btn-danger').addClass('btn-primary');
                }
            } else {
                $('#left_usd').removeClass('btn-primary').removeClass('btn-danger').addClass('btn-default');
                $('#left_cor').removeClass('btn-primary').removeClass('btn-danger').addClass('btn-default');
            }
            $('#left_cor').text(formato_numero(left_cor - monto_cor, 2, '.', ','));
            $('#left_usd').text(formato_numero((left_cor - monto_cor) / usd_rate, 2, '.', ','));

        }
    });
    $(document).on('keyup', '#amount_usd', function() {
        var monto_usd = parseFloat($(this).val().replace(',', ''));
        var monto_cor = parseFloat($('#amount_cor').val().replace(',', ''));
        if (isNaN(monto_cor)) {
            monto_cor = 0;
        }
        if (isNaN(monto_usd)) {
            monto_usd = 0;
        }
        monto_usd = monto_usd + (monto_cor / usd_rate);
        var monto_a_pagar = parseFloat($('#amount_to_pay').html().replace(',', '').replace('U$ ', ''));
        var left_usd = monto_a_pagar - monto_usd;
        left_usd = parseFloat(left_usd);
        var left_cor = left_usd * usd_rate;
        $('#left_usd').removeClass('btn-default');
        $('#left_cor').removeClass('btn-default');
        if (left_usd != 0) {
            $('#left_usd').removeClass('btn-danger').addClass('btn-primary');
            $('#left_cor').removeClass('btn-danger').addClass('btn-primary');
            if (left_usd > 0) {
                $('#left_usd').removeClass('btn-primary').addClass('btn-danger');
                $('#left_cor').removeClass('btn-primary').addClass('btn-danger');
            }

        } else {
            $('#left_usd').removeClass('btn-primary').removeClass('btn-danger').addClass('btn-default');
            $('#left_cor').removeClass('btn-primary').removeClass('btn-danger').addClass('btn-default');
        }
        $('#left_usd').text(formato_numero(left_usd, 2, '.', ','));
        $('#left_cor').text(formato_numero(left_cor, 2, '.', ','));
    });
    $('a[data-toggle="tooltip"]').tooltip();
    $(document).on('click', '.edit', function() {
        $(location).attr('href', $(this).attr('ref'));
    });

    $(document).on('change', 'div.detallepago input[type=checkbox]', function() {
        var cod_quota_payment = $(this).val();
        var next_cod_quota_payment = parseInt(cod_quota_payment) + 1;
        var prev_cod_quota_payment = parseInt(cod_quota_payment) - 1;
        var total_monto = 0;
        //console.log($(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox][value='+cod_quota_payment+']'));
        var monto_a_pagar = parseFloat($('#amount_to_pay').html().replace(',', '').replace('U$ ', ''));
        if (isNaN(monto_a_pagar)) {
            monto_a_pagar = 0;
        }
        var monto_cuota = parseFloat($(this).parent().parent().parent().parent().find("td").eq(3).find('label').html().replace(',', ''));
        if ($(this).is(':checked')) {
            $(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox][value=' + next_cod_quota_payment + ']').eq(0).prop('disabled', false);
            monto_a_pagar = monto_a_pagar + monto_cuota;
            $('#amount_to_pay').html('U$ ' + formato_numero(monto_a_pagar, 2, '.', ','));
            $('#amount_to_pay_cor').html('C$ ' + formato_numero(monto_a_pagar * usd_rate, 2, '.', ','));
        } else {
            // alert(monto_a_pagar - monto_cuota);
            monto_a_pagar = monto_a_pagar - monto_cuota;

            $('#amount_to_pay').html('U$ ' + formato_numero(monto_a_pagar, 2, '.', ','));
            $('#amount_to_pay_cor').html('C$ ' + formato_numero(monto_a_pagar * usd_rate, 2, '.', ','));
        }
        // console.log('check '+$(this).val()+', Monto a pagar: '+monto_a_pagar);
        var monto_usd = parseFloat($('#amount_usd').val().replace(',', ''));
        var monto_cor = parseFloat($('#amount_cor').val().replace(',', ''));
        if (isNaN(monto_usd)) {
            monto_usd = 0;
        }
        if (isNaN(monto_cor)) {
            monto_cor = 0;
        }

        var left_usd = monto_a_pagar - monto_usd - (monto_cor / usd_rate);

        if (isNaN(left_usd)) {
            left_usd = 0;
        }
        var left_cor = parseFloat(left_usd * usd_rate);
        if (left_usd != 0) {
            $('#left_usd').removeClass('btn-danger').addClass('btn-primary');
            $('#left_cor').removeClass('btn-danger').addClass('btn-primary');
            if (left_usd > 0) {
                $('#left_usd').removeClass('btn-primary').addClass('btn-danger');
                $('#left_cor').removeClass('btn-primary').addClass('btn-danger');
            }
            $('#left_usd').text(formato_numero(left_usd, 2, '.', ';'));
            $('#left_cor').text(formato_numero(left_cor, 2, '.', ','));
        } else {
            $('#left_usd').text('');
            $('#left_cor').text('');
        }
        if ($(this).is(':checked')) {

        } else {
            if ($(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox][value=' + next_cod_quota_payment + ']').eq(0).is(':checked')) {
                $(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox][value=' + next_cod_quota_payment + ']').eq(0).prop('checked', false).change();
            }
            $(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox][value=' + next_cod_quota_payment + ']').eq(0).prop('disabled', true);


        }
    });

    $(document).on('click', '.editdopay', function() {
        $('#NewOrEditModal').load('../plandepago/gestionpago?cod_student=' + $(this).attr('id'), function() {
            var valor = $('#estudiantepago').val();
            if (valor != 0) {
                $('#estudiantepago option:selected').attr('disabled', 'disabled');
                $('#estudiantepago').multiselect(
                        {nonSelectedText: 'Seleccione un concepto',
                            numberDisplayed: 3,
                            onChange: function(option, checked) {
                                if (checked) {
                                    $('.numbers').tooltip({placement: 'right', trigger: 'focus'});
                                    $('<div id="' + option.val() + '" class="detallepago"><div class="indicator">Cargando el detalle...<div class="progress progress-striped active" style="height:0.8em;">' +
                                            '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">' +
                                            '<span class="sr-only">Registrando acción...</span>' +
                                            '</div>' +
                                            '</div></div></div>').appendTo('#paymentform').load('../estudiante/detalleplandepago?cod_student_payment_plan=' + option.val(), function() {
                                        $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]').eq(0).prop('checked', true).change().prop('disabled', true);

                                    }
                                    );
                                } else {
                                    $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]:checked').eq(0).prop('disabled', false).prop('checked', false).change();
                                    $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]:checked').prop('checked', false).change();
                                    // console.log( $('div.detallepago[id=' + option.val() + ']').find('input[type=checkbox]:checked').eq(0).prop('disabled'));
                                    $('div.detallepago[id=' + option.val() + ']').remove();
                                }
                            }
                        });
                // $('.numbers').tooltip({placement:'right',trigger:'focus'});
                $('<div id="' + valor + '" class="detallepago"><div class="indicator">Cargando el detalle...<div class="progress progress-striped active" style="height:0.8em;">' +
                        '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">' +
                        '<span class="sr-only">Registrando acción...</span>' +
                        '</div>' +
                        '</div></div></div>').appendTo('#paymentform').load('../estudiante/detalleplandepago?cod_student_payment_plan=' + valor, function() {
                    $('div.detallepago[id=' + valor + ']').find('input[type=checkbox]').eq(0).prop('checked', true).change();
                    $('div.detallepago[id=' + valor + ']').find('input[type=checkbox]').eq(0).prop('disabled', true);
                });
            }


        });


    });
    $(document).on('click', '.editenrollment', function() {
        $('#NewOrEditModal').load('../matricula/registrar?cod_enrollment=' + $(this).attr('id') + '&cod_school_year=' + $('#vigente').val());
    });
});
</script>
@stop
