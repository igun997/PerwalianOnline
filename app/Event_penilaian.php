<?php

namespace Burung;

use Illuminate\Database\Eloquent\Model;

class Event_penilaian extends Model
{
  protected $table = 'event_penilaian';
  protected $primaryKey = 'id_event_penilaian';
  public $timestamps = true;
  protected $fillable = [
  'id_event_kriteria','id_peserta','nilai'
  ];
  public function event()
  {
    return $this->hasOne('Burung\Event_kriteria', 'id_event_kriteria', 'id_event_kriteria');
  }
  public function peserta()
  {
    return $this->hasOne('Burung\Users', 'id_users', 'id_peserta');
  }
}
