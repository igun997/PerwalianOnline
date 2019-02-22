<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasawalmhsModel extends Model
{
  protected $table = 'tbl_kelasawal_mhs';
  protected $primaryKey = 'id_km';
  public $timestamps = true;
  protected $fillable = [
    'id_kelasawal','id_user'
  ];
  public function mhs()
  {
    return $this->hasOne("\SIAK\UsersModel","id_user","id_user")->where(["level"=>"dosen"]);
  }
  public function kelas()
  {
    return $this->hasOne("\SIAK\KelasawalModel","id_kelasawal","id_kelasawal");
  }
}
