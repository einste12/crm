<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TercumanIsTakip extends Model
{
  public $timestamps =false;

  protected $table = 'tercumanistakip';


    protected $fillable = [
        'EklenmeTarih', 'TercumanAdi', 'ProjeAdi','KaynakDil','HedefDil','Karakter','BirimFiyat','TemsilciID','SubeID','TercumanTakipNot','OnayDurumu','silindi','OnayTarihi',
  ];





public function temsilci()
{

  return $this->hasOne('App\Temsilciler','id','TemsilciID');

}




}
