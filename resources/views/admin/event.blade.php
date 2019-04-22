@extends("layout.admin.app")
@section("title","Event")
@section("content")
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-file"></i>
          <h3 class="box-title">Data Event</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <a href="{{url('admin/eventadd')}}" class="btn btn-primary">Tambah</a>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table datatables">
                  <thead>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Deskripsi</th>
                    <th>Header</th>
                    <th>Kelas</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    @foreach($data as $k => $v)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$v->nama}}</td>
                      <td>{{$v->tanggal}}</td>
                      <td>{{$v->deskripsi}}</td>
                      <td>
                        <img src="{{url($v->img_header)}}" style="height:70px;width:auto" onerror="this.src = '//via.placeholder.com/70x70?text=No Image'" alt="">
                      </td>
                      <td>{{$v->kelas->nama}}</td>
                      <td>{{$v->created_at}}</td>
                      <td>
                        <div class="form-group">
                          <a href="{{url("admin/eventedit/".$v->id_event)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        </div>
                        <div class="form-group">
                          <a href="{{url("admin/eventhapus/".$v->id_event)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
                        <div class="form-group">
                          <a href="{{url("admin/eventdetail/".$v->id_event)}}" class="btn btn-primary"><i class="fa fa-gears"></i></a>
                        </div>
                        <div class="form-group">
                          <a href="{{url("admin/eventdetail/".$v->id_event."/hasil")}}" class="btn btn-primary"><i class="fa fa-search"></i></a>
                        </div>
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
