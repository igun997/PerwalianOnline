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
      $this->url->to("/assets/main/admin/jurusan.js")
    ];
    return view("admin.pages.home")->with(["title"=>"Dashboard Administrator Perwalian","css"=>$css,"js"=>$js]);
  }
  public function readjurusan(Request $req)
  {
    $get = \SIAK\UsersModel::where(["level"=>"jurusan","hapus"=>"tidak"])->get();
    $get = datatablesConvert($get,"id_user,nama_lengkap,username,jk,alamat,email,no_hp,created_at,updated_at");
    return response()->json($get);
  }
  public function addjurusan(Request $req)
  {
    $postData = $req->all();
    $postData["level"] = "jurusan";
    $postData["created_at"] = date("Y-m-d H:i:s");
    $postData["updated_at"] = date("Y-m-d H:i:s");
    $ins = \SIAK\UsersModel::insert($postData);
    if ($ins) {
      return response()->json(["status"=>1,"msg"=>"Sukses Menambahkan Jurusan"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Menambahkan Jurusan"]);
    }
  }
  public function updatejurusan(Request $req)
  {


  }
  public function deljurusan(Request $req)
  {



  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    return redirect('/masuk')->send();
  }
}
