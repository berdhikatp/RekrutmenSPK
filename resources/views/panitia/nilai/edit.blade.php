@extends('layouts.app')
@section('title','Nilai')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-book"></i>Nilai</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{url('panitia/nilai/index')}}">Nilai</a></li>
    </ul>
  </div>

        <div class="clearfix"></div>
        <div class="col-md-8">
          <div class="tile">
            <div class="card-header">
            <h3 class="tile-title">Ubah Nilai</h3>
            <form action="{{route('nilai.update', $nilai->id)}}" method="POST" class="section contact">
              @csrf
                @method('PATCH')
                
                    <div class="form-group">
                        <label class="control-label">Nilai</label>
                        <input class="form-control" name="nilai" value="{{old('nilai', $nilai->nilai)}}" id="nilai"placeholder="Masukan Nilai">
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
    </div>
  </main>
@endsection
