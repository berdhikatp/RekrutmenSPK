@extends('layouts.app')
@section('title','Data Kriteria')

@section('content')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i> Data Kriteria</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Data Kriteria</a></li>
        </ul>
    </div>

    <div class="row">
        
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="card-header">
                    <a href="{{route('datakriteria.create')}}" class="btn btn-success pull-right">Tambah</a>
                    <h3 class="tile-title">Data Kriteria</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Kriteria</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_kriteria as $kriteria)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$kriteria->kode}}</td>
                                <td>{{$kriteria->nama_kriteria}}</td>
                                <td class="d-flex p-2">
                                    <a href="{{route('datakriteria.edit',$kriteria->id)}}"
                                        class="btn btn-warning btn-sm mx-2">Edit</a>
                                    <form action="{{route('datakriteria.destroy',$kriteria->id)}}" method="POST"
                                        class="table-controls text-center">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @if (count($data_kriteria) >= 2) 
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card-header">
                    <h3 class="tile-title">Nilai Bobot Kriteria (Perhitungan AHP)</h3>
                    <form action="{{route('datakriteria.update-nilai-bobot-kriteria')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="form-control" id="kriteria1_id" name="kriteria1_id">
                                        @foreach ($kri1 as $kri1)
                                            <option value="{{$kri1->id}}">{{$kri1->kode}} - {{$kri1->nama_kriteria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="form-control" id="kriteria2_id" name="kriteria2_id">
                                        @foreach ($kri2 as $kri2)
                                            <option value="{{$kri2->id}}">{{$kri2->kode}} - {{$kri2->nama_kriteria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <select class="form-control" id="skala_tfn" name="skala_tfn">
                                        @foreach ($skala_tfn as $skala_tfn)
                                            <option value="{{$skala_tfn['id']}}">{{$skala_tfn['id']}} - {{$skala_tfn['perbandingan']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-warning">
                                    <i class="ti-pencil"></i> Ubah
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive mt-1">
                        <h7 style="font-size: 20px;"> (Perhitungan AHP)</h7>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    @foreach ($kri3 as $kri3)
                                        <th>{{$kri3->kode}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_tfn as $item => $value)
                                <tr>
                                    <th>{{$value['kode_kriteria']}}</th>
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
                    
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered">
                            <h7 style="font-size: 20px;"> (Perhitungan Fuzzy AHP)</h7>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    @foreach ($kri4 as $kri4)
                                        <th>{{$kri4->kode}}</th>
                                    @endforeach
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_tfn as $item => $value)
                                <tr>
                                    <th>{{$value['kode_kriteria']}}</th>
                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                    @foreach ($eigen[$item] as $key => $v)
                                        {{-- <td>{{$key}}</td> --}}
                                        <td>{{$v['nilai_normalisasi']}}</td>
                                    @endforeach
                                    @if ($rata_rata[$item])
                                        <td>{{$rata_rata[$item]['rata_rata']}}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <h6>Consistency Index   : {{$ci}}</h6>
                    <h6 class="mt-2">Ratio Index   : {{$ri}}</h6>
                    <h6 class="mt-2">Consistency Ratio   : 
                        @if($cr == 0)
                            (Undefined)
                        @elseif ($cr < 0.1)
                            {{$cr}}
                            {{-- {{$cr}} (Konsisten) --}}
                        @else
                            {{-- {{$cr}} (Tidak Konsisten) --}}
                            {{$cr}}
                        @endif
                    </h6> -->
                </div>
            </div>
        </div>
    </div>
    @endif
</main>
@endsection
