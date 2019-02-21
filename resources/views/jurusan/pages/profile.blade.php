@include("jurusan.theme.head")
<div id="eis_main">
  <div id="eis_bar">
      <div  id="eis_sidebar_toggle"><center><i class="fa fa-bars fa-2x" style="padding-top:5px;padding-left:5px;padding-right: :5px;padding-bottom:5px;"></i></center></div>
      <div id="eis_tools"></div><q id="eis_title_icon" ></q><span id="eis_title">{{$title}}</span>
  </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Profile {{$data->nama_lengkap}}</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <form class="form-horizontal" action="" id="save" onsubmit="return false" method="post">
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama_lengkap" value="{{$data->nama_lengkap}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jk">
                        @if(strtoupper($data->jk) == "LAKI-LAKI")
                        <option value="laki-laki" selected>Laki - Laki</option>
                        <option value="perempuan" >Perempuan</option>
                        @else
                        <option value="perempuan" selected>Perempuan</option>
                        <option value="laki-laki" >Laki - Laki</option>
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" disabled class="form-control" name="" value="{{$data->username}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="text"  class="form-control" name="" value="" placeholder="Isi Untuk Mengubah">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text"  class="form-control" name="email" value="{{$data->email}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea name="alamat" class="form-control" rows="8" cols="80">{{$data->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">
                        Simpan
                      </button>
                    </div>
                  </form>
                </div>
              </div>

            </div>
        </div>
    </div>
</div>
@include("jurusan.theme.foot")
