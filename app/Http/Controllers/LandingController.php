<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class LandingController extends Controller
{
  public $url ;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     // if ($req->session()->get("level") != "admin") {
     //   return redirect('/masuk')->send();
     // }
  }
  public function index()
  {
    $css = [];
    $js = [];
    return view("landing.pages.home")->with(["title"=>"Perwalian Online","css"=>$css,"js"=>$js]);
  }
  public function login()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/landing/login.js")
    ];
    return view("landing.pages.login")->with(["title"=>"Halaman Masuk","css"=>$css,"js"=>$js]);
  }
  //AJAX Process
  public function loginproses(Request $req)
  {
    $all = $req->all();
    $all["password"] = md5($all["password"]);
    $login = \SIAK\UsersModel::where($all)->first();
    if (isset($login->username)) {
      session(["id_user"=>$login->id_user,"level"=>$login->level]);
      return response()->json(["status"=>1,"msg"=>"Username dan Password Benar","level"=>$login->level]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Username dan Password Salah"]);
    }
  }
}
