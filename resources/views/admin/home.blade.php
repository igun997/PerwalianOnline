@extends("layout.admin.app")
@section("title","Kicau Burung")
@section("content")
<div class="row">
  <div class="col-md-6">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-dashboard"></i>
          <h3 class="box-title">Verifikasi Peserta</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table datatables">
                <thead>
                  <th>#</th>
                  <th>Nama Peserta</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Terdaftar</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  @foreach($data as $key => $value)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->nama}}</td>
                    <td>{{$value->alamat}}</td>
                    <td>{{$value->hp}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->created_at}}</td>
                    <td>
                      <div class="form-group">
                        <a href="{{url("admin/verifikasi/".$value->id_users)}}" class="btn btn-success">Verifikasi</a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
  <div class="col-md-6">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-dashboard"></i>
          <h3 class="box-title">Statistik Lomba</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection
