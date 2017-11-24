<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subeler_User extends Model
{
    public $timestamps = false;

    protected $table='sube_user';


    protected $fillable = [
      'user_id', 'sube_id','tarih',
    ];



}
