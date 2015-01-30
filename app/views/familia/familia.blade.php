@extends('layouts.home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/datatable/datatables.css">
@stop

@section('side')
@stop

@section('content')
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
	<h1 class="page-header">Familia</h1>
	<div class="table-responsive">
	    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
	      	<thead>
	        	<tr>
	          		<th>Familia</th>
	          		<th></th>
	        	</tr>
	      	</thead>
	      	<tbody>
	      		@foreach ($familias as $familia)
	        	<tr>
	          		<td>{{$familia->family_identity}}</td>
	          		<td></td>
	        	</tr>
	        	@endforeach
	      </tbody>
	    </table>
	</div>
</div>
@stop

@section('js')
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{URL::to('/')}}/datatable/datatables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#example').dataTable();
});
</script>
@stop