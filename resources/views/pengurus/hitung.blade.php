@extends('layouts.app')
@section('title','Data Kriteria')

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Hitung Nilai Calon Anggota HMTI ({{date('Y')}})</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Hitung Nilai</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Hitung Nilai</h3>

                <a href="{{ route('hitung.mulai', ['hitung' => 'mulai']) }}">
                    <button class="btn btn-success btn-lg btn-block mb-5" type="button">Mulai Hitung</button>
                </a>
                <table id="mydata" class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="99">List Daftar Altenatif</th>
                        </tr>
                        <tr>
                            <th>Id</th>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_pendaftaran as $data)
                        <tr>

                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->user->nim}}</td>
                            <td>{{$data->user->name}}</td>
                            <td>{{$data->jenis_kelamin}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($hitung_mulai)

                    {{-- Matriks Perbandingan Kriteria AHP --}}
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="10">Matriks Perbandingan Kriteria AHP</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    @foreach ($kri3 as $kri3)
                                        <th>{{$kri3->kode}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_tfn as $item => $value)
                                <tr>
                                    <th>{{$value['kode_kriteria']}} - {{$value['nama']}}</th>
                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                    @foreach ($d_nilai[$item] as $key => $v)
                                        {{-- <td>{{$key}}</td> --}}
                                        <td>{{$v['nilai']}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Matriks Perbandingan Kriteria Fuzzy AHP --}}
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="99">Matriks Perbandingan Kriteria Fuzzy AHP</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    @foreach ($kri4 as $kri4_fuzzy)
                                        <th colspan="3">{{$kri4_fuzzy->kode}}</th>
                                    @endforeach
                                    <th colspan="3">Jumlah Baris</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    @foreach ($kri4 as $kri4)
                                        <th>L</th>
                                        <th>M</th>
                                        <th>U</th>
                                    @endforeach
                                    <th>L</th>
                                    <th>M</th>
                                    <th>U</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_tfn as $item => $value)
                                <tr>
                                    <th>{{$value['kode_kriteria']}}</th>
                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                    @foreach ($d_nilai_lmu[$item] as $key => $v)
                                        <td>{{$v['nilai_l']}}</td>
                                        <td>{{$v['nilai_m']}}</td>
                                        <td>{{$v['nilai_u']}}</td>
                                    @endforeach
                                    @foreach ($jumlah_baris[$item] as $jb)
                                        <td>{{$jb['jumlah_l']}}</td>
                                        <td>{{$jb['jumlah_m']}}</td>
                                        <td>{{$jb['jumlah_u']}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-left" colspan="{{$data_kriteria_tot * 3 + 1}} ">Total [L, M, U]</td>
                                    @foreach ($total_baris as $item)
                                        <td>{{$item['total_l']}}</td>
                                        <td>{{$item['total_m']}}</td>
                                        <td>{{$item['total_u']}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Perhitungan Nilai Sintesis (Si) --}}
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="99">Perhitungan Nilai Sintesis (Si)</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Jumlah Baris</th>
                                    <th colspan="3">Nilai Sintesis</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>U</th>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>U</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_tfn as $item => $value)
                                <tr>
                                    <th>{{$value['kode_kriteria']}}</th>
                                    @foreach ($jumlah_baris[$item] as $jb)
                                        <td>{{$jb['jumlah_l']}}</td>
                                        <td>{{$jb['jumlah_m']}}</td>
                                        <td>{{$jb['jumlah_u']}}</td>
                                    @endforeach
                                    
                                    @foreach ($nilai_sintesis[$item] as $jb)
                                        <td>{{$jb['nilai_si_l']}}</td>
                                        <td>{{$jb['nilai_si_m']}}</td>
                                        <td>{{$jb['nilai_si_u']}}</td>
                                    @endforeach

                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    {{-- Penentuan Nilai Vektor (V) dan Nilai Ordinat Defuzzifikasi (d') --}}
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="99">Penentuan Nilai Vektor\ (V) dan Nilai Ordinat Defuzzifikasi (d')</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Bobot Vektor</th>
                                    <th colspan="2">Normalisasi</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Nilai</th>
                                    <th>Min</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_tfn as $item => $value)
                                <tr>
                                    <th>{{$value['kode_kriteria']}}</th>
                                    <td>
                                        @foreach ($defuzzifikasi[$item] as $val)
                                            {{$val}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($defuzzifikasi_min[$item] as $val)
                                            {{$val['nilai']}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($normalisasi_bobot_vektor[$item] as $val)
                                            {{$val}}
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    {{-- Hasil Pembobotan --}}
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="99">Hasil Pembobotan</th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Alternatif</th>
                                    @foreach ($kri1 as $kri1)
                                        <th>{{$kri1->kode}}</th>
                                    @endforeach
                                    <th>Nilai Wawancara</th>
                                    <th rowspan="2">Grafik</th>
                                    <th rowspan="2">Total</th>
                                </tr>
                                <tr>
                                    @foreach ($normalisasi_bobot_vektor as $item)
                                        <th>{{$item['nilai_normalisasi']}}</th>
                                    @endforeach
                                    <th>1</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $item => $value)
                                <tr>
                                    <th>{{$value->user->name}}</th>
                                    @foreach ($nilai_tes_tulis[$item][0] as $val)
                                        <td>{{$val->nilai}}</td>
                                    @endforeach
                                    @foreach ($nilai_wawancara[$item] as $val)
                                        <td>{{$val->nilai}}</td>
                                    @endforeach
                                    <td>
                                        <h5>
                                            <a href="{{route('hitung.grafik_nilai_kriteria', $value->id_users)}}" target="_blank">
                                                <button style="color: black;" class="btn btn-primary btn-sm">
                                                Lihat Grafik
                                                </button>
                                            </a>
                                            <!-- <button style="color: black;" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Grafik Kriteria
                                            </button> -->
                                        </h5>
                                    </td>
                                    @foreach ($total_nilai_akhir[$item] as $val)
                                        <td>{{$val}}</td>
                                    @endforeach
                                </tr>
                                <!-- <tr>
                                    <td colspan="99" id="accordion">

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <canvas class="embed-responsive-item" id="radarChartDemo"></canvas>
                                                </div>
                                            </div>
                                            </div>
                                    </td>
                                </tr> -->
                                    
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

</main>
<!-- <script type="text/javascript">
  $(document).ready(function() {

    $('#mydata').DataTable();

  });
</script> -->

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Grafik Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="radarChartDemo"></canvas>
        </div>
    </div>
    </div>
</div>
</div> -->
@endsection

