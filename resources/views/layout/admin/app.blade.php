<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield("title","Kicau Burung")</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!!(stylePack("admin"))["css"]!!}
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>KC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Kicau Burung</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi</li>
        <!-- Optionally, you can add icons to the links -->
        @if(session("level") =="admin")
        <li><a href="{{url("/admin")}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-file"></i> <span>Data Master</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/kelas')}}">Kelas</a></li>
            <li><a href="{{url('/admin/event')}}">Event</a></li>
            <li><a href="{{url('/admin/juri')}}">Juri</a></li>
          </ul>
        </li>
      @elseif(session("level") =="peserta")
      <li><a href="{{url("/peserta")}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
      <li><a href="{{url("/peserta/event")}}"><i class="fa fa-calendar"></i> <span>Acara</span></a></li>
      @else
      <li><a href="{{url("/juri")}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
      <li><a href="{{url("/juri/penilaian")}}"><i class="fa fa-pencil"></i> <span>Penilaian</span></a></li>
      @endif
      <li><a href="{{url("/logout")}}"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
    </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
      @yield("content")
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Kicau Burung
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018.</strong> All rights reserved.
  </footer>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
{!!(stylePack("admin"))["js"]!!}
<script type="text/javascript">
$(function () {
  /* BOOTSTRAP SLIDER */
  $('.slider').slider()
})
</script>
</body>
</html>
