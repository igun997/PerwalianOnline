@extends("layout.admin.app")
@section("title","Hasil Akhir")
@section("content")
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-file"></i>
          <h3 class="box-title">Hasil Perhitungan Ranking TOPSIS [{{$data->nama}}]</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <thead>
              <th>Rank</th>
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
@endsection
