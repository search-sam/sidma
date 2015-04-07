@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav nav-sidebar">
        <li><a href="#payment_plans"><b>Plan de pagos</b> <span class="badge">{{YearPlandepago::where('cod_school_year',$year->cod_school_year)->count()}}</span></a></li>
        <li><a href="#payment_concepts"><b>Conceptos de pago</b> <span class="badge">{{YearConcepto::where('cod_school_year',$year->cod_school_year)->count()}}</span></a></li>
        <li><a href="#payment_discounts"><b>Descuentos</b> <span class="badge">{{YearDescuento::where('cod_school_year',$year->cod_school_year)->count()}}</span></a></li>
    </ul>
</div>
@stop
@section('content')

<div id="payment_plans" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="page-header mypageheader" id="hschool_year">
        <a href="{{action('AdministrativaController@inicio')}}" ><i class="glyphicon glyphicon-level-up"></i> Administrativa</a> » {{$year->name_school_year}} » Planes de pago <button id="NewYearPaymentPlan"   class="btn btn-success" <?= (count(Plandepago::Notasigned($year->cod_school_year)) == 0) ? 'disabled' : '' ?>>Agregar plan de pago</button>
    </h2>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="year_payment_plans">
            <thead>
                <tr>
                    <th>Nombre plan</th>
                    <th align="center">Cantidad de pagos</th>
                    <th align="center">( % ) Descuento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach($year_payment_plans as $payment_plan)

                <tr >
                    <td>{{Plandepago::find($payment_plan->cod_payment_plan)->plan_name}}</td>
                    <td align="center">{{Plandepago::find($payment_plan->cod_payment_plan)->payment_quantity}}</td>
                    <td align="center">{{$payment_plan->discount_rate}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$payment_plan->cod_year_payment_plan}}"  type="button"  class="edityearpaymentplan btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="payment_concepts" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="page-header mypageheader" id="hschool_year">
        <a href="{{action('AdministrativaController@inicio')}}" ><i class="glyphicon glyphicon-level-up"></i> Administrativa</a> » {{$year->name_school_year}} » Conceptos de pago <button id="NewYearPaymentConcept"   class="btn btn-success" <?= (count(Conceptodepago::Notasigned($year->cod_school_year)) == 0) ? 'disabled' : '' ?>>Agregar concepto de pago</button>
    </h2>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="year_payment_concepts">
            <thead>
                <tr>
                    <th>Concepto de pago</th>
                    <th align="center">() Monto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>              
                @foreach($year_payment_concepts as $payment_concept)
                <tr >
                    <td>{{Conceptodepago::find($payment_concept->cod_concept)->concept_name}}</td>
                    <td align="center">{{$payment_concept->normal_payment}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$payment_concept->cod_year_payment_concept}}"  type="button"  class="edityearpaymentconcept btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="payment_discounts" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">
        <a href="{{action('AdministrativaController@inicio')}}" >Administrativa</a> » {{$year->name_school_year}} » Descuentos <button id="NewYearPaymentDiscount"   class="btn btn-success" <?= (count(Descuento::Notasigned($year->cod_school_year)) == 0) ? 'disabled' : '' ?>>Agregar descuento</button></h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="year_discounts">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th align="center">(%) Descuento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>              
                @foreach($year_discounts as $discount)
                <tr >
                    <td>{{Descuento::find($discount->cod_discount)->discount_name}}</td>
                    <td align="center">{{$discount->discount_rate}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$discount->cod_year_discount}}"  type="button"  class="edityeardiscount btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


</div>
<input type="hidden" id="current_cod_school_year" value="{{$year->cod_school_year}}" />
<div class="modal fade" id="NewOrEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


