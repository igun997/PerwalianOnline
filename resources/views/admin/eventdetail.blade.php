@extends("layout.admin.app")
@section("title","Detail Event")
@section("content")
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-file"></i>
          <h3 class="box-title">Detail Event [{{$data->nama}}]</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <h4>Kriteria Penilaian</h4>
              </div>
              <div class="col-md-12">
                <form class="" action="{{url("admin/eventdetail/".$data->id_event."/kriteria")}}" method="post">
                <div class="form-group">
                  <label for="">Nama Kriteria</label>
                  <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group">
                  <label for="">Bobot</label>
                  <input type="number" class="form-control" name="bobot">
                </div>
                {{csrf_field()}}
                <input type="text" hidden name="id_event" value="{{$data->id_event}}">
                <div class="form-group">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </form>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table datatables">
                    <thead>
                      <th>Nama</th>
                      <th>Bobot</th>
                      <th>Aksi</th>
                    </thead>
                    <tbody>
                      @foreach(\Burung\Event_kriteria::where(["id_event"=>$data->id_event])->get() as $k => $v)
                      <tr>
                        <td>{{$v->nama}}</td>
                        <td>{{$v->bobot}}</td>
                        <td>
                          <a href="{{url("admin/eventdetail/".$data->id_event."/kriteria/".$v->id_event_kriteria."/del")}}" class="btn btn-danger">Hapus</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <h4>Data Juri</h4>
              </div>
              <div class="col-md-12">
                <form class="" action="{{url("admin/eventdetail/".$data->id_event."/juri")}}" method="post">
                <div class="form-group">
                  <label for="">Nama Juri</label>
                  <select class="form-control" name="id_juri">
                    <option>== Pilih Juri ==</option>
                    @foreach(\Burung\Users::where(["level"=>"juri"])->get() as $k => $v)
                    <option value="{{$v->id_users}}">{{$v->nama}}</option>
                    @endforeach
                  </select>
                </div>
                {{csrf_field()}}
                <input type="text" hidden name="id_event" value="{{$data->id_event}}">
                <div class="form-group">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </form>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table datatables">
                    <thead>
                      <th>Nama Juri</th>
                      <th>Terdaftar</th>
                      <th>Aksi</th>
                    </thead>
                    <tbody>
                      @foreach(\Burung\Juri::where(["id_event"=>$data->id_event])->get() as $k => $v)
                      <tr>
                        <td>{{$v->juri->nama}}</td>
                        <td>{{$v->created_at}}</td>
                        <td>
                          <a href="{{url("admin/eventdetail/".$data->id_event."/juri/".$v->id_role."/del")}}" class="btn btn-danger">Hapus</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <h3>Data Peserta</h3>
                <div class="table-responsive">
                  <table class="table datatables">
                    <thead>
                      <th>No Gantangan</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                    </thead>
                    <tbody>
                      @foreach(\Burung\Event_peserta::where(["id_event"=>$data->id_event])->get() as $k => $v)
                      <tr>
                        <td>{{$v->no_gantangan}}</td>
                        <td>{{$v->users->nama}}</td>
                        <td>{{$v->users->alamat}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection
