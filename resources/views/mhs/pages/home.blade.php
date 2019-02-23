@include("mhs.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div onclick="var sidebar=$('eis_sidebar'); if (sidebar){ if (sidebar.c('?active')){ sidebar.c('!active');this.c('!active'); } else{ sidebar.c('+active');this.c('+active'); } }" id="eis_sidebar_toggle">&nbsp;</div>
        <div id="eis_tools"></div><q id="eis_title_icon" class="home"></q><span id="eis_title">{{$title}}</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Data Presensi</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
                <table class="table">
                  <thead>
                    <th>Nama Kelas</th>
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Hadir</th>
                    <th>Ijin</th>
                    <th>Sakit</th>
                    <th>Blok</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    @foreach($data as $k => $v)
                    <tr>
                      <td>{{$v["nama_kelas"]}}</td>
                      <td>{{$v["hari"]}}</td>
                      <td>{{$v["waktu"]}}</td>
                      <td>{{$v["hadir"]}}</td>
                      <td>{{$v["ijin"]}}</td>
                      <td>{{$v["sakit"]}}</td>
                      <td>{{$v["block"]}}</td>
                      <td>{{$v["total"]}}/{{$v["dari"]}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include("mhs.theme.foot")
