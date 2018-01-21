@extends('adminlte::page')

@section('title', 'Reportes Mobingresos')

@section('content_header')
<h1>Reportes <small>Estadísticas Generales de Ganancias</small></h1>
<ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@yield('titlereporte')</li>
</ol>   
@stop

@section('content')
<div class="row"> 
	<div class="col-lg-12">
		<div class="box box-primary">
			<div class="box-body">
         <form role="form" class="form-horizontal tasi-form" action="" method="post" enctype="multipart/form-data">
         {!! csrf_field() !!} 
         <div class="col-lg-2">
            <div class="form-group">
              <label> Consultar Periodo:</label>
              <div class="input-group">
                <button type="button" class="btn btn-default pull-right" id="daterange-btn" name="fechas">
                  <span><i class="fa fa-calendar"></i> {{ date( 'F j, Y', strtotime( '-6 day', strtotime(date('F j, Y'))))  }} - {{ date('F j, Y') }}</span>
                  <i class="fa fa-caret-down"></i>
                </button>
                
              </div>
            </div>
          </div>
          <div class="col-lg-2">
              <div class="form-group">
                  <label> &nbsp; </label>
                  <div class="input-group">
                      <button type="submit" class="btn btn-info"> <i class="fa fa-fw fa-search"></i> Filtar</button>
                  </div>
              </div>
          </div>
          <input type="hidden" name="fecha1" id="fecha1" value="<?=date( 'Y-m-d', strtotime( '-6 day', strtotime(date('Y-m-d'))))?>">
          <input type="hidden" name="fecha2" id="fecha2" value="<?=date('Y-m-d')?>">
        </form>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Gráfica de Progreso desde el {{ date('d-m-Y', strtotime($first)) }} hasta el {{ date('d-m-Y', strtotime($last)) }} </h3>
            </div>
            <div class="box-body">
              @yield('graficaes')
            </div>                  

    </div>
  </div> 
</div> 
<div class="row">
	<div class="col-lg-12">
		<div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Tabla Estadística desde el {{ date('d-m-Y', strtotime($first)) }} hasta el {{ date('d-m-Y', strtotime($last)) }}</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped" id="lgerev">
                      @yield('tablaes')
                  </table>
              </div>
            </div>            			

		</div>
	</div>
</div>
 
@stop

@section('css')
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@stop

@section('js')
<script src="https://adminlte.io/themes/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
 <!-- Para la grafica -->
<script src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>
<script>
  //$(document).ready(function() {
      //$('#daterange-btn span').html('<i class="fa fa-calendar"></i> ' + moment().subtract('days', 29).format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
  //});    

  $(function () {

    $('#lgerev').DataTable({
        //pagingType: 'full',
        "order": [[ @yield('order'), "desc" ]],
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

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Último Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        },
        startDate: moment().subtract(6, 'days'),
        endDate  : moment(),
        locale: {
			  applyLabel: 'Aceptar',
        cancelLabel: 'Cancelar',
			  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Deciembre'],
			  customRangeLabel: 'Personalizado',
		  },
        opens: "right",
      },
      function (start, end) {

        X = asigna(start, end);

        $('#daterange-btn span').html('<i class="fa fa-calendar"></i> ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

  })

  function asigna(start, end){
    var fecha1 = start.format('YYYY-MM-DD');
    var fecha2 = end.format('YYYY-MM-DD');

    $("#fecha1").attr('value',fecha1);
    $("#fecha2").attr('value',fecha2);
  }
</script>
@yield('datosgrafica')
@stop