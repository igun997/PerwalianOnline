<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\UrlGenerator;
class DosenController extends Controller
{
  public $url ;
  public $jurusan;
  public $id;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "dosen") {
       return redirect('/masuk')->send();
     }else {
        $this->jurusan = $whereIt = \SIAK\UsersModel::find(["id_user"=>$req->session()->get("id_user")])->first()->id_jurusan;
        $this->id = $req->session()->get("id_user");
     }
  }
  public function index()
  {
    $css = [];
    $js = [];
    return view("dosen.pages.home")->with(["title"=>"Dashboard Dosen Perwalian","css"=>$css,"js"=>$js]);
  }
  public function presensi()
  {
    $css = [];
    $js = [
        $this->url->to("/public/assets/main/dosen/presensi.js")
    ];
    $get = \SIAK\KelasModel::where(["id_user"=>$this->id])->get();
    return view("dosen.pages.presensi")->with(["title"=>"Dashboard Dosen Perwalian - Presensi","css"=>$css,"js"=>$js,"data"=>$get]);
  }
  public function getabsen(Request $req)
  {
    $get = \SIAK\KelasModel::where(["id_kelas"=>$req->input("id_kelas"),"id_jurusan"=>$this->jurusan]);
    if ($get->count() > 0) {
      $data = $get->first();
      $last_meet = 0;
      $getlast = \SIAK\KelasPresensiModel::where(["id_kelas"=>$req->input("id_kelas")])->orderBy('pertemuan_ke', 'desc');
      if ($getlast->count() > 0) {
        $last_meet = $getlast->first()->pertemuan_ke;
      }
      $compound = ["total_pertemuan"=>$data->matkul->pertemuan,"pertemuan_terakhir"=>$last_meet];
      return response()->json(["status"=>1,"data"=>$compound]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan","debug"=>$get->count()]);
    }
  }
  public function getpeserta(Request $req)
  {
    $get = \SIAK\KelasPesertaModel::where(["id_kelas"=>$req->input("id_kelas")])->get();
    $i = 1;
    foreach ($get as $key => &$value) {
      $value->no = $i++;
      $value->nama_lengkap = $value->mahasiswa->nama_lengkap;
      $value->nim = $value->mahasiswa->username;
      $id = $value->mahasiswa->id_semester;
      $value->semester = \SIAK\SemesterModel::where(["id_semester"=>$id])->first()->nama_semester;
      if ($value->mahasiswa->status_absen == "ya") {
        $value->aksi = "<select class='opsi' data-id='{$value->id_user}' ><option value='H'>H</option><option value='S'>S</option><option value='I'>I</option><option value='A'>A</option></select>";
      }else {
        $value->aksi = "<select class='opsi' data-id='{$value->id_user}'  readonly><option value='T' selected>Blocked</option></select>";
      }
      $tp = \SIAK\KelasModel::where(["id_kelas"=>$req->input("id_kelas")])->first()->matkul->pertemuan;
      // return response()->json($tp);
      $td ="";
      for ($i=1; $i <= $tp; $i++) {
        $cek = \SIAK\KelasPresensiModel::where(["id_kelas"=>$req->input("id_kelas"),"pertemuan_ke"=>$i]);
        if ($cek->count() > 0) {
          $id = $cek->first()->id_presensi;
          $cek2 = \SIAK\KelasPresensiSignModel::where(["id_presensi"=>$id]);
          if ($cek2->count() > 0) {
            $label = "default";
            if ($cek2->first()->presensi == "I") {
              $label = "warning";
            }elseif ($cek2->first()->presensi == "S") {
              $label = "primary";
            }elseif ($cek2->first()->presensi == "A") {
              $label = "danger";
            }elseif ($cek2->first()->presensi == "T") {
              $label = "default";
            }elseif ($cek2->first()->presensi == "H") {
              $label = "success";
            }
            $td .="<td><span class='label label-{$label}'>{$i}</span></td>";
          }else {
            $td .="<td><span class='label label-default'>{$i}</span></td>";
          }
        }else {
          $td .="<td><span class='label label-default'>{$i}</span></td>";
        }
      }
      $value->td = $td;
    }
    if (count($get) > 0) {
      return response()->json(["status"=>1,"data"=>$get]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function checkpoint(Request $req)
  {
    $post = $req->all();
    $post["masuk"] = date("h:m:s");
    $post["keluar"] = "-";
    $post["pertemuan_ke"] = "-";
    $set = \SIAK\KelasPresensiModel::create($post);
    if ($set->save()) {
      return response()->json(["status"=>1,"id"=>$set->id_presensi]);
    }else {
      return response()->json(["status"=>0]);
    }
  }
  public function upcheckpoint(Request $req)
  {
    $post = $req->all();
    $post["keluar"] = date("h:m:s");
    unset($post["id_kelas"]);
    $set = \SIAK\KelasPresensiModel::find($req->input("id_presensi"));
    $set->pertemuan_ke = $post["pertemuan_ke"];
    $set->keluar = $post["keluar"];
    if ($set->save()) {
      return response()->json(["status"=>1,"msg"=>"Checkpoint Diperbarui"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Checkpoint Gagal Diperbarui"]);
    }
  }
  public function stoppoint(Request $req)
  {
    $post = $req->all();
    $data = [];
    $res = explode("#",$post["q"]);
    if (count($res) > 0) {
      unset($res[0]);
    }
    foreach ($res as $key => $value) {
      $temp = explode("|",$value);
      $y = [];
      foreach ($temp as $k => $val) {
        $t = explode("-",$val);
        $y[] = [$t[0]=>$t[1]];
      }
      $data[] = $y;
    }
    $rebu = [];
    foreach ($data as $key => $value) {
      $a = $data[$key][0]["id_presensi"];
      $b = $data[$key][1]["id_user"];
      $c = $data[$key][2]["presensi"];
      $rebu[] = ["id_presensi"=>$a,"id_user"=>$b,"presensi"=>$c];
    }
    $set = \SIAK\KelasPresensiSignModel::insert($rebu);
    if ($set) {
      return response()->json(["status"=>1,"msg"=>"Checkpoint Ditutup"]);
    }else {
      return response()->json(["status"=>0,"msg"=>"Gagal Tutup Checkpoint"]);
    }
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
