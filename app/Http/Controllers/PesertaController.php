<?php

namespace Burung\Http\Controllers;
use PDF;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function __construct(Request $req)
    {
      if ($req->session()->get("level") != "peserta") {
        return redirect("login")->send();
      }
    }
    public function index()
    {
      $data = \Burung\Users::where(["id_users"=>session("id_users")])->first();
      $include = \Burung\Event_peserta::where(["id_users"=>session("id_users")]);
      return view("peserta.home",["data"=>$data,"include"=>$include]);
    }
    public function index_aksi(Request $req)
    {
      $this->validate($req, [
       'foto_burung'=>'mimes:jpg,png,jpeg'
      ]);
      if ($req->hasFile('foto_burung')) {
            $image = $req->file('foto_burung');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $save = $image->move($destinationPath, $name);
            if ($save) {
              $update = \Burung\Event_peserta::find($req->input("id_event_peserta"));
              $update->foto_burung = "public/upload/".$name;
              if ($update->save()) {
                session(["msg"=>"Persyaratan Tersimpan"]);
              }else {
                session(["msg"=>"Persyaratan Gagal Tersimpan"]);
              }
            }else {
              session(["msg"=>"Format Yang Dibolehkan = jpg,png,jpeg"]);
            }
        }else {
          session(["msg"=>"Tidak Ada Gambar Yang Dipilih"]);
        }
      return back();
    }
    public function event()
    {
      return view("peserta.event");
    }
    public function event_detail($id)
    {
      $get = \Burung\Event::where(["id_event"=>$id]);
      if ($get->count() > 0) {
        return view("peserta.event_detail".["data"=>$get->first()]);
      }else {
        return back();
      }
    }
    public function print($id='')
    {
      $get =  \Burung\Event_peserta::where(["id_event_peserta"=>$id]);
      if ($get->count() < 1) {
        return back();
      }else {
        $data = [
      		'data' => $get->first()
      	];
      	$pdf = PDF::loadView('letter.cetak_kartu', $data);
      	return $pdf->stream('kartu.pdf');
      }
    }
    public function eventregister($id)
    {
      $counter = \Burung\Event_peserta::where(["id_event"=>$id])->count();
      $counter_spell = \Burung\Event_peserta::where(["id_event"=>$id,"id_users"=>session("id_users")])->count();
      if ($counter_spell > 0) {
        session(["msg"=>"Anda Sudah Terdaftar Sebelumnya"]);
      }else {
        $data = ["id_event"=>$id,"id_users"=>session("id_users"),"no_gantangan"=>($counter+1)];
        $create = \Burung\Event_peserta::create($data);
        if ($create) {
          session(["msg"=>"Anda Telah Mendaftar Silahkan Lengkapi Persyaratan Di Menu Beranda"]);
        }else {
          session(["msg"=>"Anda Gagal Mendaftar"]);
        }
      }
      return back();
    }
}
