<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class MatkulModel extends Model
{
  protected $table = 'tbl_matkul';
  protected $primaryKey = 'id_matkul';
  public $timestamps = true;
  protected $fillable = [
    'nama_matkul','total_sks','pertemuan','id_kurikulum','status_aktif'
  ];
}
