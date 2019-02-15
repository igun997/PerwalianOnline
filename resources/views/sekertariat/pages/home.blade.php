@include("sekertariat.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div onclick="var sidebar=$('eis_sidebar'); if (sidebar){ if (sidebar.c('?active')){ sidebar.c('!active');this.c('!active'); } else{ sidebar.c('+active');this.c('+active'); } }" id="eis_sidebar_toggle">&nbsp;</div>
        <div id="eis_tools"></div><q id="eis_title_icon" class="home"></q><span id="eis_title">Dashboard Sekertariat</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Log Aktifitas</div>
            <div style="font-size:14px;text-align:justify;padding:10px;"></div>
        </div>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Pengumuman Perbaikan Sistem</div>
            <div style="font-size:14px;padding:10px;">
                <h3 align="center">Tidak ada pengumuman !</h3>
            </div>
        </div>
    </div>
</div>
@include("sekertariat.theme.foot")
