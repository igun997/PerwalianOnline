<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class BaakController extends Controller
{
  public $url ;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "baak") {
       return redirect('/masuk')->send();
     }
  }
  public function index()
  {

  }
  public function readbaak(Request $req)
  {
    $get = \SIAK\UsersModel::where(["level"=>"baak","hapus"=>"tidak"])->get();
    $temp = $get;
    $n = 1;
    $i = 0;
    foreach ($temp as $key => &$value) {
      $value->no = $n;
      $value->kontak = $value->no_hp."/".$value->no_telepon;
      $value->aksi = "<button class=' btn btn-warning updatebaak' data-index='".$i."' data-id='".$value->id_user."'><li class='fa fa-edit'></li></button><button class=' btn btn-danger hapusbaak' data-index='".$i."' data-id='".$value->id_user."'><li class='fa fa-trash'></li></button>";
      $n++;
      $i++;
    }
    $get = datatablesConvert($temp,"no,nama_lengkap,username,email,kontak,aksi");
    return response()->json($get);
  }
  public function addbaak(Request $req)
  {
    $postData = $req->all();
    $postData["password"] = md5($postData["password"]);
    $postData["level"] = "baak";
    $postData["created_at"] = date("Y-m-d H:i:s");
    $postData["updated_at"] = date("Y-m-d H:i:s");
    $ins = \SIAK\UsersModel::create($postData);
    if ($ins) {
      return response()->json(["status"=>1,"msg"=>"Sukses Menambahkan Administrator BAAK"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Menambahkan Administrator BAAK"]);
    }
  }
  public function detailbaak(Request $req)
  {
    $get = \SIAK\UsersModel::where(["id_user"=>$req->input("id_user"),"hapus"=>"tidak","level"=>"baak"]);
    if ($get->count() > 0) {
      $first = $get->first();
      return response()->json(["status"=>1,"data"=>$first]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function upbaak(Request $req)
  {
    $input = $req->all();
    $up = \SIAK\UsersModel::find($req->input("id_user"));
    $up->nama_lengkap = $input["nama_lengkap"];
    $up->jk = $input["jk"];
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
  public function delbaak(Request $req)
  {
    $del = \SIAK\UsersModel::find($req->input("id_user"));
    $del->hapus = "ya";
    $s = $del->save();
    if ($s) {
      return response()->json(["status"=>1,"msg"=>"Sukses Menghapus Admin BAAK"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Menghapus Admin BAAK"]);
    }

  }

  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
