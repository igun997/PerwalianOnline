@extends("layout.admin.app")
@section("title","Penilaian")
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
          <h3 class="box-title">Penilaian Event [{{$data->nama}}]</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <form  action="" method="post">
            <table class="table">
              <thead>
                <th>No Gantangan</th>
                <th>Nama Peserta</th>
                @foreach($kriteria as $kk => $vv)
                <th>{{$vv->nama}} [{{$vv->bobot}}]</th>
                @endforeach
              </thead>
              <tbody>
                @foreach(\Burung\Event_peserta::where(["id_event"=>$data->id_event])->get() as $k => $v)
                <tr>
                  {{csrf_field()}}
                  <td>{{$v->no_gantangan}}</td>
                  <td>{{$v->users->nama}}</td>
                  @foreach($kriteria as $kk => $vv)
                  <td>
                    <div class="form-group">
                      <input type="number" max="100" min="1"  hidden name="id_event_kriteria[{{$v->users->id_users}}][]" value="{{$vv->id_event_kriteria}}">
                      <input type="number" max="100" min="1"  name="nilai[{{$v->users->id_users}}][]" class="form-control" placeholder="Masukan Nilai 1 - 100">
                    </div>
                  </td>
                  @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
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
