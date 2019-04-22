@extends("layout.admin.app")
@section("title","Data Juri")
@section("content")
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-file"></i>
          <h3 class="box-title">Data Juri</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <a href="{{url('admin/juriadd')}}" class="btn btn-primary">Tambah</a>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table datatables">
                  <thead>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>HP</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$value->nama}}</td>
                      <td>{{$value->alamat}}</td>
                      <td>{{$value->username}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->hp}}</td>
                      <td>{{$value->created_at}}</td>
                      <td>
                        <a href="{{url("admin/juriedit/".$value->id_users)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="{{url("admin/jurihapus/".$value->id_users)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection
