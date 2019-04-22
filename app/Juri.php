<?php

namespace Burung;

use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
  protected $table = 'juri';
  protected $primaryKey = 'id_role';
  public $timestamps = true;
  protected $fillable = [
  'id_event','id_juri'
  ];
  public function event()
  {
    return $this->hasOne('Burung\Event', 'id_event', 'id_event');
  }
  public function juri()
  {
    return $this->hasOne('Burung\Users', 'id_users', 'id_juri');
  }
}
