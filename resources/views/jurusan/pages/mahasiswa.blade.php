@include("jurusan.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div  id="eis_sidebar_toggle"><center><i class="fa fa-bars fa-2x" style="padding-top:5px;padding-left:5px;padding-right: :5px;padding-bottom:5px;"></i></center></div>
        <div id="eis_tools"></div><q id="eis_title_icon" ></q><span id="eis_title">{{$title}}</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
      <div class="td-box td-box-full">
        <div class="td-box-title">Cari Mahasiswa</div>
        <div style="font-size:14px;padding:10px;">
            <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <form class="form-horizontal" action="" method="post" id="cari" onsubmit="return false">
                <div class="col-md-12" >
                  <div class="form-group" >
                    <select class="form-control" name="type">
                      <option>== Berdasarkan ==</option>
                      <option value="username">NIM / Username</option>
                      <option value="nama_lengkap">Nama</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" >
                  <div class="form-group" >
                    <input type="text" required name="query" class="form-control">
                  </div>
                </div>
                <div class="col-md-12" >
                  <div class="form-group" >
                    <center>
                    <button type="submit"  class="btn-block btn btn-primary">
                      <i class="fa fa-search"></i>
                    </button>
                    </center>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <hr>
        <div style="font-size:14px;padding:10px;" >
          <div id="preload">
          </div>
          <div id="content">
          </div>
        </div>
      </div>
    </div>

</div>
@include("jurusan.theme.foot")
