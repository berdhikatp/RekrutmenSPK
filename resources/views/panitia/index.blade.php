@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard Panitia</h1>
        <p>Sistem Pendukung Keputusan Rekrutmen Pengurus HMTI</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Jadwal Pendaftaran</h4>
            <p><b>2 Mei 2021</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
          <div class="info">
            <h4>Jadwal Test Tulis</h4>
            <p><b>11 Mei 2021</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 ">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-file-audio-o  fa-3x"></i>
          <div class="info">
            <h4>Jadwal Wawancara</h4>
            <p><b>13 Mei 2021</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-bullhorn  fa-3x"></i>
          <div class="info">
            <h4>Pengumuman Hasil</h4>
            <p><b>30 Mei 2021</b></p>
          </div>
        </div>
      </div>
    </div>
    
</main>

@endsection