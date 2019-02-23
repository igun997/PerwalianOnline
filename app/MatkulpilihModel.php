<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class MatkulpilihModel extends Model
{
  protected $table = 'tbl_matkulpilih';
  protected $primaryKey = 'id_matkulpilih';
  public $timestamps = true;
  protected $fillable = [
    'id_matkul','id_user','id_kelasawal',"id_kelas"
  ];
  public function matkul()
  {
    return $this->hasOne("\SIAK\MatkulModel","id_matkul","id_matkul");
  }
  public function mhs()
  {
    return $this->hasOne("\SIAK\UsersModel","id_user","id_user");
  }
  public function kelasawal()
  {
    return $this->hasOne("\SIAK\KelasawalModel","id_kelasawal","id_kelasawal");
  }
  public function kelas()
  {
    return $this->hasOne("\SIAK\KelasModel","id_kelas","id_kelas");
  }
}
}
