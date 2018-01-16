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
              <h3> {{ $conversiones }} </h3>
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
              <h3>{{ $gananciashoy }} <sup style="font-size: 20px">$</sup></h3>

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
              <h3>{{ $cobrado }} <sup style="font-size: 20px">$</sup></h3>

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
              <h3> {{ $porcobrar }} <sup style="font-size: 20px">$</sup></h3>

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
@stop

