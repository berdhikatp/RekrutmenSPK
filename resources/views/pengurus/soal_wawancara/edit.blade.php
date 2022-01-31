@extends('layouts.app')
@section('title','Data Soal Wawancara')

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
        <h1><i class="fa fa-book"></i> Data Soal Wawancara</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Data Soal Wawancara</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
        <div class="tile">
            <div class="card-header">
            <h3 class="tile-title">Ubah Data Soal Wawancara</h3>
            <form action="{{route('soal_wawancara.update', $data->id)}}" method="POST" class="section contact">
            @csrf
                @method('POST')
                
                    <div class="form-group">
                        <label class="control-label">Pertanyaan</label>
                        <input class="form-control" name="pertanyaan" value="{{old('pertanyaan', $data->pertanyaan)}}" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save"></i> Ubah
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="ti-reload"></i> Reset
                    </button>
            </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</main>
@endsection
