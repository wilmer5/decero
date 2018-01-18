@extends('layouts.reportes')

@section('titlereporte') 
	General 
@stop

@section('graficaes')

<canvas id="canvas" height="50"></canvas>

@stop

@section('tablaes')

<thead>
    <tr>
        <th>Fecha</th>
        <th>Visitas</th>
        <th>Conversiones</th>
        <th>CTR</th>
        <th>Ingresos</th>
    </tr>
</thead>
<tbody>
  @foreach ( $valores as $valor )
  <tr> 
    <td> {{ $valor->fecha }} </td>
    <td> {{ $valor->clicks }} </td>
    <td> {{ $valor->altas }} </td>
    <td>  0 </td>
    <td> {{ round($valor->total, 2, PHP_ROUND_HALF_DOWN) }} </td>
  </tr>
  @endforeach
</tbody>

@stop

@section('datosgrafica')
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
<script type="text/javascript">
var MONTHS = [ @foreach ( $valores as $dato ) "{{ $dato->fecha }}", @endforeach ];


    var config = {
      type: 'line',
      data: {
        labels: [ @foreach ( $valores as $dato ) "{{ $dato->fecha }}", @endforeach ],
        datasets: [{
          label: "Conversiones",
          borderColor: 'rgb(0,163,203)',
          backgroundColor: 'rgb(0,163,203)',
          data: [ @foreach ( $valores as $dato ) "{{ $dato->altas }}", @endforeach ],
        }, {
          label: "Ganancias",
          borderColor: 'rgb(192,192,192)',
          backgroundColor: 'rgb(192,192,192)',
          data: [ @foreach ( $valores as $dato ) "{{ round($dato->total, 2, PHP_ROUND_HALF_DOWN) }}", @endforeach ],
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
