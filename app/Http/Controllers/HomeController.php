<?php

namespace Burung\Http\Controllers;

use Illuminate\Http\Request;
use Helpers\Topsis;
class HomeController extends Controller
{
    public function index()
    {
      return view("front.home");
    }
    public function login()
    {
      return view("front.login");
    }
    public function login_aksi(Request $req)
    {
      $data = $req->all();
      unset($data["_token"]);
      $find = \Burung\Users::where($data);
      if ($find->count() > 0) {
        $row = $find->first();
        session(["id_users"=>$row->id_users,"nama"=>$row->nama,"level"=>$row->level]);
        return redirect($row->level);
      }else {
        session(["msg"=>"Username & Password Salah"]);
      }
      return back();
    }
    public function hasil($id)
    {
      $first = \Burung\Event::where(["id_event"=>$id])->first();
      $topsis = new Topsis();
      $getcrit = \Burung\Event_kriteria::where(["id_event"=>$id])->select("id_event_kriteria","nama","bobot")->get();
      $getalt = \Burung\Event_peserta::where(["id_event"=>$id])->get();
      $role = \Burung\Juri::where(["id_event"=>$id])->get();
      $alt = [];
      $data = [];
      foreach ($getalt as $key => $value) {
        $alt[] = $value->users->nama;
      }
      $newcr = [];
      foreach ($getalt as $key => $value) {
        $calc = [];
        $nilai = \Burung\Event_penilaian::where(["id_peserta"=>$value->id_users])->get();
        foreach ($nilai as $k => $v) {
          $calc[] = ["nama"=>$value->users->nama,"id_peserta"=>$v->id_peserta,"id_event_kriteria"=>$v->id_event_kriteria,"nilai"=>$v->nilai,"id_juri"=>$v->id_juri];
        }
        $newcr[] = $calc;
      }
      $new = [];

      foreach ($newcr as $key => &$value) {
          usort($value,"sortByOrder");
      }
      $count = count($role);
      $i = 0;
      $const = [];
      foreach ($newcr as $keyx => $valuex) {
        $data = [];
        $n = 0;
        foreach ($valuex as $k => $v) {
          ++$i;
          $n = $n + $v["nilai"];
          if ($i == $count) {
            $data[] = $n/$count;
            $n = 0;
            $i = 0;
          }

        }
        $const[] = $data;
      }
      $const = array_map(null, ...$const);
      $topsis->setKriteria($getcrit);
      $topsis->setAlternatif($alt);
      $topsis->setData($const);
      $run = $topsis->run();
      usort($run,"sortbynilai");
      // return response()->json($run);
      return view("front.hasil",["data"=>$first,"rank"=>$run,"no"=>1]);
    }
    public function register()
    {
      return view("front.register");
    }
    public function register_aksi(Request $req)
    {
      $data = $req->all();
      $data["status"] = "nonaktif";
      $data["level"] = "peserta";
      unset($data["_token"]);
      $create = \Burung\Users::create($data);
      if ($create) {
        session(["msg"=>"Anda telah Mendaftar Silahkan Login"]);
      }else {
        session(["msg"=>"Pendaftaran Gagal"]);
      }
      return back();
    }
    public function logout()
    {
      session()->flush();
      return redirect("login");
    }
}
