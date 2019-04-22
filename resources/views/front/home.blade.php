@extends("layout.front.app")
@section("title","Kicau Burung")
@section("content")
<div class="row">
  <div class="col-md-12">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active">
          <img src="//via.placeholder.com/2000x800?text=Slide 1" >
        </div>

        <div class="item">
          <img src="//via.placeholder.com/2000x800?text=Slide 2" >
        </div>

        <div class="item">
          <img src="//via.placeholder.com/2000x800?text=Slide 3" >
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-md-12"  style="margin-top:20px">
    <div class="jumbotron">
      <h1>Hello, Bird Lovers! Salam Gacor!</h1>
      <p>Selamat datang di website Kicau Burung, tempat para pecinta burung berkumpul. Kalian Bird Lovers yang lagi cari kontes buat burung, lihat hasil kontes-kontes kicau burung disini tempatnya. Segera daftarkan burung kalian.</p>
      <p><a class="btn btn-primary btn-lg" href="{{url("register")}}" role="button">Daftar</a></p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <h3>Event Terbaru</h3>
  </div>
  @foreach(\Burung\Event::all() as $k => $v)
  <div class="col-xs-6 col-md-3">
      <div class="thumbnail">
        <img src="{{url($v->img_header)}}" style="width: auto;height:200px" >
        <div class="caption">
          <h3>{{$v->nama}}</h3>
          <p>{{$v->deskripsi}}</p>
          <p>Tanggal Pelaksanaan : {{date("d-m-Y",strtotime($v->tanggal))}}</p>
          <p><a href="{{url("peserta/event/".$v->id_event."/register")}}" class="btn btn-primary" role="button">Daftar</a> <a href="{{url("hasil/".$v->id_event)}}" class="btn btn-default" role="button">Lihat Hasil</a></p>
        </div>
      </div>
  </div>
  @endforeach
</div>
@endsection
