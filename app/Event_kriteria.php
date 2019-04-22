<?php

namespace Burung;

use Illuminate\Database\Eloquent\Model;

class Event_kriteria extends Model
{
  protected $table = 'event_kriteria';
  protected $primaryKey = 'id_event_kriteria';
  public $timestamps = true;
  protected $fillable = [
  'id_event','nama','bobot'
  ];
  public function event()
  {
  return $this->hasOne('Burung\Event', 'id_event', 'id_event');
  }
}
