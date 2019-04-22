@extends("layout.admin.app")
@section("title","Dashboard Juri")
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
          <h3 class="box-title">Dashboard Juri</h3>
        </div>
        <div class="box-body">

        </div>
      </div>
    </div>
</div>
@endsection
