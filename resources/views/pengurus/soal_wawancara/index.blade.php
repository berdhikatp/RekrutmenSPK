@extends('layouts.app')
@section('title','Wawancara')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>Soal Wawancara</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Soal Wawancara</a></li>
    </ul>
  </div>

  <div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        @if ($data->count() < 10)
          <a href="{{route('soal_wawancara.create')}}" class="btn btn-success pull-right">Tambah</a>
        @endif
        
        <h3 class="tile-title">Soal Wawancara</h3>
        <div class="table-responsive">
          <table id="mydata" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Aksi</th>
              </tr>
            </thead>           
            <tbody>
              @foreach($data as $datas)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td class="text-left">{{$datas->pertanyaan}}</td>
                <td class="d-flex p-2" style="place-content: center;">
                  <a href="{{route('soal_wawancara.edit', $datas->id)}}" class='btn btn-primary btn-sm mx-2'>Edit</a>
                  <form action="{{route('soal_wawancara.delete', $datas->id)}}" method="POST"
                    class="table-controls text-center">
                    @csrf
                    @method('POST')
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                  </form>
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