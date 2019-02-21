<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasPresensiModel extends Model
{
  protected $table = 'tbl_kelas_presensi';
  protected $primaryKey = 'id_presensi';
  public $timestamps = true;
  protected $fillable = [
    'topik_pembahasan','id_kelas'
  ];
  public function kelas()
  {
    return $this->hasOne("\SIAK\KelasModel","id_kelas","id_kelas");
  }
}
