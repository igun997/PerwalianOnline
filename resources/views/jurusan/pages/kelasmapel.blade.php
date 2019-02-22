@include("jurusan.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div  id="eis_sidebar_toggle"><center><i class="fa fa-bars fa-2x" style="padding-top:5px;padding-left:5px;padding-right: :5px;padding-bottom:5px;"></i></center></div>
        <div id="eis_tools"></div><q id="eis_title_icon" ></q><span id="eis_title">{{$title}}</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
      <div class="td-box td-box-full">
        <div class="td-box-title">Data Ruangan</div>
        <div style="font-size:14px;padding:10px;">
          <button type="button" id="addruangan" class="btn btn-success">
            <i class="fa fa-plus"></i>
          </button>
          <div style="padding:5px"></div>
          <div class="table-responsive">
            <table class="table" id="mainruang">
              <thead>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas Ruangan</th>
                <th>Aksi</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div style="padding:5px;padding-bottom:10px">
      <div class="td-box td-box-full">
        <div class="td-box-title">Data Kelas Mata Kuliah</div>
        <div style="font-size:14px;padding:10px;">
          <button type="button" id="addkelasmapel" class="btn btn-success">
            <i class="fa fa-plus"></i>
          </button>
          <div style="padding:5px"></div>
          <div class="table-responsive">
            <table class="table" id="mainkelas">
              <thead>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Ruangan</th>
                <th>Mata Kuliah</th>
                <th>Dosen Pengampu</th>
                <th>Aksi</th>
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
