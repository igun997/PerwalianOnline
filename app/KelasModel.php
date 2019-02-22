<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
  protected $table = 'tbl_kelas';
  protected $primaryKey = 'id_kelas';
  public $timestamps = true;
  protected $fillable = [
    'nama_kelas','id_ruangan','kuota_kelas','id_matkul','id_user','id_jurusan','mulai_kelas','selesai_kelas'
  ];
  public function ruangan()
  {
    return $this->hasOne("\SIAK\RuanganModel","id_ruangan","id_ruangan");
  }
  public function matkul()
  {
    return $this->hasOne("\SIAK\MatkulModel","id_matkul","id_matkul");
  }
  public function dosen()
  {
    return $this->hasOne("\SIAK\UsersModel","id_user","id_user")->where(["level"=>"dosen"]);
  }
  public function jurusan()
  {
    return $this->hasOne("\SIAK\JurusanModel","id_jurusan","id_jurusan");
  }
}
