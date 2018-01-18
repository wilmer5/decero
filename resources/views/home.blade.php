@extends('adminlte::page')

@section('title', 'Mobingresos - Panel')


@section('content_header')
  <h1>Escritorio <small>Resumen Breve</small></h1>
  <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Escritorio</li>
  </ol>   
@stop

@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">

        @if(sizeof($datosgrafica) > 0)
          @if($datosgrafica[sizeof($datosgrafica)-1]->fecha == date('Y-m-d'))
            <h3> {{ $datosgrafica[sizeof($datosgrafica)-1]->registros }} </h3>
          @else
            <h3> 0 </h3>
          @endif
        @else
          <h3> 0 </h3>
        @endif          

        <p>Conversiones de hoy</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">

        @if(sizeof($datosgrafica) > 0)
          @if($datosgrafica[sizeof($datosgrafica)-1]->fecha == date('Y-m-d'))
            <h3> {{ round($datosgrafica[sizeof($datosgrafica)-1]->total, 2, PHP_ROUND_HALF_DOWN) }} <sup style="font-size: 20px">$</sup></h3>
          @else
            <h3> 0 </h3>
          @endif
        @else
          <h3> 0 </h3>
        @endif          

        <p>Ingresos de hoy</p>
      </div>
      <div class="icon">
        <i class="ion ion-pricetags"></i>
      </div>
      <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $valores["cobrado"] }} <sup style="font-size: 20px">$</sup></h3>

        <p>Ingresos Cobrados</p>
      </div>
      <div class="icon">
        <i class="ion ion-calculator"></i>
      </div>
      <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3> {{ $valores["porcobrar"] }} <sup style="font-size: 20px">$</sup></h3>

        <p>Cajero</p>
      </div>
      <div class="icon">
        <i class="ion ion-cash"></i>
      </div>
      <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>


<div class="row">

  <div class="col-lg-6">
    <div class="box box-info">
      <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-bar-chart-o fa-fw"></i> Progreso</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <canvas id="canvas"></canvas>
      </div>
      <!-- /.box-body -->
    </div>
  </div> 

  <div class="col-lg-6">
    <div class="box box-success">
      <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-money fa-fw"></i> Ganancias</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Item #</th>
                        <th>Fecha</th>
                        <th>Conversiones</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ( $datosgrafica as $dato )
                  <tr> 
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $dato->fecha }} </td>
                    <td> {{ $dato->registros }} </td>
                    <td> {{ round($dato->total, 2, PHP_ROUND_HALF_DOWN) }} </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <div class="text-right"> 
              <a href="reportes">Ver Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div> 
    <!-- /.box-footer -->
    </div>
  </div>   

</div>
@stop


@section('js')
 <!-- Para la grafica -->
<script src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>

<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
<script type="text/javascript">
var MONTHS = [ @foreach ( $datosgrafica as $dato ) "{{ $dato->fecha }}", @endforeach ];


    var config = {
      type: 'line',
      data: {
        labels: [ @foreach ( $datosgrafica as $dato ) "{{ $dato->fecha }}", @endforeach ],
        datasets: [{
          label: "Conversiones",
          borderColor: 'rgb(0,163,203)',
          backgroundColor: 'rgb(0,163,203)',
          data: [ @foreach ( $datosgrafica as $dato ) "{{ $dato->registros }}", @endforeach ],
        }, {
          label: "Ganancias",
          borderColor: 'rgb(192,192,192)',
          backgroundColor: 'rgb(192,192,192)',
          data: [ @foreach ( $datosgrafica as $dato ) "{{ round($dato->total, 2, PHP_ROUND_HALF_DOWN) }}", @endforeach ],
        }]
      },
      options: {
        responsive: true,
        title:{
          display:false,
          text:"Progreso de Ganancias Mobingresos"
        },
        tooltips: {
          mode: 'index',
        },
        hover: {
          mode: 'index'
        },
        scales: {
          xAxes: [{
            scaleLabel: {
              display: false,
              labelString: 'Progreso'
            }
          }],
          yAxes: [{
            stacked: true,
            scaleLabel: {
              display: true,
              labelString: 'Ganancias'
            }
          }]
        }
      }
    };

    window.onload = function() {
      var ctx = document.getElementById("canvas").getContext("2d");
      window.myLine = new Chart(ctx, config);
    };  
</script>
@stop