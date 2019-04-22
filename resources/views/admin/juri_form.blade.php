@extends("layout.admin.app")
@section("title","Tambah Juri")
@section("content")
<div class="row">

  <div class="col-md-6 col-md-offset-3">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-plus"></i>
          <h3 class="box-title">Formulir Juri</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-12">
            @if(\Session::has("msg"))
            <div class="alert alert-info">
              <p>{{session("msg")}}{{session()->forget("msg")}}</p>
            </div>
            @endif
            <form class="form-horizontal" action="" method="post">
              {{csrf_field()}}
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required value="{{@$data->nama}}">
              </div>
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" required  value="{{@$data->username}}">
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required value="{{@$data->password}}">
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required  value="{{@$data->email}}">
              </div>
              <div class="form-group">
                  <label>Nomor HP</label>
                  <input type="text" name="hp" class="form-control" required  value="{{@$data->hp}}">
              </div>
              <div class="form-group">
                  <label>Alamat</label>
                  <textarea  name="alamat" class="form-control" required  >{{@$data->alamat}}</textarea>
              </div>
              <input type="text" hidden name="level" value="juri">
              <div class="form-group">
                <button type="submit" class="btn btn-success">
                  <i class="fa fa-save"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection
