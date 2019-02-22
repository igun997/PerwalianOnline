<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasawalModel extends Model
{
  protected $table = 'tbl_kelasawal';
  protected $primaryKey = 'id_kelasawal';
  public $timestamps = true;
  protected $fillable = [
    "kode_kelas",'nama_kelas','id_tajar','id_user','id_jurusan'
  ];
  public function dosen()
  {
    return $this->hasOne("\SIAK\UsersModel","id_user","id_user")->where(["level"=>"dosen"]);
  }
  public function jurusan()
  {
    return $this->hasOne("\SIAK\JurusanModel","id_jurusan","id_jurusan");
  }
  public function tajar()
  {
    return $this->hasOne("\SIAK\TajarModel","id_tajar","id_tajar");
  }
}