@section('js')
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript">
    $(document).ready(function() {
        function addDiscountToYear(cod_school_year, cod_discount, discount_rate, objeto) {
            $.ajax({
                type: "POST",
                url: "../descuento/addtoyear",
                dataType: "json",
                async: false,
                data: {cod_school_year: cod_school_year, cod_discount: cod_discount, discount_rate: discount_rate},
                success: function(response) {
                    $('#year_discounts').append('<tr><td>' + response.discount_name + '</td><td align="center">' + response.discount_rate + '</td><td><div class="btn-group"><button id="' + response.cod_year_discount + '"  type="button"  class="edityeardiscount btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button></div></td></tr>');
                    objeto.remove();
                },
                complete: function() {
                }
            });
        }


        function addPaymentConceptToYear(cod_school_year, cod_concept, normal_payment, objeto) {
            $.ajax({
                type: "POST",
                url: "../conceptodepago/addtoyear",
                dataType: "json",
                async: false,
                data: {cod_school_year: cod_school_year, cod_concept: cod_concept, normal_payment: normal_payment},
                success: function(response) {
                    $('#year_payment_concepts').append('<tr><td>' + response.concept_name + '</td><td align="center">' + response.concept_normal_quantity + '</td><td align="center">' + response.normal_payment + '</td><td><div class="btn-group"><button id="' + response.cod_year_payment_concept + '"  type="button"  class="edityearpaymentconcept btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button></div></td></tr>');
                    objeto.remove();
                },
                complete: function() {
                }
            });
        }
        function addPaymentPlanToYear(cod_school_year, cod_payment_plan, discount_rate, objeto) {
            $.ajax({
                type: "POST",
                url: "../plandepago/addtoyear",
                dataType: "json",
                async: false,
                data: {cod_school_year: cod_school_year, cod_payment_plan: cod_payment_plan, discount_rate: discount_rate},
                success: function(response) {
                    $('#year_payment_plans').append('<tr><td>' + response.plan_name + '</td><td align="center">' + response.payment_quantity + '</td><td align="center">' + response.discount_rate + '</td><td><div class="btn-group"><button id="' + response.cod_year_payment_plan + '"  type="button"  class="edityearpaymentplan btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span> Editar</button></div></td></tr>');
                    objeto.remove();
                },
                complete: function() {
                }
            });
        }
        $(document).on('change','#todo', function() {
            if ($(this).is(':checked')) {
                $('input[name=planes]').each(function() {
                    $(this).attr('checked', 'checked');
                });
            } else {
                $('input[name=planes]').each(function() {
                    $(this).removeAttr('checked');
                });
            }
        });
        $(document).on('click','#NewYearPaymentPlan', function() {
            $("#NewOrEditModal").load('../plandepago/agregar?cod_school_year=' + $('#current_cod_school_year').val());
        });
        $(document).on('click','#NewYearPaymentConcept',function() {
            $("#NewOrEditModal").load('../conceptodepago/agregar?cod_school_year=' + $('#current_cod_school_year').val());
        });
        $(document).on('click','#NewYearPaymentDiscount', function() {
            $("#NewOrEditModal").load('../descuento/agregar?cod_school_year=' + $('#current_cod_school_year').val());
        });

        $(document).on('click','.edityearpaymentplan', function() {
            $("#NewOrEditModal").load('../plandepago/agregar?cod_school_year=' + $('#current_cod_school_year').val() + '&cod_year_payment_plan=' + $(this).attr('id'));
        });
        $(document).on('click','.edityearpaymentconcept', function() {
            $("#NewOrEditModal").load('../conceptodepago/agregar?cod_school_year=' + $('#current_cod_school_year').val() + '&cod_year_payment_concept=' + $(this).attr('id'));
        });
        $(document).on('click','.edityeardiscount', function() {
            $("#NewOrEditModal").load('../descuento/agregar?cod_school_year=' + $('#current_cod_school_year').val() + '&cod_year_discount=' + $(this).attr('id'));
        });
        $(document).on('click','.edityeardiscount',function() {
            var ocultar = 0;
            $('table#my_year_payment_plans tr').each(function(i) {
                if (i > 0) {
                    var check = $(this).children().first().children();
                    if ((check).is(':checked')) {
                        var cod_payment_plan = check.attr('id');
                        var discount_rate = $(this).children().find('input.form-control').val();
                        if (formIsvalid($('.form-control[required]'))) {
                            ocultar = 1;
                            addPaymentPlanToYear($('#current_cod_school_year').val(), cod_payment_plan, discount_rate, $(this));
                        }
                    }
                }
            });
            if (ocultar === 1) {
                $('#myModal').removeClass('in').fadeOut('slow');
                $('.modal-backdrop').removeClass('in').fadeOut('slow');
            }

        });
        $(document).on('click','#addconcept', function() {
            var ocultar = 0;
            $('table#my_year_payment_concepts tr').each(function(i) {
                if (i > 0) {
                    var check = $(this).children().first().children();
                    if ((check).is(':checked')) {
                        var cod_concept = check.attr('id');
                        var normal_payment = $(this).children().find('input.form-control').val();
                        if (formIsvalid($('.form-control[required]'))) {
                            ocultar = 1;
                            addPaymentConceptToYear($('#current_cod_school_year').val(), cod_concept, normal_payment, $(this));
                        }
                    }
                }
            });
            if (ocultar === 1) {
                $('#myModal').removeClass('in').fadeOut('slow');
                $('.modal-backdrop').removeClass('in').fadeOut('slow');
            }

        });

        $(document).on('click', '#adddiscount',function() {
            var ocultar = 0;
            $('table#my_year_payment_concepts tr').each(function(i) {
                if (i > 0) {
                    var check = $(this).children().first().children();
                    if ((check).is(':checked')) {
                        var cod_discount = check.attr('id');
                        var discount_rate = $(this).children().find('input.form-control').val();
                        if (formIsvalid($('.form-control[required]'))) {
                            ocultar = 1;
                            addDiscountToYear($('#current_cod_school_year').val(), cod_discount, discount_rate, $(this));
                        }
                    }
                }
            });
            if (ocultar === 1) {
                $('#myModal').removeClass('in').fadeOut('slow');
                $('.modal-backdrop').removeClass('in').fadeOut('slow');
            }

        });


    });
</script>
@stop
