@extends("layout.admin.app")
@section("title","Formulir Kelas")
@section("content")
<div class="row">

  <div class="col-md-6 col-md-offset-3">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-plus"></i>
          <h3 class="box-title">Formulir Kelas</h3>
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
