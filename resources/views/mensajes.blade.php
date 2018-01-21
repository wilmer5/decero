@extends('adminlte::page')

@section('title', 'Mensajes')

@section('content_header')
    <h1>Soporte <small>Enviar mensaje</small></h1>
	<ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mensajes</li>
    </ol>   
@stop

@section('content')
@if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (Session::has('message'))
<div class="alert alert-info alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>Atención! </strong> <span>{{ Session::get('message') }}</span> 
</div>
@endif                  	
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>Atención! </strong> <span>{{ Session::get('error') }}</span> 
</div>						
@endif  

<h1> Mensajes </h1>

@if(sizeof($valores) > 0)

	@if($valores[0]->to != 1)
		<div class="row">
			<div class="col-lg-7">
				<form role="form" class="form-horizontal tasi-form" action="" method="post" enctype="multipart/form-data" >
				{!! csrf_field() !!}
				<div class="box box-success">
		            <div class="box-header">
		              <h3 class="box-title">Enviar Mensaje</h3>
		            </div>
		            <div class="box-body">
		            	<textarea class="form-control" rows="6" id="mensaje" name="mensaje" placeholder="Mensaje ..."></textarea>
		            </div>            			
		            <div class="box-footer">
		            	<button type="submit" class="btn btn-info">Enviar mensaje</button>
		            </div>
				</div>
				</form>
			</div>
		</div>
	@else
    	<div class="callout callout-success">
            <p>Debe esperar que su mensaje sea respondido para enviar mensajes nuevamente.</p>
        </div>		
	@endif

@endif

<div class="row">
<div class="col-lg-7">
	<div class="box box-primary direct-chat direct-chat-info">
		<div class="box-body">	
			<div style="padding: 10px">

@foreach ( $valores as $valor )

	@if ($valor->to != 1)
	<div class="direct-chat-msg right">
	    <div class="direct-chat-info clearfix">
        	<span class="direct-chat-name pull-right">Soporte</span>
        	<span class="direct-chat-timestamp pull-left">{{ $valor->fecha }}</span>
      	</div>
        <div class="direct-chat-msg right">
          <img class="direct-chat-img" src="{{ asset('img/soporte.png') }}"><!-- /.direct-chat-img -->
          <div class="direct-chat-text">
            {{ $valor->mensaje }}
          </div>
        </div>
    </div>
    @else
    	<div class="direct-chat-msg">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-left">{{ Auth::user()->name }}</span>
				<span class="direct-chat-timestamp pull-right">{{ $valor->fecha }}</span>
			</div>
	        <div class="direct-chat-msg">
				<img class="direct-chat-img" src="{{ asset('storage/'.Auth::user()->imagen) }}"><!-- /.direct-chat-img -->
				<div class="direct-chat-text">
				{{ $valor->mensaje }}
				</div>
	        </div>
    	</div>
    @endif

@endforeach

			</div>
		</div>
	</div>
</div>
</div>

@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
@stop

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
@stop