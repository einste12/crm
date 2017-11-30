<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tercumandilbilgileri extends Model
{
  public $timestamps =false;


  protected $fillable = [
      'TercumanID', 'KaynakDil', 'HedefDil','BirimFiyat','tercume_turu','silindi','silindi',
  ];


  protected $table = 'tercumandilbilgileri';
  
}
