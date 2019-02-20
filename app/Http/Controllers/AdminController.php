<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class AdminController extends Controller
{
  public $url ;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "admin") {
       return redirect('/masuk')->send();
     }
  }
  public function index()
  {
    $css = [];
    $js = [];
    return view("admin.pages.home")->with(["title"=>"Dashboard Administrator Perwalian","css"=>$css,"js"=>$js]);
  }
  public function jurusan()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/admin/jurusan.js")
    ];
    return view("admin.pages.jurusan")->with(["title"=>"Dashboard Administrator Perwalian - Jurusan","css"=>$css,"js"=>$js]);
  }
  public function addjurusan(Request $req)
  {
    $postData = $req->all();
    $postData["status_jurusan"] = "aktif";
    $ins = \SIAK\JurusanModel::create($postData);
    if ($ins) {
      return response()->json(["status"=>1,"msg"=>"Sukses Menambahkan Jurusan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Menambahkan Jurusan"]);
    }
    // return response()->json($postData);
  }
  public function readjurusan(Request $req)
  {
    $get = \SIAK\JurusanModel::where(["status_jurusan"=>"aktif"])->get();
    $temp = $get;
    $n = 1;
    $i = 0;
    foreach ($temp as $key => &$value) {
      $value->no = $n;
      $value->aksi = "<button class='btn btn-warning updatejurusan' data-index='".$i."' data-id='".$value->id_jurusan."'><li class='fa fa-edit'></li></button> <button class='btn btn-danger hapusjurusan' data-index='".$i."' data-id='".$value->id_jurusan."'><li class='fa fa-trash'></li></button>";
      $n++;
      $i++;
    }
    $dt = datatablesConvert($temp,"no,nama_jurusan,aksi");
    return response()->json($dt);
  }
  public function upjurusan(Request $req)
  {
    $update = \SIAK\JurusanModel::find($req->input("id_jurusan"));
    $update->nama_jurusan = $req->input("nama_jurusan");
    $save = $update->save();
    if ($save) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Jurusan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Jurusan"]);
    }
  }
  public function deljurusan(Request $req)
  {
    $update = \SIAK\JurusanModel::find($req->input("id_jurusan"));
    $update->status_jurusan = "tidak";
    $save = $update->save();
    if ($save) {
      return response()->json(["status"=>1,"msg"=>"Sukses Hapus Jurusan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Hapus Jurusan"]);
    }
  }
  public function readadminjurusan(Request $req)
  {
    $get = \SIAK\UsersModel::where(["level"=>"jurusan","hapus"=>"tidak"])->get();
    $temp = $get;
    $n = 1;
    $i = 0;
    foreach ($temp as $key => &$value) {
      $value->no = $n;
      $value->kontak = $value->no_hp."/".$value->no_telepon;
      $value->status_jurusan = ucfirst($value->status_jurusan);
      $value->nama_jurusan = $value->jurusan["nama_jurusan"];
      $value->aksi = "<button class=' btn btn-warning updateadminjurusan' data-index='".$i."' data-id='".$value->id_user."'><li class='fa fa-edit'></li></button><button class=' btn btn-danger hapusadminjurusan' data-index='".$i."' data-id='".$value->id_user."'><li class='fa fa-trash'></li></button><button class=' btn btn-success detailadminjurusan' data-index='".$i."' data-id='".$value->id_user."'><li class='fa fa-search'></li></button>";
      $n++;
      $i++;
    }
    $get = datatablesConvert($temp,"no,nama_lengkap,username,nama_jurusan,email,kontak,aksi");
    return response()->json($get);
  }
  public function listjurusan()
  {
    return response()->json(select2Convert(\SIAK\JurusanModel::all(),["text"=>"nama_jurusan","id"=>"id_jurusan"]));
  }
  public function addadminjurusan(Request $req)
  {
    $postData = $req->all();
    $postData["password"] = md5($postData["password"]);
    $postData["level"] = "jurusan";
    $postData["created_at"] = date("Y-m-d H:i:s");
    $postData["updated_at"] = date("Y-m-d H:i:s");
    $ins = \SIAK\UsersModel::create($postData);
    if ($ins) {
      return response()->json(["status"=>1,"msg"=>"Sukses Menambahkan Administrator Jurusan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Menambahkan Administrator Jurusan"]);
    }
  }
  public function detailadminjurusan(Request $req)
  {
    $get = \SIAK\UsersModel::where(["id_user"=>$req->input("id_user"),"hapus"=>"tidak","level"=>"jurusan"]);
    if ($get->count() > 0) {
      $first = $get->first();
      $first->nama_jurusan = $first->jurusan->nama_jurusan;
      return response()->json(["status"=>1,"data"=>$first]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function upadminjurusan(Request $req)
  {
    $input = $req->all();
    $up = \SIAK\UsersModel::find($req->input("id_user"));
    $up->nama_lengkap = $input["nama_lengkap"];
    $up->jk = $input["jk"];
    $up->id_jurusan = $input["id_jurusan"];
    $up->no_telepon = $input["no_telepon"];
    $up->no_hp = $input["no_hp"];
    $up->alamat = $input["alamat"];
    $up->email = $input["email"];
    if ($input["password"] != "") {
      $up->password = md5($input["password"]);
    }
    $p = $up->save();
    if ($p) {
      return response()->json(["status"=>1,"msg"=>"Update Data Administrator Berhasil"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Update Data Administrator Gagal"]);
    }

  }
  public function deladminjurusan(Request $req)
  {
    $del = \SIAK\UsersModel::find($req->input("id_user"));
    $del->hapus = "ya";
    $s = $del->save();
    if ($s) {
      return response()->json(["status"=>1,"msg"=>"Sukses Menghapus Admin Jurusan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Menghapus Admin Jurusan"]);
    }

  }
  public function mahasiswa()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/admin/mahasiswa.js")
    ];
    return view("admin.pages.mahasiswa")->with(["title"=>"Dashboard Administrator Perwalian - Mahasiswa","css"=>$css,"js"=>$js]);
  }
  public function carimahasiswa(Request $req)
  {
      $type = $req->input("type");
      $q = $req->input("query");
      $get = \SIAK\UsersModel::where(["level"=>"mhs"])
      ->orWhere($type, 'LIKE', "%{$q}%");
      if ($get->count() > 0) {
        $temp = $get->first();
        $temp->nama_jurusan = $temp->jurusan->nama_jurusan;
        $temp->status_absen = ucfirst($temp->status_absen);
        return response()->json(["status"=>1,"msg"=>"Data Ditemukan","data"=>$temp]);
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
  }
  public function resetpassword(Request $req)
  {
    $id = $req->input("id_user");
    $pw = alpha();
    $reset = \SIAK\UsersModel::find($id);
    $reset->password = md5($pw);
    $set = $reset->save();
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Sukses Reset Password","newpass"=>$pw]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Reset Password"]);
    }
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    return redirect('/masuk')->send();
  }
}
