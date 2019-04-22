@extends("layout.admin.app")
@section("title","Daftar Event")
@section("content")
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    @if(\Session::has("msg"))
    <div class="alert alert-info">
      <p>{{session("msg")}}{{session()->forget("msg")}}</p>
    </div>
    @endif
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-dashboard"></i>
          <h3 class="box-title">Daftar Event</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table datatables">
              <thead>
                <th>#</th>
                <th>Nama Event</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                @foreach($data->get() as $k => $v)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$v->event->nama}}</td>
                  <td>{{$v->event->tanggal}}</td>
                  <td>
                    <a href="{{url("juri/penilaian/".$v->id_event)}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
