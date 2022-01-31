<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.top')
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    @include('layout.header.header')
    {{-- <!-- Sidebar menu-->
    @include('layout.sidebar.sidebarpanitia') --}}
    {{-- dashboard --}}
    @yield('content')
    <!-- Essential javascripts for application to work-->
    @include('layout.bottom')
  </body>
</html>