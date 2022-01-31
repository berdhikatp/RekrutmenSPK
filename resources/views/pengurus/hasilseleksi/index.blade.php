@extends('layouts.app')
@section('title','Hasil Seleksi')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-bullhorn"></i> Hasil Seleksi Penerimaan Anggota HMTI ({{date('Y')}})</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Hasil Seleksi</a></li>
    </ul>
</div>

        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Hasil Seleksi</h3>
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Ranking</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Nilai</th>
                    <th>Grafik Nilai Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($pendaftaran as $pendaftarans)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$pendaftarans->user->nim}}</td>
                      <td>{{$pendaftarans->user->name}}</td>
                      <td>{{$pendaftarans->nilai_akhir}}</td>
                      <td> 
                        <h5>
                          <a href="{{route('hitung.grafik_nilai_kriteria', $pendaftarans->id_users)}}" target="_blank">
                              <button style="color: black;" class="btn btn-primary btn-sm">
                              Lihat Grafik
                              </button>
                          </a>
                        </h5>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
@endsection
