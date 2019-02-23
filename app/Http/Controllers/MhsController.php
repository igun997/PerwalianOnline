<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class MhsController extends Controller
{
  public $url ;
  public $id ;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "mhs") {
       return redirect('/masuk')->send();
     }else {
       $this->id = $req->session()->get("id_user");
     }
  }
  public function index(Request $req)
  {
    $css = [];
    $js = [];
    $kelas = \SIAK\KelasPesertaModel::where(["id_user"=>$this->id])->get();
    $build = [];
    foreach ($kelas as $key => $value) {
      $t = \SIAK\KelasPresensiModel::where(["id_kelas"=>$value->id_kelas]);
      $hadir = 0;
      $ijin = 0;
      $sakit = 0;
      $block = 0;
      $alfa = 0;
      foreach ($t->get() as $key => $value) {
        $s = \SIAK\KelasPresensiSignModel::where(["id_presensi"=>$value->id_presensi])->first()->presensi;
        if ($s == "H") {
          $hadir++;
        }elseif ($s == "I") {
          $ijin++;
        }elseif ($s == "S") {
          $sakit++;
        }elseif ($s == "A") {
          $alfa++;
        }elseif ($s == "T") {
          $block++;
        }
      }
      $tr = \SIAK\MatkulModel::where(["id_matkul"=>$value->kelas->id_matkul])->first()->pertemuan;
      $build[] = ["nama_kelas"=>$value->kelas->nama_kelas,"hari"=>$value->kelas->hari_kelas,"waktu"=>$value->kelas->mulai_kelas."-".$value->kelas->selesai_kelas,"hadir"=>$hadir,"ijin"=>$ijin,"sakit"=>$sakit,"block"=>$block,"alfa"=>$alfa,"dari"=>$tr,"total"=>$t->count()];
    }
    return view("mhs.pages.home")->with(["title"=>"Dashboard Mahasiswa","css"=>$css,"js"=>$js,"data"=>$build]);
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
