<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TercumanIsTakip extends Model
{
  public $timestamps =false;

  protected $table = 'tercumanistakip';


    protected $fillable = [
        'Tarih', 'TercumanAdi', 'ProjeAdi','KaynakDil','HedefDil','Karakter','BirimFiyat','Temsilci','GonderenYer','TercumanTakipNot','OnayDurumu','Silindi',
  ];



}
