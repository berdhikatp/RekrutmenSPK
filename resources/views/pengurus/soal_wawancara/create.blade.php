@extends('layouts.app')

@section('title','Pembobotan')
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
               <div class="car-header">
               <h3 class="tile-title">Soal Wawancara</h3>
               <div class="table-responsive">
                  <form action="{{route('soal_wawancara.store')}}" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                  @csrf
                        
                     <div class="form-group">
                        <label class="control-label">Pertanyaan</label>
                        <input class="form-control" type="text" name="pertanyaan" placeholder="Pertanyaan">
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
   </div>
</main>

</main>
@endsection
