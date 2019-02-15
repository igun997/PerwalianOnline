<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class KurikulumModel extends Model
{
  protected $table = 'tbl_kurikulum';
  protected $primaryKey = 'id_kurikulum';
  public $timestamps = true;
  protected $fillable = [
    'nama_kurikulum','id_user'
  ];
}
