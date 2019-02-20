<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
  protected $table = 'tbl_jurusan';
  protected $primaryKey = 'id_jurusan';
  public $timestamps = true;
  protected $fillable = [
    'nama_jurusan','status_jurusan'
  ];
}
