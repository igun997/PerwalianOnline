<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>{{$title}}</title>
    <meta name="keywords" content="akademik,informasi,pengumuman,anda,pencetakan,datang,mahasiswa,dashboard,autodebet,nilai,melihat,aktif,perkuliahan,kalender,ada,perkuliahantidak,transkrip,cuti,hasil">
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="webtitle" content="Perwalian Online">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{url("/")}}/public/assets/jf.js"></script>
    <script src="{{url("/")}}/public/assets/m.js" ></script>
    {!!(stylePack())["css"]!!}
    @foreach ($css as $val)
    <link rel="stylesheet" href="{{$val}}">
    @endforeach

    <script type="text/javascript">
      var base_url = "{{url("/")}}/";
    </script>

</head>

<body cz-shortcut-listen="true">
    <div id="eis_all" class="wrapper">
        <div>
            <div id="eis_holder">
                <div id="eis_sidebar" class="">
                    <a href="{{url('/sekretariat')}}" @if(\Request::is('sekretariat')) class='active' @endif><q class="fa fa-home fa-2x"></q>Beranda</a>
                    <a href="{{url('/sekretariat/isimatkul')}}" @if(\Request::is('sekretariat/isimatkul')) class='active' @endif><q class="fa fa-user fa-2x"></q>Pengisian Mata Kuliah</a>
                    <a href="{{url('/sekretariat/keluar')}}" @if(\Request::is('keluar')) class='active' @endif><q class="fa fa-sign-out fa-2x"></q>Keluar</a>
                </div>