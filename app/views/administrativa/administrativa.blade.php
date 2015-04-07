@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/bootstrap-datepicker3.min.css">
@stop

@section('side')
<div class="col-sm-3 col-md-2 sidebar" role="complementary">
    <ul class="nav nav-pills" role="tablist">      
        <li  role="presentation" ><a href="#payment_plans"><b>Plan de pagos</b> <span class="badge">{{$payment_plans->count()}}</span></a></li>
        <li role="presentation"><a href="#payment_methods"><b>Métodos de pago</b> <span class="badge">{{$payment_methods->count()}}</span></a></li>
        <li role="presentation"><a href="#payment_concepts"><b>Conceptos/pago</b> <span class="badge">{{$payment_concepts->count()}}</span></a></li>
        <li role="presentation"><a href="#discounts"><b>Descuentos</b> <span class="badge">{{$discounts->count()}}</span></a></li>

    </ul>
</div>
@stop
@section('content')
<div id="lectiveyear" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Año lectivo</h1>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="lectiveyears">
            <thead>
                <tr> 
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th>Inicia</th>
                    <th>Finaliza</th>

                    <th>( % ) Mora</th>
                    <th>Límite días </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($years as $year)
                <tr  id="{{$year->cod_school_year}}">
                    <td> {{($year->state_school_year==1)?'<label class="label label-success">Vigente</label>':'<label class="label label-warning">Inactivo</label>'}}</td>
                    <td  class="trselect" ><a  href="{{action('AdministrativaController@adminyear').'?cod_school_year='.$year->cod_school_year}}"><i class="glyphicon glyphicon-folder-open"></i> {{$year->name_school_year}}</a></td>
                    <td>{{Util::FormatDate($year->date_from)}}</td>
                    <td>{{Util::FormatDate($year->date_to)}}</td>

                    <td>{{$year->surcharge_rate}}</td>
                    <td>{{$year->surcharge_limit_days}}</td>
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
<div id="payment_plans" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Plan de pagos <button id="NewPaymentPlan"  type="button"  class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo plan de pago</button></h1>
   <div class="alert alert-success" <?= Session::has('message_payment_plan') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_payment_plan')}}
    </div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> 
                    <th>Nombre plan</th>
                    <th>Cantidad de pagos</th>
                    <th>(%) Descuento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment_plans as $payment_plan)
                <tr  id="{{$payment_plan->cod_payment_plan}}">

                    <td>{{$payment_plan->plan_name}}</td>
                    <td>{{$payment_plan->payment_quantity}}</td>
                    <td>{{$payment_plan->discount_rate}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$payment_plan->cod_payment_plan}}"  type="button"  class="editpaymentplan btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$payment_plan->cod_payment_plan}}"  class="deletepaymentplan btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="payment_methods" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Métodos de pago <button id="NewPaymentMethod"   class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo método de pago</button></h1>
     <div class="alert alert-success" <?= Session::has('message_payment_method') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_payment_method')}}
    </div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> 
                    <th>Método de pago</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment_methods as $payment_method)
                <tr  id="{{$payment_method->cod_payment_method}}">

                    <td>{{$payment_method->payment_method}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$payment_method->cod_payment_method}}"  type="button"  class="editpaymentmethod btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$payment_method->cod_payment_method}}"  class="deletepaymentmethod btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="payment_concepts" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Conceptos de pago <button id="NewPaymentConcept"   class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo concepto de pago</button></h1>
     <div class="alert alert-success" <?= Session::has('message_payment_concept') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_payment_concept')}}
    </div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> 
                    <th>Concepto de pago</th>
                    <th>Cantidad</th>
                    <th>Monto regular</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment_concepts as $payment_concept)
                <tr  id="{{$payment_concept->cod_concept}}">

                    <td>{{$payment_concept->concept_name}}</td>
                    <td>{{$payment_concept->concept_normal_quantity}}</td>
                    <td>{{$payment_concept->normal_payment}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$payment_concept->cod_concept}}"  type="button"  class="editpaymentconcept btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                       <!-- <div class="btn-group">
                            <button id="{{$payment_concept->cod_concept}}"  class="deletepaymentconcept btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        </div>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="discounts" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header mypageheader" id="hschool_year">Descuentos <button id="NewDiscount"   class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo descuento</button></h1>
     <div class="alert alert-success" <?= Session::has('message_discount') ? '' : 'style="display:none"' ?> >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-info-sign"></i> {{Session::get('message_discount')}}
    </div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
            <thead>
                <tr> 
                    <th>Nombre descuento</th>
                    <th>( % ) Tasa descuento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                <tr  id="{{$discount->cod_discount}}">

                    <td>{{$discount->discount_name}}</td>
                    <td>{{$discount->discount_rate}}</td>
                    <td>
                        <div class="btn-group">
                            <button id="{{$discount->cod_discount}}"  type="button"  class="editdiscount btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                        </div>
                        <div class="btn-group">
                            <button id="{{$discount->cod_discount}}"  class="deletediscount btn btn-sm btn-warning"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
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

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/bootstrap-datepicker.es.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable//jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $(document).on("click","#NewPaymentPlan", function() {
        $("#NewOrEditModal").load("../plandepago/editar");
    });
    $(document).on("click","#NewPaymentMethod", function() {
        $("#NewOrEditModal").load("../metododepago/editar");
    });
    $(document).on("click","#NewPaymentConcept", function() {
        $("#NewOrEditModal").load("../conceptodepago/editar");
    });
    $(document).on("click","#NewDiscount", function() {
        $("#NewOrEditModal").load("../descuento/editar");
    });



    $(document).on("click",".deletepaymentplan", function() {
        $("#DelClassroomModal").load("../plandepago/borrar?cod_payment_plan=" + $(this).attr('id'));
    });
    $(document).on("click",".deletepaymentmethod", function() {
        $("#DelClassroomModal").load("../metododepago/borrar?cod_payment_method=" + $(this).attr('id'));
    });
    $(document).on("click",".deletepaymentconcept", function() {
        $("#DelClassroomModal").load("../conceptodepago/borrar?cod_concept=" + $(this).attr('id'));
    });
    $(document).on("click",".deletediscount", function() {
        $("#DelClassroomModal").load("../descuento/borrar?cod_discount=" + $(this).attr('id'));
    });

    $(document).on('click','.edityear', function() {
        $("#NewOrEditModal").load("../administrativa/editaryear?cod_school_year=" + $(this).attr('id'));
    });
    $(document).on("click", ".editpaymentplan",function() {
        $("#NewOrEditModal").load("../plandepago/editar?cod_payment_plan=" + $(this).attr('id'));
    });
    $(document).on("click",".editpaymentmethod", function() {
        $("#NewOrEditModal").load("../metododepago/editar?cod_payment_method=" + $(this).attr('id'));
    });
    $(document).on("click",".editpaymentconcept", function() {
        $("#NewOrEditModal").load("../conceptodepago/editar?cod_concept=" + $(this).attr('id'));
    });
    $(document).on("click",".editdiscount", function() {
        $("#NewOrEditModal").load("../descuento/editar?cod_discount=" + $(this).attr('id'));
    });


    $(document).on('click',"#delete", function() {
        $("#formdelete").submit();
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

@section('js')
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();
});
</script>
@stop

