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
            <li class="breadcrumb-item"><a href="{{url('panitia/validasi/index')}}">Validasi</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Validasi Mahasiswa</h3>
                <div class="table-responsive">
                    <table id="mydata" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Semester</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>Upload Foto</th>
                                <th>Upload File</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran as $pendaftarans)
                            <tr>

                                <td>{{$loop->iteration}}</td>
                                <td>{{$pendaftarans->user->nim}}</td>
                                <td>{{$pendaftarans->user->name}}</td>
                                <td>{{$pendaftarans->jenis_kelamin}}</td>
                                <td>{{$pendaftarans->tmpt_lahir}}</td>
                                <td>{{$pendaftarans->tgl_lahir}}</td>
                                <td>{{$pendaftarans->semester}}</td>
                                <td>{{$pendaftarans->alamat}}</td>
                                <td>{{$pendaftarans->no_hp}}</td>
                                <td class="text-center">
                                    <img src="{{ $pendaftarans->ambilFoto() }}" height="200px" alt="">
                                </td>
                                <td>
                                    <a href="{{$pendaftarans->ambilFile()}}">{{$pendaftarans->upload_file}}</a>
                                </td>
                                <td width="10%">
                                    @if ($pendaftarans->user->status == 0)
                                        <div class="alert alert-dismissible alert-danger">
                                                Tidak Lolos Seleksi
                                        </div>
                                    @elseif ($pendaftarans->user->status == 1)
                                        <a href="javascript:;" data-toggle="modal" onclick="TerimaData({{$pendaftarans->id}})" data-target="#TerimaModal">
                                            <button class="btn btn-success btn-sm fa fa-check" title="Validasi"></button>
                                        </a>
                                        <a href="javascript:;" data-toggle="modal" onclick="TolakData({{$pendaftarans->id}})" data-target="#TolakModal">
                                            <button class="btn btn-danger btn-sm fa fa-close" title="Tolak"></button>
                                        </a>
                                    @elseif ($pendaftarans->user->status == 2)
                                        <div class="alert alert-dismissible alert-success">
                                                Lolos Seleski Administrasi
                                        </div>
                                    @elseif ($pendaftarans->user->status == 3)
                                        <div class="alert alert-dismissible alert-danger">
                                                Tidak Lolos Tes
                                        </div>
                                    @elseif ($pendaftarans->user->status == 4)
                                        <div class="alert alert-dismissible alert-danger">
                                                Lolos Tes
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<div id="TerimaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="" id="terimaForm" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Validasi Mahasiswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="status" value="2">
                    </div>
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <p>Apakah anda yakin ingin Memvalidasi Mahasiswa ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success float-right mr-2" onclick="formSubmitterima()">Validasi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="TolakModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="" id="tolakForm" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Validasi Mahasiswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="status" value="0">
                    </div>
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <p>Apakah anda yakin ingin Menolak Mahasiswa ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger float-right mr-2" onclick="formSubmittolak()">Tolak</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        function TerimaData(id) {
            console.log("Hello world!");
            var id = id;
            var url = '{{route("validasi.update", ":id") }}';
            url = url.replace(':id', id);
            $("#terimaForm").attr('action', url);
        }
        function formSubmitterima() {
            $("#terimaForm").submit();
        }
    </script>
    <script type="text/javascript">
        function TolakData(id) {
            var id = id;
            var url = '{{route("validasi.update", ":id") }}';
            url = url.replace(':id', id);
            $("#tolakForm").attr('action', url);
        }
        function formSubmittolak() {
            $("#tolakForm").submit();
        }
    </script>
@endsection
