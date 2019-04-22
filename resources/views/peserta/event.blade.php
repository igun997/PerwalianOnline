@extends("layout.admin.app")
@section("title","Dashboard Peserta")
@section("content")
<div class="row">
  <div class="col-md-12">
    @if(\Session::has("msg"))
    <div class="alert alert-info">
      <p>{{session("msg")}}{{session()->forget("msg")}}</p>
    </div>
    @endif
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-dashboard"></i>
          <h3 class="box-title">Daftar Event</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12">
            @foreach(\Burung\Event::all() as $k => $v)
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                  <img src="{{url($v->img_header)}}" style="width: auto;height:200px" >
                  <div class="caption">
                    <h3>{{$v->nama}}</h3>
                    <p>{{$v->deskripsi}}</p>
                    <p>Tanggal Pelaksanaan : {{date("d-m-Y",strtotime($v->tanggal))}}</p>
                    <p>Kelas : {{$v->kelas->nama}}</p>
                    <p><a href="{{url("peserta/event/".$v->id_event."/register")}}" class="btn btn-primary" role="button">Daftar</a> <a href="{{url("hasil/".$v->id_event)}}" class="btn btn-default" role="button">Lihat Hasil</a></p>
                  </div>
                </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
