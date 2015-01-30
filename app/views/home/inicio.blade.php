@extends('layouts.home')

@section('css')
<link href="{{URL::to('/')}}/css/cover.css" rel="stylesheet">
@stop

@section('content')
<div class="col-sm-12 col-md-12 main">
<div class="cover-container">
	<div class="inner cover">
        <img src="img/logo-V.png">
    </div>
    <div class="mastfoot">
        <div class="inner">
            <p>
	            &copy; 
	            SIDMA 
	            @if (date('Y') > 2014)
			       	2014 - {{date('Y')}}
			    @else
			       	{{date('Y')}}
			    @endif
		    </p>
        </div>
    </div>
</div>
</div>
@stop