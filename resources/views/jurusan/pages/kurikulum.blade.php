@include("jurusan.theme.head")
<div id="eis_main">
  <div id="eis_bar">
      <div  id="eis_sidebar_toggle"><center><i class="fa fa-bars fa-2x" style="padding-top:5px;padding-left:5px;padding-right: :5px;padding-bottom:5px;"></i></center></div>
      <div id="eis_tools"></div><q id="eis_title_icon" ></q><span id="eis_title">{{$title}}</span>
  </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full col-md-offset-2" style="width:70%">
          <div class="td-box-title">Data Kurikulum</div>
          <div style="font-size:14px;text-align:justify;padding:10px;">
            <div class="form-group">
              <select class="form-control" id="addkurikulum">
                @for($i = 2000; $i <= date("Y");$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
            </div>
            <div class="form-group">
              <button type="button" id="savekurikulum" class="btn-block btn btn-primary">
                Buat Kurikulum
              </button>
            </div>
            <div class="table-responsive">
              <table class="table" id="main">
              <thead>
                <th>No</th>
                <th>Kurikulum</th>
                <th></th>
              </thead>
              <tbody>

              </tbody>
            </table>
            </div>
          </div>
        </div>
    </div>
    <div style="font-size:14px;text-align:justify;padding:10px;">
      <div id="preload">
      </div>
      <div class="td-box td-box-full" id="content_result" style="display:none">
        <div class="td-box-title title_box"></div>
        <div style="font-size:14px;text-align:justify;padding:10px;">
          <button type="button" id="addmatkul" class="btn btn-primary">
            <i class="fa fa-plus"></i>
          </button>
          <div class="table-responsive">
            <table class="table" id="main_result">
            <thead>
              <th>No</th>
              <th>Kode Matkul</th>
              <th>Nama Matkul</th>
              <th>SKS</th>
              <th>Pertemuan</th>
              <th>Semester</th>
              <th>Jenis</th>
              <th></th>
            </thead>
            <tbody>

            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
</div>
@include("jurusan.theme.foot")
