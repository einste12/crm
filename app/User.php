<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','yer','number',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sonsube(){
        return $this->hasOne('App\Subeler','id','Yer'); // başta her zaman oldugun sayfanın gelir USER 
    }

    public function subeler(){

        return $this->belongsToMany('App\Subeler','sube_user','user_id','sube_id');
     }





}
