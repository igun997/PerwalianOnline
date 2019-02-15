<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
  protected $table = 'tbl_kelas';
  protected $primaryKey = 'id_kelas';
  public $timestamps = true;
  protected $fillable = [
    'nama_kelas','ruangan_kelas','kuota_kelas','id_matkul','id_user'
  ];
}
