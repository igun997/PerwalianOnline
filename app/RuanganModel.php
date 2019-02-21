<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class RuanganModel extends Model
{
  protected $table = 'tbl_ruangan';
  protected $primaryKey = 'id_ruangan';
  public $timestamps = true;
  protected $fillable = [
    'nama_ruangan','kuota_ruangan'
  ];
}
