@include("admin.theme.head")
<div id="eis_main">
  <div id="eis_bar">
      <div  id="eis_sidebar_toggle"><center><i class="fa fa-bars fa-2x" style="padding-top:5px;padding-left:5px;padding-right: :5px;padding-bottom:5px;"></i></center></div>
      <div id="eis_tools"></div><q id="eis_title_icon" ></q><span id="eis_title">{{$title}}</span>
  </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Log Aktifitas</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
              <button type="button" id="add" class="btn btn-success">
                <i class="fa fa-plus"></i>
              </button>
              <div class="table-responsive">
                <table class="table" id="main">
                  <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Kontak</th>
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
@include("admin.theme.foot")
