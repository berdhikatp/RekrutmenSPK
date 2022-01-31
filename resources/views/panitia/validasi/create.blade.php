@extends('layouts.app')
@section('title','Validasi')

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i>Validasi</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url('panitia/validasi/index')}}">Status Validasi</a></li>
        </ul>
    </div>
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Validasi Mahasiswa</h3>
            <form action="{{route('validasi.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                {{-- @method('PATCH') --}}
                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Status Validasi</label></div>
                    <div class="col col-md-9">
                        <div class="form-check-inline form-check">
                            <label for="inline-radio1" class="form-check-label ">
                                <input type="radio" id="inline-radio1" name="radiostatus_validasi" value="0" class="form-check-input">Ditolak
                            </label>
                            <label for="inline-radio2" class="form-check-label ">
                                <input type="radio" id="inline-radio2" name="radiostatus_validasi" value="1" class="form-check-input">Diterima
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="ti-save"></i> Simpan
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="ti-reload"></i> Reset
                </button>

            </form>
        </div>
    </div>
</main>

@endsection