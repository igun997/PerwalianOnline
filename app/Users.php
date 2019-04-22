<?php

namespace Burung;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id_users';
  public $timestamps = true;
  protected $fillable = [
  'nama','username','password','email','hp','alamat','level','status'
  ];
}
