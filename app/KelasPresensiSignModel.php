<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KelasPresensiSignModel extends Model
{
  protected $table = 'tbl_kelas_presensi_signed';
  protected $primaryKey = 'id_ps';
  public $timestamps = true;
  protected $fillable = [
    'id_presensi','id_user','presensi'
  ];
}
