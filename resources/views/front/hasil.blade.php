@extends("layout.front.app")
@section("title","Hasil Perlombaan")
@section("content")
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Hasil Perlombaan [{{$data->nama}}]</h3>
      </div>
      <div class="panel-body">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <th>Juara</th>
                  <th>Nama</th>
                  <th>Nilai</th>
                </thead>
                <tbody>
                  @foreach($rank as $k => $v)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$v["nama"]}}</td>
                    <td>{{($v["nilai"])}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
