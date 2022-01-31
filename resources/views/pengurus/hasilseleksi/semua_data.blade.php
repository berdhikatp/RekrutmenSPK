@extends('layouts.app')
@section('title','Hasil Seleksi')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-bullhorn"></i>  Semua Data Hasil Seleksi Penerimaan Anggota HMTI</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Semua Data Hasil Seleksi</a></li>
    </ul>
</div>

        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12">
              
            <div class="tile">
                <h3 class="tile-title">Hasil Seleksi</h3>
                <form action="{{route('semua_data_hasilseleksi.index')}}" method="get">
                            
                  <div class="form-group ml-3" style="display:inline-block">
                      <div class="input-group rounded">
                          <select name="tahun" id="tahun" type="text" class="form-control">
                              <option value="" selected disabled>- Tahun Angkatan -</option>
                              <option value="">Semua</option>
                              @foreach($tahun_angkatan as $datas)
                                <option value="{{$datas->year}}" @if($datas->year == $thn_pilihan) {{'selected="selected"'}} @endif >{{$datas->year}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
  
                  <button id="button" type="submit" class="btn btn-secondary ml-3" title="Filter">
                      Filter
                      <i class="fa fa-filter btn-icon-append"></i>  
                  </button>
{{--                   
                  <button id="button" type="submit" class="btn btn-danger ml-3" target="_blank" name="cetakPdf" value="cetakPdf" title="Print">
                      Print
                      <i class="ti-printer btn-icon-append"></i>  
                  </button> --}}
  
                </form>

                <div class="table-responsive">
                    
                  <table id="mydata" class="table table-bordered">
                  <thead>
                      <tr>
                      <th>Ranking</th>
                      <th>Nim</th>
                      <th>Nama</th>
                      <th>Nilai</th>
                      <th>Tahun Angkatan</th>
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
                        <td>{{ $pendaftarans->created_at->format('Y') }}</td>
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
        </div>
@endsection
