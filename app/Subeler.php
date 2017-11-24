<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subeler extends Model
{
    public $timestamp ="false";

    protected $table = 'subeler';




    public function users(){

        return $this->belongsToMany('App\User','sube_user','sube_id','user_id');
     }


}
