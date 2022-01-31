@extends('layouts.app')
@section('title','Tes Tulis')

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Tes Tulis</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Tes Tulis</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    @if ($pendaftaran)
                    {{-- Jika sudah melaksanakan tes tulis  --}}
                        <h3 class="tile-title text-center pt-5">Berhasil Melaksanakan tes tulis</h3>
                        <h3 class="tile-title text-center pt-5 pb-5">Silahkan Melanjutkan Tes Wawancara</h3>
                    @else
                        <form action="{{ route('testulis.store') }}" method="post">
                            @csrf
                            <div class="table-responsive">
                                <h3 class="tile-title">Kerjakan dengan baik dan teliti</h3>
                                <p>Pilihlah satu dari dua pernyataan yang tertera dibawah sesuai dengan kepribadian anda</p>
                                <table class="table table-striped table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-left">Pilihan</th>
                                            <th class="text-left">Pertanyaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($data_soal as $soal)
                                        <tr>
                                            <td rowspan='2' style='width:30px !important;'>{{$loop->iteration}}</td>
                                            <td width="30px">
                                                <input class="form-check-input checked" type="radio"
                                                    name="soal[{{$soal->id}}]" value="{{$soal->value1_id_papi_roles}}" required></td>
                                            <td class='text-left right'>{{$soal->question1}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="radio" name="soal[{{$soal->id}}]"
                                                    value="{{$soal->value2_id_papi_roles}}" required></td>
                                            <td class="text-left">{{$soal->question2}}</td>
                                        </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>

                                </table>
                                <div class="float-right mt-4">
                                    <button type="submit" class="btn btn-success ml-2">
                                        <i class="ti-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
