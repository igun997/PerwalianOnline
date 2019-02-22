<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class JurusanController extends Controller
{
  public $url ;
  public $jurusan;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "jurusan") {
       return redirect('/masuk')->send();
       // var_dump(($req->session()->all()));
     }else {
       $this->jurusan = $whereIt = \SIAK\UsersModel::find($req->session()->get("id_user"))->first()->id_jurusan;
     }
  }
  public function index(Request $req)
  {
    $id = $req->session()->get("id_user");
    $jurusan = \SIAK\UsersModel::where(["id_user"=>$id])->first()->jurusan->nama_jurusan;
    $css = [];
    $js = [];
    return view("jurusan.pages.home")->with(["title"=>"Dashboard Jurusan - ".$jurusan,"css"=>$css,"js"=>$js]);
  }
  //Profile
  public function profile(Request $req)
  {
    $id = $req->session()->get("id_user");
    $get = \SIAK\UsersModel::where(["id_user"=>$id])->first();
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/jurusan/profile.js")
    ];
    return view("jurusan.pages.profile")->with(["title"=>"Pengaturan Profile","css"=>$css,"js"=>$js,"data"=>$get]);
  }
  public function upprofile(Request $req)
  {
    $post = $req->all();
    $id = $req->session()->get("id_user");
    foreach ($post as $key => &$value) {
      if($value == ""){
        unset($post[$key]);
      }
    }
    if (isset($post["password"])) {
      $post["password"] = md5($post["password"]);
    }
    $up = \SIAK\UsersModel::find($id)->update($post);
    if ($up) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Profile"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Profile"]);
    }
  }
  public function kurikulum(Request $req)
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/jurusan/kurikulum.js")
    ];
    return view("jurusan.pages.kurikulum")->with(["title"=>"Dashboard Jurusan - Kurikulum","css"=>$css,"js"=>$js]);
  }
  public function readkurikulum(Request $req)
  {
    $get = \SIAK\KurikulumModel::all();
    $no = 1;
    $i = 0;
    foreach ($get as $key => &$value) {
      $value->no = $no++;
      $value->aksi = "<button class='btn btn-success aturkur' data-id='{$value->id_kurikulum}' data-index='{$i}' type='button'><li class='fa fa-gears'></li></div> <button class='btn btn-danger hapuskur' data-id='{$value->id_kurikulum}' data-index='{$i}' type='button'><li class='fa fa-trash'></li></div>";
      $value->nama_kurikulum = "Kurikulum ".$value->nama_kurikulum;
      $i++;
    }
    return response()->json(datatablesConvert($get,"no,nama_kurikulum,aksi"));
  }
  public function addkurikulum(Request $req)
  {
    $post = $req->all();
    $post["id_user"] = $req->session()->get("id_user");
    $ins = \SIAK\KurikulumModel::create($post);
    if ($ins->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Tambah Kurikulum"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tambah Kurikulum"]);
    }
  }
  public function delkurikulum(Request $req)
  {
    $id = $req->input("id_kurikulum");
    $del = \SIAK\KurikulumModel::find($id);
    if ($del->delete()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Kurikulum"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Kurikulum"]);
    }
  }
  public function listsemester(Request $req)
  {
    $getActiveTajar = \SIAK\SettingModel::where(["meta_key"=>"tahun_ajar"])->first()->meta_value;
    // return response()->json($getActiveTajar);
    $find = \SIAK\SemesterModel::find($getActiveTajar);
    if ($find->count() > 0) {
      return response()->json(["status"=>1,"data"=>$find->all()]);
    }else {
      return response()->json(["status"=>0]);
    }
  }
  public function aturkurikulum(Request $req,$id,$run)
  {
    $find = \SIAK\MatkulModel::where(["id_kurikulum"=>$id]);
    $kurikulum = \SIAK\KurikulumModel::find($id)->first()->nama_kurikulum;
    $get = $find->get();
    $no = 1;
    $i = 0;
    foreach ($get as $key => &$value) {
      $value->nama_semester = $value->semester->nama_semester;
      $value->no = $no;
      $value->aksi = "<button class='btn btn-warning editmatkul' data-id='{$value->id_matkul}' data-index='{$i}'><li class='fa fa-edit'></li></button> <button class='btn btn-danger hapusmatkul' data-id='{$value->id_matkul}' data-index='{$i}'><li class='fa fa-trash'></li></button>";
      $no++;
      $i++;
    }
    if ($run == "stop") {
      return response()->json(["status"=>1,"kurikulum"=>$kurikulum,"id"=>$id]);
    }else {
      return response()->json(datatablesConvert($get,"no,kode_matkul,nama_matkul,total_sks,pertemuan,nama_semester,jenis,aksi"));
    }
  }
  public function addmatkul(Request $req)
  {
    $create = \SIAK\MatkulModel::create($req->all());
    if ($create->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Tambah Mata Kuliah"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tambah Mata Kuliah"]);
    }
  }
  public function upmatkul(Request $req)
  {
    $post = $req->all();
    unset($post["id_matkul"]);
    $set = \SIAK\MatkulModel::find($req->input("id_matkul"))->update($post);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Mata Kuliah"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Mata Kuliah"]);
    }
  }
  public function detailmatkul(Request $req)
  {
    $set = \SIAK\MatkulModel::find($req->input("id_matkul"));
    if ($set->count() > 0) {
      $get = $set->first();
      $get->nama_semester = $get->semester->nama_semester;
      return response()->json(["status"=>1,"data"=>$get]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function delmatkul(Request $req)
  {
    $set = \SIAK\MatkulModel::find($req->input("id_matkul"));
    if ($set->delete()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Mata Kuliah"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Mata Kuliah"]);
    }
  }
  //MHS
  public function mahasiswa()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/jurusan/mahasiswa.js")
    ];
    return view("jurusan.pages.mahasiswa")->with(["title"=>"Dashboard Jurusan - Mahasiswa","css"=>$css,"js"=>$js]);
  }
  public function carimahasiswa(Request $req)
  {
      $type = $req->input("type");
      if ($type == "== Berdasarkan ==") {
        return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
      $q = $req->input("query");
      if ($type != "username") {
        $get = \SIAK\UsersModel::where(["level"=>"mhs",$type=>$q]);
      }else {
        $get = \SIAK\UsersModel::where(["level"=>"mhs"])
        ->orWhere($type,"LIKE","%{$q}%");
      }
      if ($get->count() > 0) {
        $temp = $get->first();
        $temp->nama_jurusan = $temp->jurusan->nama_jurusan;
        $temp->status_absen = ucfirst($temp->status_absen);
        return response()->json(["status"=>1,"msg"=>"Data Ditemukan","data"=>$temp]);
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
  }
  //Data Dosen
  public function dosen()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/jurusan/dosen.js")
    ];
    return view("jurusan.pages.dosen")->with(["title"=>"Dashboard Jurusan - Dosen","css"=>$css,"js"=>$js]);
  }
  public function readdosen(Request $req)
  {
    $id = $req->session()->get("id_user");
    $whereIt = \SIAK\UsersModel::find($id)->first()->id_jurusan;
    $get = \SIAK\UsersModel::where(["hapus"=>"tidak","level"=>"dosen","id_jurusan"=>$whereIt]);
    $temp = $get->get();
    $no = 1;
    $i = 0;
    foreach ($temp as $key => &$value) {
      $value->no = $no;
      $value->aksi = "<button class='btn btn-warning updatedosen' data-id='{$value->id_user}' data-index='{$i}'><li class='fa fa-edit'></li></button><button class='btn btn-danger deletedosen' data-id='{$value->id_user}' data-index='{$i}'><li class='fa fa-trash'></li></button>";
      $value->kontak = $value->no_hp."/".$value->no_telepon;
      $no++;
      $i++;
    }
    return response()->json(datatablesConvert($temp,"no,username,nama_lengkap,email,kontak,alamat,aksi"));
  }
  public function updosen(Request $req)
  {
    $post = $req->all();
    if ($post["password"] != "") {
      $post["password"] = md5($post["password"]);
    }
    $id = $post["id_user"];
    unset($post["id_user"]);
    $set = \SIAK\UsersModel::find($id)->update($post);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Data Dosen"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Data Dosen"]);
    }
  }
  public function detaildosen(Request $req)
  {
    $get = \SIAK\UsersModel::where(["id_user"=>$req->input("id_user")]);
    if ($get->count() > 0) {
      $el = $get->first();
      return response()->json(["status"=>1,"data"=>$el]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function adddosen(Request $req)
  {
    $post = $req->all();
    $id = $req->session()->get("id_user");
    $whereIt = \SIAK\UsersModel::find($id)->first()->id_jurusan;
    $post["id_jurusan"] = $whereIt;
    $post["level"] = "dosen";
    $post["password"] = md5($post["password"]);
    $set = \SIAK\UsersModel::create($post);
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Tambah Dosen"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tambah Dosen"]);
    }
  }
  public function deldosen(Request $req)
  {
    $set = \SIAK\UsersModel::find($req->input("id_user"));
    $set->hapus = "ya";
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Dosen"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Dosen"]);
    }
  }
  //Data Sekretariat
  public function sekretariat()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/jurusan/sekretariat.js")
    ];
    return view("jurusan.pages.sekretariat")->with(["title"=>"Dashboard Jurusan - Sekretariat","css"=>$css,"js"=>$js]);
  }
  public function readsekretariat(Request $req)
  {
    $id = $req->session()->get("id_user");
    $whereIt = \SIAK\UsersModel::find($id)->first()->id_jurusan;
    $get = \SIAK\UsersModel::where(["hapus"=>"tidak","level"=>"sekretariat","id_jurusan"=>$whereIt]);
    $temp = $get->get();
    $no = 1;
    $i = 0;
    foreach ($temp as $key => &$value) {
      $value->no = $no;
      $value->aksi = "<button class='btn btn-warning updatesekretariat' data-id='{$value->id_user}' data-index='{$i}'><li class='fa fa-edit'></li></button><button class='btn btn-danger deletesekretariat' data-id='{$value->id_user}' data-index='{$i}'><li class='fa fa-trash'></li></button>";
      $value->kontak = $value->no_hp."/".$value->no_telepon;
      $no++;
      $i++;
    }
    return response()->json(datatablesConvert($temp,"no,username,nama_lengkap,email,kontak,alamat,aksi"));
  }
  public function upsekretariat(Request $req)
  {
    $post = $req->all();
    if ($post["password"] == "") {
      $post["password"] = md5($post["password"]);
    }
    $id = $post["id_user"];
    unset($post["id_user"]);
    $set = \SIAK\UsersModel::find($id)->update($post);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Data Sekretariat"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Data Sekretariat"]);
    }
  }
  public function detailsekretariat(Request $req)
  {
    $get = \SIAK\UsersModel::where(["id_user"=>$req->input("id_user")]);
    if ($get->count() > 0) {
      $el = $get->first();
      return response()->json(["status"=>1,"data"=>$el]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function addsekretariat(Request $req)
  {
    $post = $req->all();
    $id = $req->session()->get("id_user");
    $whereIt = \SIAK\UsersModel::find($id)->first()->id_jurusan;
    $post["id_jurusan"] = $whereIt;
    $post["level"] = "sekretariat";
    $post["password"] = md5($post["password"]);
    $set = \SIAK\UsersModel::create($post);
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Tambah Sekretariat"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tambah Sekretariat"]);
    }
  }
  public function delsekretariat(Request $req)
  {
    $set = \SIAK\UsersModel::find($req->input("id_user"));
    $set->hapus = "ya";
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Sekretariat"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Sekretariat"]);
    }
  }
  //Kelas Angkatan
  public function listtajar(Request $req)
  {
    $get = \SIAK\TajarModel::all();
    $select2 = select2Convert($get,["text"=>"nama_tajar","id"=>"id_tajar"]);
    return response()->json($select2);
  }
  public function kelasangkatan()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/jurusan/kelasangkatan.js")
    ];
    return view("jurusan.pages.kelasangkatan")->with(["title"=>"Dashboard Jurusan - Kelas Angkatan","css"=>$css,"js"=>$js]);
  }
  public function readkelasangkatan(Request $req)
  {
    $get = \SIAK\KelasawalModel::where(["id_jurusan"=>$this->jurusan])->get();
    $no = 1;
    $i = 0;
    foreach ($get as $key => &$value) {
      $value->no = $no ;
      $value->thn = $value->tajar->nama_tajar;
      $value->dosenwali = $value->dosen->nama_lengkap;
      $value->aksi = "<button class='btn btn-warning updatekelas' data-id='{$value->id_kelasawal}' data-index='{$i}'><li class='fa fa-edit'></li> </button> <button class='btn btn-danger deletekelas' data-id='{$value->id_kelasawal}' data-index='{$i}'><li class='fa fa-trash'></li></button>";
      $no++;
      $i++;
    }
    return response()->json(datatablesConvert($get,"no,kode_kelas,nama_kelas,thn,dosenwali,aksi"));
  }
  public function listdosen()
  {
    $get = \SIAK\UsersModel::where(["id_jurusan"=>$this->jurusan,"level"=>"dosen"])->get();
    $d = select2Convert($get,["text"=>"nama_lengkap","id"=>"id_user"]);
    return response()->json($d);
  }
  public function addkelasangkatan(Request $req)
  {
    $post = $req->all();
    $post["id_jurusan"] = $this->jurusan;
    $set = \SIAK\KelasawalModel::create($post);
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Data Kelas Berhasil Di Simpan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Kelas Gagal Di Simpan"]);
    }
  }
  public function delkelasangkatan(Request $req)
  {
    $id = $req->input("id_kelasawal");
    $set = \SIAK\KelasawalModel::find($id);
    if ($set->delete()) {
      // code...
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Kelas"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Kelas"]);
    }
  }
  public function detailkelasangkatan(Request $req)
  {
      $id = $req->input("id_kelasawal");
      $get = \SIAK\KelasawalModel::where(["id_kelasawal"=>$id]);
      if ($get->count() > 0) {
        return response()->json(["status"=>1,"data"=>$get->first()]);
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
  }
  public function upkelasangkatan(Request $req)
  {
    $id = $req->input("id_kelasawal");
    $post = $req->all();
    unset($post["id_kelasawal"]);
    $set = \SIAK\KelasawalModel::find($id)->update($post);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Kelas"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Kelas"]);
    }
  }
  //Mapel
  public function listmatkul()
  {
    $get = \SIAK\MatkulModel::all();
    return response()->json(select2Convert($get,["text"=>"nama_matkul","id"=>"id_matkul"]));
  }
  public function kelasmapel(Request $req)
  {
    $css = [
      "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
    ];
    $js = [
      "//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js",
      "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js",
      $this->url->to("/public/assets/main/jurusan/kelasmapel.js")
    ];
    return view("jurusan.pages.kelasmapel")->with(["title"=>"Dashboard Jurusan - Kelas Mata Kuliah (Pilihan)","css"=>$css,"js"=>$js]);
  }
  public function readruangan()
  {
    $get = \SIAK\RuanganModel::all();
    $no = 1;
    $i=0;
    foreach ($get as $key => &$value) {
      $value->no = $no;
        $value->aksi = "<button class='btn btn-warning updateruangan' data-id='{$value->id_ruangan}' data-index='{$i}'><li class='fa fa-edit'></li> </button> <button class='btn btn-danger deleteruangan' data-id='{$value->id_ruangan}' data-index='{$i}'><li class='fa fa-trash'></li></button>";
      $no++;
      $i++;
    }
    return response()->json(datatablesConvert($get,"no,nama_ruangan,kuota_ruangan,aksi"));
  }
  public function readkelasmapel(Request $req)
  {
    $get =  \SIAK\KelasModel::where(["id_jurusan"=>$this->jurusan]);
    $no = 1;
    $i=0;
    $get = $get->get();
    foreach ($get as $key => &$value) {
      $value->no = $no;
      $value->waktu = $value->mulai_kelas." - ".$value->selesai_kelas;
      $value->nomor_ruang = $value->ruangan->nama_ruangan;
      $value->matakuliah = $value->matkul->nama_matkul;
      $value->dosen_pengampu = $value->dosen->nama_lengkap;
      $value->aksi = "<button class='btn btn-warning updatekelas' data-id='{$value->id_kelas}' data-index='{$i}'><li class='fa fa-edit'></li> </button> <button class='btn btn-danger deletekelas' data-id='{$value->id_kelas}' data-index='{$i}'><li class='fa fa-trash'></li></button>";
      $no++;
      $i++;
    }
    return response()->json(datatablesConvert($get,"no,nama_kelas,hari_kelas,waktu,nomor_ruang,matakuliah,dosen_pengampu,aksi"));
  }
  public function addruangan(Request $req)
  {
    $post = $req->all();
    $set = \SIAK\RuanganModel::create($post);
    if ($set->save()) {

      return response()->json(["status"=>1,"msg"=>"Sukses Tambah Ruangan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tambah Ruangan"]);
    }
  }
  public function upruangan(Request $req)
  {
    $post = $req->all();
    unset($post["id_ruangan"]);
    $set = \SIAK\RuanganModel::find($req->input("id_ruangan"))->update($post);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Ruangan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Ruangan"]);
    }
  }
  public function delruangan(Request $req)
  {
    $set = \SIAK\RuanganModel::find($req->input("id_ruangan"));
    if ($set->delete()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Ruangan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Ruangan"]);
    }
  }
  public function listruangan()
  {
    $get = \SIAK\RuanganModel::all();
    return response()->json(select2Convert($get,["text"=>"nama_ruangan","id"=>"id_ruangan"]));
  }
  public function addkelasmapel(Request $req)
  {
    $post = $req->all();
    $post["id_jurusan"] = $this->jurusan;
    $set = \SIAK\KelasModel::create($post);
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Tambah Kelas"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tambah Kelas"]);
    }
  }
  public function upkelasmapel(Request $req)
  {
    $post = $req->all();
    unset($post["id_kelas"]);
    $set = \SIAK\KelasModel::find($req->input("id_kelas"))->update($post);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Kelas"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Kelas"]);
    }
  }
  public function delkelasmapel(Request $req)
  {
    $set = \SIAK\KelasModel::find($req->input("id_kelas"));
    if ($set->delete()) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Kelas"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Kelas"]);
    }
  }
  public function detailruang(Request $req)
  {
    $set = \SIAK\RuanganModel::find($req->input("id_ruangan"));
    if ($set->count() > 0) {
      $get = $set->first();
      return response()->json(["status"=>1,"data"=>$get]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function detailkelasmapel(Request $req)
  {
    $set = \SIAK\KelasModel::find($req->input("id_kelas"));
    if ($set->count() > 0) {
      $get = $set->first();
      return response()->json(["status"=>1,"data"=>$get]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
