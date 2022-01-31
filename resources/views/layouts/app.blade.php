<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.partials._top')
    @notifyCss

  </head>
  <body class="app sidebar-mini">
    
    <x:notify-messages />
    <!-- Navbar-->
    @include('layouts.partials._header')
    {{-- Sidebar menu --}}
    @include('layouts.partials._sidebar')
    {{-- dashboard --}}
    @yield('content')
    <!-- Essential javascripts for application to work-->
    @include('layouts.partials._bottom')

    @notifyJs

  </body>
</html>

{{-- 
  status tabel user 
0 = Tidak Lolos Seleksi
1 = Proses Validasi / setelah mendaftar hmti
2 = Lolos Seleksi Administrasi
3 = Tidak Lolos Tes
4 = Lolos Tes


status tabel pendaftaran
1 = siap melaksanakan tes tulis jika status user = 2
2 = sudah melaksanakan tes tulis / lanjut ke tes wawancara
3 = sudah melaksanakan tes wawancara dan siap dihitung untuk perangkingan


--}}