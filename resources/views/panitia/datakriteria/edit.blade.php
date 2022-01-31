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
                    <h3 class="tile-title">Ubah Data Kriteria</h3>
                    <form action="{{route('datakriteria.update', $data_kriteria->id)}}" method="POST"
                        class="section contact">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label class="control-label">Data kode kriteria</label>
                            <input class="form-control" name="kode" value="{{old('kode', $data_kriteria->kode)}}"
                                id="nama_kriteria" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Data kriteria</label>
                            <input class="form-control" name="nama_kriteria"
                                value="{{old('nama_kriteria', $data_kriteria->nama_kriteria)}}" id="nama_kriteria"
                                placeholder="Masukan data kriteria">
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
