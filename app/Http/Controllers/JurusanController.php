<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class JurusanController extends Controller
{
  public $url ;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "jurusan") {
       return redirect('/masuk')->send();
       // var_dump(($req->session()->all()));
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
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
