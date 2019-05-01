<?php

namespace Burung\Http\Controllers;

use Illuminate\Http\Request;

class JuriController extends Controller
{
    public function __construct(Request $req)
    {
      if ($req->session()->get("level") != "juri") {
        return redirect("login")->send();
      }
    }
    public function index()
    {
      return view("juri.home");
    }
    public function penilaian()
    {
      return view("juri.penilaian",["data"=>\Burung\Juri::where(["id_juri"=>session("id_users")]),"no"=>1]);
    }
    public function penilaian_detail($id)
    {
      $get = \Burung\Event::where(["id_event"=>$id])->first();
      $crit = \Burung\Event_kriteria::where(["id_event"=>$id])->get();
      $counter = count($crit);
      $crits = [];
      foreach ($crit as $key => $value) {
        $crits[] = $value->id_event_kriteria;
      }
      // return response()->json(session());
      $cek = \Burung\Event_penilaian::whereIn("id_event_kriteria",$crits)->where(["id_juri"=>session()->get("id_users")]);
      if ($cek->count() < 1) {
        return view("juri.penilaiandetail",["data"=>$get,"kriteria"=>$crit]);
      }else {
        session(["msg"=>"Anda Sudah Melakukan Penilaian Sebelummnya"]);
        return redirect("juri/penilaian");
      }
    }
    public function penilaian_detail_aksi(Request $req,$id)
    {
      $data = $req->all();
      unset($data["_token"]);
      $newdata = [];
      foreach ($data["id_event_kriteria"] as $key => $value) {
        foreach ($value as $k => $v) {
          $newdata[] = ["id_event_kriteria"=>$v,"id_peserta"=>$key,"nilai"=>$data["nilai"][$key][$k],"id_juri"=>session("id_users")];
        }
      }
      $ins = \Burung\Event_penilaian::insert($newdata);
      if ($ins) {
        session(["msg"=>"Sukses Melakukan Peniaian"]);
      }else {
        session(["msg"=>"Gagal Melakukan Peniaian"]);
      }
      return back();
    }
}
