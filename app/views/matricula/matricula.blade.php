@extends('layouts.home')

@section('css')
@stop

@section('side')
@stop

@section('content')
<div id="inicio" class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10 main">
	<h1 class="page-header">Matricula <a href="{{action('EstudianteController@nuevo')}}" class="btn btn-success">Nueva Matricula</a> </h1>
	<div class="table-responsive">
	</div>
</div>
@stop