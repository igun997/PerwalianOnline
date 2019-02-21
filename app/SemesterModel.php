<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class SemesterModel extends Model
{
  protected $table = 'tbl_semester';
  protected $primaryKey = 'id_semester';
  public $timestamps = true;
  protected $fillable = [
    'nama_semester',"id_tajar"
  ];
  public function tajar()
  {
    return $this->hasOne("\SIAK\TajarModel","id_tajar","id_tajar");
  }
}
