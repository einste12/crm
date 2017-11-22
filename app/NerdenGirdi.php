<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NerdenGirdi extends Model
{
    public $timestamps = false;

    protected $table='nerdengirdi';


    protected $fillable = [
      'user_id', 'sube_id','tarih',
    ];

}
