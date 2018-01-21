@extends('adminlte::page')

@section('title', 'Referidos')

@section('content_header')
    <h1>Referidos <small>Lista de referidos</small></h1>
	<ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Referidos</li>
    </ol>   
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Refiere a un amigo</h3>
            </div>
            <div class="box-body">
				<p>Refiere a tus amigos y llévate un 10% de sus jugosas ganancias </p>

                <p>Copia el enlace de abajo y envíalo a tus amigos para que puedan inscribirse en Mobingresos</p>

                <p>¡ Así obtendrás un 10% de sus ingresos!</p>

				<h4><i class="fa fa-tags"></i> Enlace de afiliado</h4>

                <pre style="white-space: normal"><code>http://moblinkplay.com/register/{{ Auth::user()->id }}</code><button type="button" class="btn btn-info btn-xs copiar" style="float: right;margin: 0 auto;">Copiar</button></pre>
            </div>            			

		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Lista de Referidos</h3>
            </div>
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="tablar">
                        <thead>
                            <tr>
                                <th>#Item</th>
                                <th>Referido</th>
                                <th>Correo</th>
                                <th>Skype</th>
                                <th>Facebook</th>
                                <th>Fecha de Registro</th>
                            </tr>
                        </thead>
							<tbody>
							@foreach ( $valores as $valor )
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ utf8_decode($valor->name) }}</td>
									<td>{{ $valor->email }}</td>
									<td>{{ $valor->skype }}</td>
									<td>{{ $valor->facebook }}</td>
									<td>{{ date( 'd-m-Y', strtotime($valor->fecha) ) }}</td>
								</tr>
							@endforeach
							</tbody>
					</table>							
 
 				</div>

            </div>            			

		</div>
	</div>
</div>
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

<script type="text/javascript">

  $(function () {
    
    $('#tablar').DataTable({
        language: {
        "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros totales",
        "infoEmpty":      "Mostrando 0 de 0 de 0 registros",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "search": "Buscar _INPUT_",
        "emptyTable": "No se encontraron datos",
        paginate: {
            first:    'Primero',
            previous: 'Atras',
            next:     'Siguiente',
            last:     'Último'
        },
    }
    });

  })   

</script>  

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