<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class TajarModel extends Model
{
  protected $table = 'tbl_tajar';
  protected $primaryKey = 'id_tajar';
  public $timestamps = true;
  protected $fillable = [
    'nama_tajar'
  ];
}
