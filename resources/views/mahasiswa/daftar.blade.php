    @extends('layouts.app')
    @section('title','Pendaftaran Peserta')

    @section('content')
    <link href="{{asset('public/panitia/css/jquery.datepicker2.css')}}" rel="stylesheet">
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Pendaftaran</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Pendaftaran</li>
            </ul>
        </div>

        @error('upload_file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        
        @if ($pendaftaran)
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Status Pendaftaran </h3>
                            @if ($pendaftaran->user->status == 0)
                                <div class="alert alert-dismissible alert-danger">
                                    {{-- <button class="close" type="button" data-dismiss="alert">×</button> --}}
                                        Tidak Lolos Seleksi
                                </div>
                            @elseif ($pendaftaran->user->status == 1)
                                <div class="alert alert-dismissible alert-warning">
                                    {{-- <button class="close" type="button" data-dismiss="alert">×</button> --}}
                                        Terima kasih telah mendaftarkan diri anda. <br> Berkas akan diperiksa dan pemberitahuan akan diinformasikan lebih lanjut 
                                </div>
                            @elseif ($pendaftaran->user->status == 2)
                                <div class="alert alert-dismissible alert-success">
                                    {{-- <button class="close" type="button" data-dismiss="alert">×</button> --}}
                                        Berhasil lolos seleksi. Siap Melaksanakan Tes
                                </div>
                            @elseif ($pendaftaran->user->status == 3)
                                <div class="alert alert-dismissible alert-danger">
                                    {{-- <button class="close" type="button" data-dismiss="alert">×</button> --}}
                                        Tidak Lolos Tes
                                </div>
                            @elseif ($pendaftaran->user->status == 4)
                                <div class="alert alert-dismissible alert-danger">
                                    {{-- <button class="close" type="button" data-dismiss="alert">×</button> --}}
                                        Selamat Anda Lolos Tes
                                </div>
                            @endif
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>        
                                        <td>{{$pendaftaran->user->nim}}</td>
                                        <td>{{$pendaftaran->user->name}}</td>
                                        <td>{{$pendaftaran->jenis_kelamin}}</td>
                                        <td>{{$pendaftaran->tmpt_lahir}}</td>
                                        <td>{{$pendaftaran->tgl_lahir}}</td>
                                        <td>{{$pendaftaran->semester}}</td>
                                        <td>{{$pendaftaran->alamat}}</td>
                                        <td>{{$pendaftaran->no_hp}}</td>
                                        <td>
                                            <img src="{{ $pendaftaran->ambilFoto() }}" height="200px" alt="">
                                        </td>
                                        <td>
                                            <a href="{{$pendaftaran->ambilFile()}}">{{$pendaftaran->upload_file}}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-offset">
                <div class="tile">
                    <h3 class="tile-title ml-4">Pendaftaran</h3>
                    <div class="tile-body ml-4">

                        <form method="POST" action="{{route('pendaftaran.store')}}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label class="control-label col-md-3">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="state_jenis" name="jenis_kelamin">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Tempat Lahir</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="tmpt_lahir"
                                        placeholder="Masukan Tempat Lahir Anda">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Tanggal Lahir</label>
                                <div class="col-md-6">
                                    <input class="form-control" id="demoDate" type="text" name="tgl_lahir"
                                        placeholder="Masukan Tanggal Lahir Anda">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Semester</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="state_jenis" name="semester">
                                        <option value="satu">Semester 1</option>
                                        <option value="tiga">Semester 3</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="4" type="text" name="alamat"
                                        placeholder="Masukan Alamat Anda"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">No HP</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="no_hp" placeholder="Masukan Nomor HP">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3 pt-2">Masukan foto</label>
                                <div class="col-md-6">
                                    <small class="form-text text-danger" id="fileHelp">file berupa .JPG, max file 2 Mb</small>
                                    <input class="form-control @error('upload_foto') is-invalid @enderror" type="file" name="upload_foto" autocomplete="upload_foto" autofocus>
                                </div>
                            </div>
                            @error('upload_foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="form-group row">
                                <label class="control-label col-md-3 pt-2">Masukan file pendukung</label>
                                <div class="col-md-6">
                                    <small class="form-text text-danger" id="fileHelp">PDF, max file 2 Mb</small>
                                    <input class="form-control @error('upload_file') is-invalid @enderror" type="file" name="upload_file" autocomplete="upload_file" autofocus>
                                </div>
                            </div>
                            @error('upload_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="submit" class="btn btn-success">
                                <i class="ti-save"></i> Simpan
                            </button>

                            <button type="reset" class="btn btn-danger">
                                <i class="ti-reload"></i> Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <script type="text/javascript">
            //jquery select
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });

            $('#demoDate').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                todayHighlight: true
            });

        </script>
    </main>


    @endsection
