<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>{{$title}}</title>
    <meta name="keywords" content="akademik,informasi,pengumuman,anda,pencetakan,datang,mahasiswa,dashboard,autodebet,nilai,melihat,aktif,perkuliahan,kalender,ada,perkuliahantidak,transkrip,cuti,hasil">
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="webtitle" content="Perwalian Online">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/public/assets/css.css">
    <link href="{{url('')}}/public/assets/m.css" rel="stylesheet" type="text/css">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{url('')}}/public/assets/jf.js"></script>
    <script src="{{url('')}}/public/assets/m.js"></script>
    @foreach ($css as $val)
    <link rel="stylesheet" href="{{$val}}">
    @endforeach
    <script type="text/javascript">
      var base_url = "{{url("/")}}";
    </script>
    <style>
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-login {
            width: 100%;
            background-color: #343F51;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #34647D;
        }

        #box {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
    <!--script> window.dashboard_config={ title:"Dashboard Mahasiswa" }; </script><script src="http://account.unikom.ac.id/dashboard.js"></script-->
</head>

<body cz-shortcut-listen="true">
    <div id="eis_all" >
        <div>
            <div id="eis_holder">
                <div id="eis_sidebar">
                    <hr>
                    <a href="{{url('/admin')}}" @if(\Request::is('admin')) class='active' @endif><q class="fa fa-home fa-2x"></q>Home</a>
                    <a href="{{url('/admin/mahasiswa')}}" @if(\Request::is('mahasiswa')) class='active' @endif><q class="fa fa-file fa-2x"></q>Mahasiswa</a>
                    <a href="{{url('/admin/jurusan')}}" @if(\Request::is('jurusan')) class='active' @endif><q class="fa fa-file fa-2x"></q>Jurusan</a>
                    <a href="{{url('/admin/keluar')}}" @if(\Request::is('keluar')) class='active' @endif><q class="fa fa-sign-out fa-2x"></q>Keluar</a>
                </div>
