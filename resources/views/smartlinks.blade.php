@extends('adminlte::page')

@section('title', 'Smartlinks')


@section('content_header')
    <h1>Enlaces y Scripts <small>Herramientas de trabajo</small></h1>
	<ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Smartlinks</li>
    </ol>   
@stop

@section('content')

<div class="row">
	<div class="col-md-6">
	<a href="http://whos.amung.us/stats/{{ Auth::user()->grafica }}" target="_blank">
         <button type="button" class="btn btn-primary btn-lg">Gráfica de Visitas</button> 
    </a>
	</div>
</div>	

<div class="row">
	<div class="col-md-12">

		<h3> Herramientas </h3>
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Enlaces directos</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Redirección Móvil</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Redirección General</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              		<div id="linkadulto">
	                	<h4> Smartlink Adulto</h4>
	                	<pre style="font-weight: 600;"> <code>http://moblinkplay.com/?aid=a{{ Auth::user()->id }}</code> <button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button> </pre>
                	</div>
                	<br>
                	<div id="linkocio">
                		<h4> Smartlink Ocio</h4>
                		<pre style="font-weight: 600;"> <code>http://moblinkplay.com/?aid=o{{ Auth::user()->id }}</code> <button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button> </pre>                	
                	</div>
                	<br>
                	<div class="callout callout-success">
		                <h4>Observación:</h4>

		                <p>Estos enlances son para usarlos en tus páginas y landing personalizadas, no por para publicarlos directamente.</p>
		            </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              		<div id="rlinkadulto">
	                	<h4> Redirección Móvil Adulto</h4>
	                	<pre style="font-weight: 600;"> <code>&lt;img src="http://whos.amung.us/widget/{{ Auth::user()->grafica }}.png" />
 &lt;script src="http://moblinkplay.com/jsredir.js">&lt;/script>
 &lt;script> mobredir("a{{ Auth::user()->id }}"); &lt;/script></code> <button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button> </pre>
                	</div>
                	<br>
                	<div id="rlinkocio">
                		<h4> Redirección Móvil Ocio</h4>
                		<pre style="font-weight: 600;"> <code>&lt;img src="http://whos.amung.us/widget/{{ Auth::user()->grafica }}.png" />
 &lt;script src="http://moblinkplay.com/jsredir.js">&lt;/script>
 &lt;script> mobredir("o{{ Auth::user()->id }}"); &lt;/script></code> <button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button> </pre>                	
                	</div>
                	<br>
                	<div class="callout callout-success">
		                <h4>Modo de Uso:</h4>

		                <p>Copia y pega el código seleccionado en la sección &lt;head> de tus páginas web.</p>
		            </div>                	
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
              		<div id="rtlinkadulto">
	                	<h4> Redirección Total Adulto</h4>
	                	<pre style="font-weight: 600;"> <code>&lt;img src="http://whos.amung.us/widget/{{ Auth::user()->grafica }}.png" />
 &lt;script type="text/javascript">
 function rgeneral(){
   window.locationf="http://moblinkplay.com/?aid=a{{ Auth::user()->id }}";
 } 
 setTimeout ("rgeneral()", 3000); 
 &lt;/script></code> <button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button> </pre>
                	</div>
                	<br>
                	<div id="rtlinkocio">
                		<h4> Redirección Total Ocio</h4>
                		<pre style="font-weight: 600;"> <code>&lt;img src="http://whos.amung.us/widget/{{ Auth::user()->grafica }}.png" />
 &lt;script type="text/javascript">
 function rgeneral(){
   window.locationf="http://moblinkplay.com/?aid=o{{ Auth::user()->id }}";
 } 
 setTimeout ("rgeneral()", 3000); 
 &lt;/script></code> <button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button> </pre>                	
                	</div>
                	<br>
                	<div class="callout callout-success">
		                <h4>Modo de Uso:</h4>

		                <p>Copia y pega el código seleccionado en la sección &lt;head> de tus páginas web.</p>
		            </div>  
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
	</div>
</div>	

@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

<script type="text/javascript">
$('.copiar').on('click', function() {
	var titulo = $(this).parent().parent().find('h4').get(0).innerHTML;
	var copy = $(this).parent().find('code');
	var $temp = $("<input>")
    $("body").append($temp);
    $temp.val($(copy).text()).select();
    document.execCommand("copy");
    $temp.remove();
    alertify.success('<b>Copiado:</b> ' + titulo );
});
</script>
@stop

@section('css')
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>

@stop