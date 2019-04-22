<?php

namespace Burung;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'event';
  protected $primaryKey = 'id_event';
  public $timestamps = true;
  protected $fillable = [
  'nama','tanggal','deskripsi','img_header','id_kelas','id_admin'
  ];
  public function kelas()
  {
    return $this->hasOne('Burung\Kelas', 'id_kelas', 'id_kelas');
  }
  public function admin()
  {
    return $this->hasOne('Burung\Users', 'id_users', 'id_admin');
  }
}
