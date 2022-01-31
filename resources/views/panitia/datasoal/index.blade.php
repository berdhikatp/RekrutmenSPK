@extends('layouts.app')
@section('title','Data Soal')

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i> Data Soal</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url('panitia/datasoal/index')}}">Data Soal</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <div class="card-header">
                            {{-- <a href="{{route('datasoal.create')}}" class="btn btn-primary pull-right">Tambah</a>
                            --}}
                            <h3 class="tile-title">Data Soal</h3>
                            <table class="table table-striped table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-left">Pertanyaan</th>
                                        {{-- <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($data_soal as $soal)
                                        <tr>
                                            <td rowspan='2' style='width:30px !important;'>{{$soal->id}}</td>
                                            <td class='text-left right'>{{$soal->question1}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">{{$soal->question2}}</td>
                                        </tr>
                                        @endforeach
                                    </tr>
                                </tbody>

                            </table>

                            {{ $data_soal->links() }}
                        </div>
                    </div>
                </div>
            </div>
</main>
<!-- Data table plugin-->
@endsection
