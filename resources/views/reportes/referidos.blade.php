@extends('layouts.reportes')

@section('titlereporte') 
	Referidos 
@stop

@section('graficaes')

<canvas id="canvas" height="50"></canvas>

@stop

@section('tablaes')

<thead>
    <tr>
        <th>Item #</th>
        <th>Referido</th>
        <th>Ingreso</th>
    </tr>
</thead>
<tbody>
  @foreach ( $valores as $valor )
  <tr> 
    <td> {{ $loop->iteration }} </td>
    <td> {{ utf8_decode($valor->name) }} </td>
    <td> {{ round($valor->total, 2, PHP_ROUND_HALF_DOWN) }} </td>
  </tr>
  @endforeach
</tbody>

@stop

@section('order')
2
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
var MONTHS = [ @foreach ( $valores as $dato ) "{{ utf8_decode($dato->name) }}", @endforeach ];


    var config = {
      type: 'line',
      data: {
        labels: [ @foreach ( $valores as $dato ) "{{ utf8_decode($dato->name) }}", @endforeach ],
        datasets: [{
          label: "Ganancias",
          borderColor: 'rgb(102,102,255)',
          backgroundColor: 'rgb(102,102,255)',
          data: [ @foreach ( $valores as $dato ) "{{ round($dato->total, 2, PHP_ROUND_HALF_DOWN) }}", @endforeach ],
        }]
      },
      options: {
        responsive: true,
        title:{
          display:false,
          text:"Progreso de Ganancias por referido"
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
