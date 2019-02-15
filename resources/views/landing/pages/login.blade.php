@include("landing.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div onclick="var sidebar=$('eis_sidebar'); if (sidebar){ if (sidebar.c('?active')){ sidebar.c('!active');this.c('!active'); } else{ sidebar.c('+active');this.c('+active'); } }" id="eis_sidebar_toggle">&nbsp;</div>
        <div id="eis_tools"></div><q id="eis_title_icon" class="home"></q><span id="eis_title">Perwalian Online</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Silahkan Masukan Username dan Password anda </div>
            <div style="font-size:14px;padding:10px;">
                <form action="" method="post" id="login" onsubmit="return false">
                    <label for="fname">Username</label>
                    <input type="text" id="fname" name="username" placeholder="Username">
                    <label for="lname">Password</label>
                    <input type="text" id="lname" name="password" placeholder="Password">
                    <button type="submit" class="btn-login">Masuk</button>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@include("landing.theme.foot")
