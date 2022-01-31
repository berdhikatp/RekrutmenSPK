@extends('layouts.app')
@section('title','Data Kriteria')

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
            <div class="clearfix"></div>
            <div class="col-md-10">
              <div class="tile">
                <div class="card-header">
                <h3 class="tile-title">Tambah Data Soal</h3>
                
                <form method="POST" action="{{route('datasoal.store')}}"  class="form-horizontal">
                    @csrf
                        
                        <div class="form-group">
                            <label class="control-label">Data Soal</label>
                            <input class="form-control" type="text" name="pertanyaan" placeholder="Masukan data soal">
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
          </div>
  </main>

 
@endsection