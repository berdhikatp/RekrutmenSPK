
@if (auth()->user()->id_role == '1') //Panitia
    <div class="app-sidebar__overlay" data-toggle="sidebar">hahaha</div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="height: 100px;width: auto;margin-left: 55px;" src="{{asset('assets/images/logohmti.png')}}" alt="User Image">
        
      </div>
        <p style="color: white; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif; margin-inline-end: 10px">HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</p>
      
      <ul class="app-menu">
        <li><a class="app-menu__item" href="{{route('panitia.index')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="{{route('validasi.index')}}" ><i class="app-menu__icon fa fa-group"></i><span class="app-menu__label">Validasi Pendaftar</span></a></li>
        <li><a class="app-menu__item " href="{{route('datakriteria.index')}}" ><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Data Kriteria</span></a></li>
        <li><a class="app-menu__item " href="{{route('datasoal.index')}}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Data Soal Tes</span></a></li>
        
      </ul>
    </aside>

@endif

@if (auth()->user()->id_role == '2') //Pengurus
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="height: 100px;width: auto;margin-left: 55px;" src="{{asset('assets/images/logohmti.png')}}" alt="User Image">
        
      </div>
        <p style="color: white; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif; margin-inline-end: 10px">HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</p>
      
      
      <ul class="app-menu">
        <li><a class="app-menu__item " href="{{route('pengurus.index')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item " href="{{route('soal_wawancara.index')}}" ><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Soal Wawancara</span></a></li>
        <li><a class="app-menu__item " href="{{route('wawancara.index')}}" ><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Tes Wawancara</span></a></li>
        <li><a class="app-menu__item " href="{{route('hitung.index')}}" ><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Hitung</span></a></li>
        <li><a class="app-menu__item " href="{{route('hasilseleksi.index')}}"><i class="app-menu__icon fa fa-bullhorn"></i><span class="app-menu__label">Hasil Seleksi</span></a></li>
        <li><a class="app-menu__item " href="{{route('semua_data_hasilseleksi.index')}}"><i class="app-menu__icon fa fa-align-right"></i><span class="app-menu__label">Semua Data <br> Hasil Seleksi</span></a></li>
        
      </ul>
    </aside>
@endif

@if (auth()->user()->id_role == '3') //Mahasiswa
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="height: 80px;width: auto;margin-left: 55px;" src="{{asset('assets/images/logohmti.png')}}" alt="User Image">
      
    </div>
    <p style="color: white; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif; margin-inline-end: 10px">HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</p>
    
    <ul class="app-menu">
      <li><a class="app-menu__item " href="{{route('mahasiswa.index')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item " href="{{route('pendaftaran.create')}}" ><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Pendaftaran</span></a></li>
      @if(auth()->user()->status == 2 )
        <li><a class="app-menu__item " href="{{route('testulis.index')}}" ><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Tes Tulis</span></a></li>
      @elseif(auth()->user()->status >= 2 )
        <li><a class="app-menu__item " href="{{route('mahasiswa.hasilseleksi')}}"><i class="app-menu__icon fa fa-bullhorn"></i><span class="app-menu__label">Hasil Seleksi</span></a></li>
      @endif
      
      
    </ul>
  </aside>
@endif

