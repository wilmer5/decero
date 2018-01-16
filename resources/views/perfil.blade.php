@extends('adminlte::page')

@section('title', 'Perfil de Usuario')


@section('content_header')
    <h1>Perfil de Usuario <small>Actualizar Datos</small></h1>
	<ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Perfil</li>
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
<div class="row" >
    <div class="col-md-3">
        <section class="panel">
            <header class="panel-heading"> Foto de Perfil </header>
            <div class="panel-body table-responsive">
              <div class="panel-body">
                  <form role="form" class="form-horizontal tasi-form" action="" method="post" enctype="multipart/form-data" >
	                {!! csrf_field() !!}

					<div class="body align-center">
                		<center>
                  			<div class="pic_size" id="image-holder"> 
                                <center> 
	                              @if(Auth::user()->imagen)
	                                <img src="{{ asset('storage/'.Auth::user()->imagen) }}" class="img-responsive img-thumbnail" alt="User Image" id="imagenperfil" >
	                              @else
	                                <img src="{{ asset('img/user.png') }}" class="img-responsive img-thumbnail" alt="User Image" id="imagenperfil" >
	                              @endif
	                          	</center>
                  			</div>
                  			<br>
		                	<div class="btn btn-block btn-info btn-xs">
		                    	<label for="avatar" >Cambiar foto de Perfil</label>
		                  		<input type="file" class="upload" id="avatar" name="avatar" style="opacity: 0;position: absolute;left: 0;top: 0">
		                	</div>                  			
                		</center>
                		<br>
              		</div>

					<div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">&nbsp;</label>
					  <div class="col-sm-10" align="right">
					    <button type="submit" class="btn btn-info">Guardar Foto</button>
					  </div>
					</div>
                  </form>
              </div>
            </div>
        </section>
    </div>	
    <div class="col-md-9">
        <section class="panel">
            <header class="panel-heading"> Información de la cuenta </header>
            <div class="panel-body table-responsive">
              <div class="panel-body">
                  <form role="form" class="form-horizontal tasi-form" action="{{ route('updateperfil') }}" method="post" enctype="multipart/form-data">
	                 {!! csrf_field() !!}
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">{{ trans('adminlte::adminlte.name') }}</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="nombre" name="nombre" value="{{ Auth::user()->name }}" disabled="disabled">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">E-mail</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" disabled="disabled">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Dirección</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="direccion" value="{{ Auth::user()->direccion }}" name="direccion">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Telefono</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="telefono" value="{{ Auth::user()->telefono }}" name="telefono">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Facebook</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="facebook" value="{{ Auth::user()->facebook }}" name="facebook">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Instagram</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="instagram" value="{{ Auth::user()->instagram }}" name="instagram">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Skype</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="skype" value="{{ Auth::user()->skype }}" name="skype">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">&nbsp;</label>
                          <div class="col-sm-10" align="right">
                            <button type="submit" class="btn btn-info">Actualizar Datos</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
        </section>
    </div>


</div>

