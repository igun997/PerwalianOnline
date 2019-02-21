<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class MatkulModel extends Model
{
  protected $table = 'tbl_matkul';
  protected $primaryKey = 'id_matkul';
  public $timestamps = true;
  protected $fillable = [
    'kode_matkul','nama_matkul','total_sks','pertemuan','id_semester','id_kurikulum','jenis'
  ];
  public function semester()
  {
    return $this->hasOne("\SIAK\SemesterModel","id_semester","id_semester");
  }
  public function kurikulum()
  {
    return $this->hasOne("\SIAK\KurikulumModel","id_kurikulum","id_kurikulum");
  }
}
