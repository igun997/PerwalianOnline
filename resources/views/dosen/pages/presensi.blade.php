@include("dosen.theme.head")
<div id="eis_main">
    <div id="eis_bar">
        <div onclick="var sidebar=$('eis_sidebar'); if (sidebar){ if (sidebar.c('?active')){ sidebar.c('!active');this.c('!active'); } else{ sidebar.c('+active');this.c('+active'); } }" id="eis_sidebar_toggle">&nbsp;</div>
        <div id="eis_tools"></div><q id="eis_title_icon" class="home"></q><span id="eis_title">{{$title}}</span>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div class="td-box td-box-full">
            <div class="td-box-title">Data Kelas</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
              <table>
                <thead>
                  <th>ID</th>
                  <th>Nama Kelas</th>
                  <th>Mata Kuliah</th>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Ruangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  @foreach($data as $key => $value)
                  <tr>
                    <td>{{$value->id_kelas}}</td>
                    <td>{{$value->nama_kelas}}</td>
                    <td>{{$value->matkul->nama_matkul}}</td>
                    <td>{{$value->hari_kelas}}</td>
                    <td>{{$value->mulai_kelas}} - {{$value->selesai_kelas}}</td>
                    <td>{{$value->ruangan->nama_ruangan}}</td>
                    <td><button type="button" data-id="{{$value->id_kelas}}" class="btn btn-success absen">
                      <i class="fa fa-edit"></i>
                    </button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div style="padding:5px;padding-bottom:10px">
        <div id="preload">

        </div>
        <div class="td-box td-box-full" id="box_result" style="display:none">
            <div class="td-box-title">Absensi</div>
            <div style="font-size:14px;text-align:justify;padding:10px;">
              <div class="row">
                <p style="margin-left:20px">Pertemuan Terakhir : <span class='label label-primary' id='pertemuan_terakhir'>0</span></p>
                <p style="margin-left:20px">Pertemuan Ke : </p>
                <div class="col-md-12">
                  <div id="total_pertemuan">

                  </div>
                  <hr>
                  <input type="text" id="topik_bahasan" class="form-control" placeholder="Tulisakan Materi Anda" value="">
                  <button type="button" id="hadir_semua" class="btn btn-success">
                    Hadir Semua
                  </button>
                  <button type="button" id="tidak_hadir" class="btn btn-danger">
                    Tidak Hadir Semua
                  </button>
                  <button type="button" id="checkpoint" class="btn btn-primary">
                    <i class="fa fa-play"></i>
                  </button>
                  <button type="button" id="stoppoint" class="btn btn-danger">
                    <i class="fa fa-stop"></i>
                  </button>
                  <hr>
                  <div class="table-responsive">
                  <table>
                    <thead>
                      <th>No</th>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Semester</th>
                      <th id='kehadiran_kolom' >Kehadiran</th>
                      <th style='max-width:50px'>Aksi</th>
                    </thead>
                    <tbody id="content_table">

                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@include("dosen.theme.foot")
