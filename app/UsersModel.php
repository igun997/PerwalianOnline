<?php

namespace SIAK;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
  protected $table = 'tbl_users';
  protected $primaryKey = 'id_user';
  public $timestamps = true;
  protected $fillable = [
    'nama_lengkap','username','password','jk','alamat','email','no_hp','no_telepon','level','status_absen','hapus',"id_jurusan"
  ];
  public function jurusan()
  {
      return $this->hasOne('\SIAK\JurusanModel',"id_jurusan","id_jurusan");
  }
  public function semester()
  {
      return $this->hasOne('\SIAK\SemesterModel',"id_semester","id_semester");
  }
}