<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading"> Configuración de Pago </header>
            <div class="panel-body table-responsive">
              <div class="panel-body">
                  <form role="form" class="form-horizontal tasi-form" action="" method="post" enctype="multipart/form-data" >
	                {!! csrf_field() !!}

					<div class="form-group">
						<label class="col-sm-3 col-sm-3 control-label">Tipo de Cuenta</label>
						<div class="col-sm-9">
							<select class="form-control" id="CuentaB" name="pago_tipo" onchange="tipoCuenta();">
								<option value="0" @if($user->cuenta == 0) selected = selected @endif> No asignada</option>
								<option value="1" @if($user->cuenta == 1) selected = selected @endif> Paypal</option>
								<option value="5" @if($user->cuenta == 5) selected = selected @endif> Bancaria Venezuela</option>
								<option value="6" @if($user->cuenta == 6) selected = selected @endif> Wester Unión</option>
							</select>         
							<input type="hidden" name="pagosave" value="1">                                   
						</div>
					</div>

					<div class="form-group" id="divpaises" style="display: none;">
						<label class="col-sm-3 col-sm-3 control-label">País</label>
						<div class="col-sm-9">
						    <select class="form-control" id="paisc" name="paisc" required>
							    @foreach ( $paises as $pais => $value )
									<option 
										value="{{ $value }}" 
										@if($value == $user->paisc) selected = selected @endif> 
										{{ $value }} 
									</option>
								@endforeach					        					    
							</select>    						
						</div>
					</div>					
					<div class="form-group" id="divcorreo" style="display: none;">
						<label class="col-sm-3 col-sm-3 control-label" id="correopago">Correo de Cuenta</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="correoc" name="correoc" value="{{ Auth::user()->correoc }}" >
						</div>
					</div>   

					<div class="form-group" id="divbanco" style="display: none;">
						<label class="col-sm-3 col-sm-3 control-label">Nombre del Banco</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="bancoc" name="bancoc" value="{{ Auth::user()->bancoc }}" >
						</div>
					</div>  
					<div class="form-group" id="divtitular" style="display: none;">
						<label class="col-sm-3 col-sm-3 control-label" id="titular">Titular de la Cuenta</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="titularc" name="titularc" value="{{ Auth::user()->titularc }}" >
						</div>
					</div>  
					<div class="form-group" id="divcedula" style="display: none;">
						<label class="col-sm-3 col-sm-3 control-label" id="cedula">Cédula del Titular</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="cedulac" name="cedulac" value="{{ Auth::user()->cedulac }}" >
						</div>
					</div>  
					<div class="form-group" id="divnumero" style="display: none;">
						<label class="col-sm-3 col-sm-3 control-label">Número de Cuenta</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="numeroc" name="numeroc" value="{{ Auth::user()->numeroc }}" >
						</div>
					</div>
					<div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">&nbsp;</label>
					  <div class="col-sm-10" align="right">
					    <button type="submit" class="btn btn-info">Actualizar Cuenta</button>
					  </div>
					</div>
                  </form>
              </div>
            </div>
        </section>
    </div>	
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading"> Cambio de contraseña </header>
            <div class="panel-body table-responsive">
              <div class="panel-body">
                  <form role="form" class="form-horizontal tasi-form" action="{{ route('updateclave') }}" method="post" enctype="multipart/form-data" >
	                {!! csrf_field() !!}
                      <div class="form-group">
                          <label class="col-sm-4 col-sm-4 control-label">Contraseña anterior</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" id="current_password" name="current_password" value="" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 col-sm-4 control-label">Nueva contraseña</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" id="password" name="password" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 col-sm-4 control-label">Confirmar nueva contraseña</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 col-sm-4 control-label">&nbsp;</label>
                          <div class="col-sm-8" align="right">
                            <button type="submit" class="btn btn-info">Actualizar Contraseña</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
        </section>
    </div> 
</div>


@section('js')
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		tipoCuenta();

		@if (Session::has('error'))
 			alertify.error('{{ Session::get('error') }}');
 		@endif
 		@if (Session::has('message'))
 			alertify.success('{{ Session::get('message') }}');
 		@endif

	});﻿	

	function tipoCuenta(){
		var pago_tipo = $("#CuentaB").val();
		if(pago_tipo == 0){
			$("#divpaises").hide();	
			$("#divcorreo").hide();	
			$("#divbanco").hide();	
			$("#divtitular").hide();	
			$("#divcedula").hide();	
			$("#divnumero").hide();	
		} else if(pago_tipo >= 1 && pago_tipo <= 4){
			$("#divpaises").hide();	
			$("#divcorreo").show();	
			$("#divbanco").hide();	
			$("#divtitular").hide();	
			$("#divcedula").hide();	
			$("#divnumero").hide();	
			var mensajec = $("#CuentaB :selected").text();
			$("#correopago").text("Correo de Cuenta "+mensajec);					
		}	else if(pago_tipo == 6){
			$("#titular").text("Nombre Completo");					
			$("#divpaises").show();	
			$("#divcorreo").hide();	
			$("#divbanco").hide();	
			$("#divtitular").show();	
			$("#divcedula").hide();	
			$("#divnumero").hide();	
		}	else {
			$("#titular").text("Titular de la Cuenta");					
			$("#divpaises").hide();	
			$("#divcorreo").hide();	
			$("#divbanco").show();	
			$("#divtitular").show();	
			$("#divcedula").show();	
			$("#divnumero").show();									
		}			
	}

	document.getElementById("avatar").onchange = function() {
	  var reader = new FileReader(); //instanciamos el objeto de la api FileReader
	 
	  reader.onload = function(e) {
	    //en el evento onload del FileReader, asignamos el path a el src del elemento imagen de html
	    document.getElementById("imagenperfil").src = e.target.result;
	  };
	 
	  // read the image file as a data URL.
	  reader.readAsDataURL(this.files[0]);
	};	
</script>
@stop

@section('css')
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>

@stop


@stop

