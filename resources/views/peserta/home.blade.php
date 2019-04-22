@extends("layout.admin.app")
@section("title","Dashboard Peserta")
@section("content")
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-dashboard"></i>
          <h3 class="box-title">Lengkapi Persyaratan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if($data->status == "nonaktif")
            <div class="alert alert-danger">
              <p>Akun Anda Masih Dalam Status Moderasi</p>
            </div>
          @else
            @if($include->count() > 0)
            <table class="table datatables">
              <thead>
                <th>Nama Event</th>
                <th>Kelas</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                @foreach($include->get() as $k => $v)
                <tr>
                  <td>{{$v->event->nama}}</td>
                  <td>{{$v->event->kelas->nama}}</td>
                  <td>{{$v->event->tanggal}}</td>
                  <td>
                    @if($v->foto_burung == null)
                    <div class="col-md-12">
                      @if(\Session::has("msg"))
                      <div class="alert alert-info">
                        <p>{{session("msg")}}{{session()->forget("msg")}}</p>
                      </div>
                      @endif
                      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="text" hidden name="id_event_peserta" value="{{$v->id_event_peserta}}">
                        <div class="form-group">
                          <label>Foto Burung</label>
                          <input type="file" class="form-control-file" name="foto_burung" value="">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>
                          </button>
                        </div>
                      </form>
                    </div>
                    @else
                    <p>Persyaratan Selesai</p>
                    <p>
                      <img src="{{url($v->foto_burung)}}" class="img-responsive" style="height:100px" alt="">
                    </p>
                    <p>
                      <a href="{{url("peserta/print/".$v->id_event_peserta)}}" class="btn btn-primary"><i class="fa fa-print"></i></a>
                    </p>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <div class="alert al