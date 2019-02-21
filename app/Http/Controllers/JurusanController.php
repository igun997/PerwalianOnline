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
    $up = \SIAK\UsersModel::find($id)->update($post);
    if ($up) {
      return response()->json(["status"=>1,"msg"=>"Sukses Update Profile"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Update Profile"]);
    }
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
