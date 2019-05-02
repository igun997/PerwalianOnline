<?php

namespace Burung\Http\Controllers;
use Helpers\Topsis;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(Request $req)
    {
      if ($req->session()->get("level") != "admin") {
        return redirect("login")->send();
      }
    }
    public function index()
    {
      $unverif = \Burung\Users::where(["status"=>"nonaktif","level"=>"peserta"])->get();
      return view("admin.home",["data"=>$unverif,"no"=>1]);
    }
    public function verifikasi($id)
    {
      $get = \Burung\Users::where(["id_users"=>$id,"level"=>"peserta","status"=>"nonaktif"]);
      if ($get->count() > 0) {
        $change = \Burung\Users::find($id);
        $change->status = "aktif";
        $change->save();
      }
      return back();
    }
    public function juri()
    {
      $get = \Burung\Users::where(["level"=>"juri"])->get();
      return view("admin.juri",["data"=>$get,"no"=>1]);
    }
    public function juriadd()
    {
      return view("admin.juri_form");
    }
    public function juriadd_aksi(Request $req)
    {
      $create = \Burung\Users::create($req->all());
      if ($create) {
        session(["msg"=>"Tambah Juri Sukses"]);
      }else {
        session(["msg"=>"Tambah Juri Gagal"]);
      }
      return back();
    }
    public function juriedit($id)
    {
      $data = \Burung\Users::where(["id_users"=>$id]);
      return view("admin.juri_form",["data"=>$data->first()]);
    }
    public function juriedit_aksi(Request $req,$id)
    {
      $data = $req->all();
      unset($data["_token"]);
      $create = \Burung\Users::where(["id_users"=>$id])->update($data);
      if ($create) {
        session(["msg"=>"Update Juri Sukses"]);
      }else {
        session(["msg"=>"Update Juri Gagal"]);
      }
      return back();
    }
    public function jurihapus($id)
    {
      $delete = \Burung\Users::find($id)->delete();
      return back();
    }
    public function kelas()
    {
      $get = \Burung\Kelas::all();
      return view("admin.kelas",["data"=>$get,"no"=>1]);
    }
    public function kelasadd()
    {
      return view("admin.kelas_form");
    }
    public function kelasedit($id)
    {
      $get = \Burung\Kelas::where(["id_kelas"=>$id]);
      return view("admin.kelas_form",["data"=>$get->first()]);
    }
    public function kelasedit_aksi(Request $req,$id)
    {
      $data = $req->all();
      unset($data["_token"]);
      $update = \Burung\Kelas::where(["id_kelas"=>$id])->update($data);
      if ($update) {
        session(["msg"=>"Update Kelas Sukses"]);
      }else {
        session(["msg"=>"Update Kelas Gagal"]);
      }
      return back();
    }
    public function kelasadd_aksi(Request $req)
    {
      $create = \Burung\Kelas::create($req->all());
      if ($create) {
        session(["msg"=>"Tambah Kelas Sukses"]);
      }else {
        session(["msg"=>"Tambah Kelas Gagal"]);
      }
      return back();
    }
    public function kelashapus($id)
    {
      $del = \Burung\Kelas::find($id)->delete();
      return back();
    }
    public function event()
    {
      return view("admin.event",["data"=>\Burung\Event::all(),"no"=>1]);
    }
    public function eventadd()
    {
      return view("admin.event_form");
    }
    public function eventadd_aksi(Request $req)
    {
      $this->validate($req, [
       'img_header'=>'mimes:jpg,png,jpeg'
      ]);
      $data = $req->all();
      unset($data["_token"]);
      if ($req->hasFile('img_header')) {
            $image = $req->file('img_header');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $save = $image->move($destinationPath, $name);
            if ($save) {
              $data["img_header"] = "public/upload/".$name;
              $create = \Burung\Event::create($data);
              if ($create) {
                session(["msg"=>"Data Tersimpan"]);
              }else {
                session(["msg"=>"Data Gagal Tersimpan"]);
              }
            }else {
              session(["msg"=>"Format Yang Dibolehkan = jpg,png,jpeg"]);
            }
        }else {
          session(["msg"=>"Tidak Ada Gambar Yang Dipilih"]);
        }
        return back();
    }
    public function eventedit($id)
    {
      $get = \Burung\Event::where(["id_event"=>$id]);
      if ($get->count() > 0) {
        return view("admin.event_form",["data"=>$get->first()]);
      }else {
        return back();
      }
    }
    public function eventedit_aksi(Request $req,$id)
    {
      $this->validate($req, [
       'img_header'=>'mimes:jpg,png,jpeg'
      ]);
      $data = $req->all();
      unset($data["_token"]);
      if ($req->hasFile('img_header')) {
            $image = $req->file('img_header');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $save = $image->move($destinationPath, $name);
            if ($save) {
              $data["img_header"] = "public/upload/".$name;
              $update = \Burung\Event::find($id);
              $update->nama = $data["nama"];
              $update->tanggal = $data["tanggal"];
              $update->deskripsi = $data["deskripsi"];
              $update->id_kelas = $data["id_kelas"];
              $update->img_header = $data["img_header"];
              if ($update->save()) {
                session(["msg"=>"Data Tersimpan"]);
              }else {
                session(["msg"=>"Data Gagal Tersimpan"]);
              }
            }else {
              session(["msg"=>"Format Yang Dibolehkan = jpg,png,jpeg"]);
            }
        }else {
          $update = \Burung\Event::find($id);
          $update->nama = $data["nama"];
          $update->tanggal = $data["tanggal"];
          $update->deskripsi = $data["deskripsi"];
          $update->id_kelas = $data["id_kelas"];
          if ($update->save()) {
            session(["msg"=>"Data Tersimpan"]);
          }else {
            session(["msg"=>"Data Gagal Tersimpan"]);
          }
        }
        return back();
    }
    public function eventhapus($id)
    {
      $del = \Burung\Event::find($id)->delete();
      return back();
    }
    public function eventdetail($id)
    {
      $find = \Burung\Event::where(["id_event"=>$id]);
      if ($find->count() > 0) {
        return view("admin.eventdetail",["data"=>$find->first()]);
      }else {
        return back();
      }
    }
    public function eventdetailkriteria_aksi(Request $req)
    {
      $data = $req->all();
      unset($data["_token"]);
      $create = \Burung\Event_kriteria::create($data);
      if ($create) {
        session(["msg"=>"Data Kriteria Tersimpan"]);
      }else {
        session(["msg"=>"Data Kriteria Gagal Tersimpan"]);
      }
      return back();
    }
    public function eventdetailkriteria_del($id,$del)
    {
      $del = \Burung\Event_kriteria::find($del)->delete();
      return back();
    }
    public function eventdetailjuri_aksi(Request $req)
    {
      $data = $req->all();
      unset($data["_token"]);
      $create = \Burung\Juri::create($data);
      if ($create) {
        session(["msg"=>"Data Juri Tersimpan"]);
      }else {
        session(["msg"=>"Data Juri Gagal Tersimpan"]);
      }
      return back();
    }
    public function eventdetailjuri_del($id,$del)
    {
      $del = \Burung\Juri::find($del)->delete();
      return back();
    }
    public function eventdetailhasil($id)
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
        $whereIn = \Burung\Event_kriteria::where(["id_event"=>$id])->get();
        $in = [];
        foreach ($whereIn as $keys => $values) {
          $in[] = $values->id_event_kriteria;
        }
        $nilai = \Burung\Event_penilaian::where(["id_peserta"=>$value->id_users])->whereIn("id_event_kriteria",$in)->get();
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
      // usort($run,"sortbynilai");
      // return response()->json($run);
      return view("admin.hasil",["data"=>$first,"rank"=>$run,"no"=>1]);
    }
}
