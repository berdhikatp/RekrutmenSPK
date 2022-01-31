@extends('layouts.app')
@section('title','Wawancara')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>Tes Wawancara</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Tes Wawancara</a></li>
    </ul>
  </div>

  <div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Tes Wawancara</h3>
        <div class="table-responsive">
          <table id="mydata" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nim</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pendaftaran as $pendaftarans)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$pendaftarans->user->nim}}</td>
                <td>{{$pendaftarans->user->name}}</td>
                <td>
                  <a href="{{route('wawancara.create', $pendaftarans->id)}}" class='btn btn-primary'>Mulai Tes</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <!-- <button type="submit" class="btn btn-primary">
                  <i class="ti-save"></i> Hitung
              </button> -->

        </div>
      </div>
    </div>

</main>


@endsection