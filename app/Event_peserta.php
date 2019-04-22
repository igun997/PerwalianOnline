<?php

namespace Burung;

use Illuminate\Database\Eloquent\Model;

class Event_peserta extends Model
{
  protected $table = 'event_peserta';
  protected $primaryKey = 'id_event_peserta';
  public $timestamps = true;
  protected $fillable = [
  'id_event','id_users','no_gantangan','foto_burung'
  ];
  public function event()
  {
    return $this->hasOne('Burung\Event', 'id_event', 'id_event');
  }
  public function users()
  {
    return $this->hasOne('Burung\Users', 'id_users', 'id_users');
  }
}
