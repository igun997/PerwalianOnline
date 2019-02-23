<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasPesertaModel extends Model
{
  protected $table = 'tbl_kelas_peserta';
  protected $primaryKey = 'id_peserta';
  public $timestamps = true;
  protected $fillable = [
    'id_kelas','id_user','nilai_akhir'
  ];
  public function mahasiswa()
  {
    return $this->hasOne("\SIAK\UsersModel","id_user","id_user")->where(["level"=>"mhs"]);
  }
  public function kelas()
  {
    return $this->hasOne("\SIAK\KelasModel","id_kelas","id_kelas");
  }
}
