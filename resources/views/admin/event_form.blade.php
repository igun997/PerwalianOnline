@extends("layout.admin.app")
@section("title","Formulir Event")
@section("content")
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-plus"></i>
          <h3 class="box-title">Formulir Event</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-12">
            @if(\Session::has("msg"))
            <div class="alert alert-info">
              <p>{{session("msg")}}{{session()->forget("msg")}}</p>
            </div>
            @endif
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <label>Nama Event</label>
                <input type="text" class="form-control" name="nama" value="{{@$data->nama}}">
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date_pick" class="form-control" name="tanggal" value="{{@$data->tanggal}}">
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="8" cols="80">{{@$data->deskripsi}}</textarea>
              </div>
              <div class="form-group">
                @if(isset($data->img_header))
                <img src="{{url($data->img_header)}}" style="height:70px" onerror="this.src='//via.placeholder.com/70x70?text=No Image'" alt="">
                @endif
              </div>
              <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control-file" name="img_header">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select class="form-control" name="id_kelas">
                  <option>== Pilih Kelas ==</option>
                  @foreach(\Burung\Kelas::all() as $k => $v)
                  @if($v->id_kelas == @$data->id_kelas)
                  <option value="{{$v->id_kelas}}" selected>{{$v->nama}}</option>
                  @else
                  <option value="{{$v->id_kelas}}">{{$v->nama}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <input type="text" hidden name="id_admin" value="{{session("id_users")}}">
              <div class="form-group">
                <button type="submit" class="btn btn-success">
                  <i class="fa fa-save"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
