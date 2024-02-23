<!DOCTYPE html>
<html lang="en">
<head>

  <title>
    @yield('title')
  </title>
  @include('admin_layouts.headers')

</head>
<body class="hold-transition sidebar-mini layout-fixed ">
<div class="wrapper">
@include('admin_layouts.navbar')
@include('admin_layouts.sidebard')


@yield('content')  
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('admin_layouts.footer')
@yield('scripts')


</body>
</html>