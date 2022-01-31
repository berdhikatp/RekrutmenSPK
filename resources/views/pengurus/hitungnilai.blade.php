@extends('layouts.app')
@section('title','Pembobotan')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>Nilai Kriteria</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Nilai Kriteria</a></li>
    </ul>
</div>

      <div class="row">
         <div class="clearfix"></div>
         <div class="col-md-12">
         <div class="tile">
            <h3 class="tile-title">Nilai Kriteria</h3>
                  <div class="table-responsive">

                  <form action="{{route('pembobotan.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                          <th>No</th>
                          <th>Kriteria</th>
                          <th>Nilai</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          @foreach($data_kriteria as $i=>$row)
                          
                           <td>{{++$i}}</td>
                           <td>{{$row->nama_kriteria}}</td>
                           <td> 
                              
                           </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>

                  <div  class="col-md-6">
                  <button type="submit" class="btn btn-primary ">
                     <i class="ti-save"></i> Hitung
                 </button>
                 </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nilai Akhir 
              
                  <div class="col-md-">
                  <input type="text" disabled class="form-control">
                  </div></label>
                    
                  
                  </form>
               </div>
         </div>
         </div>
      </div>
</main>

</main>
@endsection