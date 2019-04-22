@extends("layout.front.app")
@section("title","Halaman Masuk")
@section("content")
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Halaman Masuk</h3>
      </div>
      <div class="panel-body">
          <div class="col-md-12">
            @if(\Session::has("msg"))
            <div class="alert alert-info">
              <p>{{session("msg")}}{{session()->forget("msg")}}</p>
            </div>
            @endif
            <form class="form-horizontal" action="" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">
                  Masuk
                </button>
              </div>
            </form>
          </div>
      </div>
      <div class="panel-footer">
        <p>Tidak Punya Akun ? <a href="{{url("register")}}">Buat Baru</a> </p>
      </div>
    </div>
  </div>
</div>
@endsection
