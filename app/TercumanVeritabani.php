<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TercumanVeritabani extends Model
{
  public $timestamp ="false";

  protected $table = 'tercumanveritabani';


public function teklif()

{
  return $this->belongsTo('App\Teklifler','id','TercumanID');
}


}
