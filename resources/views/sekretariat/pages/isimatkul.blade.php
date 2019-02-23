@include("sekretariat.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div onclick="var sidebar=$('eis_sidebar'); if (sidebar){ if (sidebar.c('?active')){ sidebar.c('!active');this.c('!active'); } else{ sidebar.c('+active');this.c('+active'); } }" id="eis_sidebar_toggle">&nbsp;</div>
        <div id="eis_tools"></div><q id="eis_title_icon" class="home"></q><span id="eis_title">{{$title}}</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Daftar Kelas Angkatan</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
              <div class="table-responsive">
                <table class="table" id="main">
                  <thead>
                    <th>Kode Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Tahun Ajar</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    <div style="padding:5px;padding-bottom:10px"  >
        <div class="td-box td-box-full" id="result_box" >
            <div class="td-box-title">Pengisian Data Mata Kuliah</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <form class="form-horizontal" action="" method="post" onsubmit="return false">
                    <div class="form-group">
                      <label for="">Nama Mata Kuliah</label>
                      <select class="form-control" name="">

                      </select>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>

</div>
@include("sekretariat.theme.foot")
