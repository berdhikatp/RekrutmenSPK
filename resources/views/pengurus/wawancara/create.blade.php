@extends('layouts.app')

@section('title','Pembobotan')
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
               <h3 class="tile-title">Tes Wawancara {{$pendaftaran->user->name}} ({{$pendaftaran->user->nim}})</h3>
               <div class="table-responsive">
                  <form action="{{route('wawancara.store')}}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                  @csrf
                        
                     <input type="hidden" name="id_user" value="{{$pendaftaran->user->id}}">
                     @foreach ($soal_wawancara as $value)

                        <div class="form-group col-md-8">
                           <label class="col-form-label col-form-label-lg" for="text{{$loop->iteration}}">{{$loop->iteration}}. {{$value->pertanyaan}}</label>
                           <textarea class="form-control" name="soal_wawancara{{$loop->iteration}}" id="text{{$loop->iteration}}" rows="3" required></textarea>
                           <select name="nilai_wawancara{{$loop->iteration}}" class="form-control col-md-3" id="option{{$loop->iteration}}">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                           </select>
                        </div>

                     @endforeach
                        <button type="submit" class="btn btn-primary ">
                           <i class="ti-save"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-danger ">
                           <i class="ti-reload"></i> Reset
                        </button>
                  </form>
               </div>
            </div>
      </div>
   </div>
</main>

</main>
@endsection
