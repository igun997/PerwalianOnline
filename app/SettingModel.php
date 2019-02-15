<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
  protected $table = 'tbl_setting';
  protected $primaryKey = 'id_setting';
  public $timestamps = true;
  protected $fillable = [
    'tahun_ajar','isi_frs','status_aktif'
  ];
}
