<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class SekretariatController extends Controller
{
  public $url ;
  public $jurusan;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "sekretariat") {
       return redirect('/masuk')->send();
     }else {
        $this->jurusan = $whereIt = \SIAK\UsersModel::find($req->session()->get("id_user"))->first()->id_jurusan;
     }
  }
  public function index()
  {
    $css = [];
    $js = [];
    return view("sekretariat.pages.home")->with(["title"=>"Dashboard Sekretariat","css"=>$css,"js"=>$js]);
  }
  public function isimatkul()
  {
    $css = [];
    $js = [
      $this->url->to("/public/assets/main/sekretariat/isimatkul.js")
    ];
    return view("sekretariat.pages.isimatkul")->with(["title"=>"Dashboard Sekretariat - Pengisian Mata Kuliah","css"=>$css,"js"=>$js]);
  }
  public function readisimatkul()
  {
    $get = \SIAK\KelasawalModel::where(["id_jurusan"=>$this->jurusan])->get();
    foreach ($get as $key => &$value) {
      $value->tahun_ajar = $value->tajar->nama_tajar;
      $value->aksi = "<button class='btn btn-success setkelas' data-id='{$value->id_matkul}'><li class='fa fa-gears'></li></button>";
    }
    return response()->json(datatablesConvert($get,"kode_kelas,nama_kelas,tahun_ajar,aksi"));
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
