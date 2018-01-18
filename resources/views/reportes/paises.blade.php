@extends('layouts.reportes')

@section('titlereporte') 
	Paises 
@stop

@section('graficaes')

<div class="col-lg-4">
 <canvas id="chart-area"  />
</div>
<div class="col-lg-4">
 <canvas id="chart-area2"  />
</div> 
<div class="col-lg-4">
 <canvas id="chart-area3"  />
</div> 

@stop

@section('tablaes')

<thead>
    <tr>
        <th>Pais</th>
        <th>Visitas</th>
        <th>Conversiones</th>
        <th>CTR</th>
        <th>Ingresos</th>
    </tr>
</thead>
<tbody>
  @foreach ( $valores as $valor )
  <tr> 
    <td> {{ $valor->pais }} </td>
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

<script>

	function random_rgba() {
	    var o = Math.round, r = Math.random, s = 255;
	    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
	}

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{ data: [@foreach ( $valores as $dato ) "{{ $dato->clicks }}", @endforeach],
                backgroundColor: [

                @foreach ( $valores as $dato )
                    random_rgba(),
				@endforeach
                ],
                label: 'Dataset 1'
            }],
            labels: [@foreach ( $valores as $dato ) "{{ $dato->pais }}", @endforeach]
        },
        options: {
            responsive: true,
            legend: {
                display: false,

            },
            title: {
                display: true,
                text: 'Clicks'
            },
            animation: {
                animateScale: true,
                animateRotate: true,
            }
        }
    };

    var config2 = {
        type: 'doughnut',
        data: {
            datasets: [{ data: [@foreach ( $valores as $dato ) "{{ $dato->altas }}", @endforeach],
                backgroundColor: [

                @foreach ( $valores as $dato )
                    random_rgba(),
				@endforeach
                ],
                label: 'Dataset 1'
            }],
            labels: [@foreach ( $valores as $dato ) "{{ $dato->pais }}", @endforeach]
        },
        options: {
            responsive: true,
            legend: {
                display: false,

            },
            title: {
                display: true,
                text: 'Conversiones'
            },
            animation: {
                animateScale: true,
                animateRotate: true,
            }
        }
    };    

    var config3 = {
        type: 'doughnut',
        data: {
            datasets: [{ data: [@foreach ( $valores as $dato ) "{{ round($dato->total, 2, PHP_ROUND_HALF_DOWN) }}", @endforeach],
                backgroundColor: [

                @foreach ( $valores as $dato )
                    random_rgba(),
				@endforeach
                ],
                label: 'Dataset 1'
            }],
            labels: [@foreach ( $valores as $dato ) "{{ $dato->pais }}", @endforeach]
        },
        options: {
            responsive: true,
            legend: {
                display: false,

            },
            title: {
                display: true,
                text: 'Ganancias'
            },
            animation: {
                animateScale: true,
                animateRotate: true,
            }
        }
    };      

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myDoughnut = new Chart(ctx, config);

        var ctx2 = document.getElementById("chart-area2").getContext("2d");
        window.myDoughnut = new Chart(ctx2, config2);        

        var ctx3 = document.getElementById("chart-area3").getContext("2d");
        window.myDoughnut = new Chart(ctx3, config3);                
    };    
    </script>
@stop
