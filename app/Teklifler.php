<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teklifler extends Model
{
public $timestamps = false;


protected $fillable = [
    'id', 'isimSoyisim', 'Email','Telefon','FormGelenTur','iptalNedeni','TeklifVerenTemsilci','OnayDurumu','silindi',
    'KaynakDil','HedefDil','MeslekiUzmanlik','MusteriTalebi','TercumanID','TastikSekli','Fiyat',
    'Kapora','TemsilciGelenTeklifNot','OnaylayanTemsilciID','OnayVerilenTarih','EvrakTeslimTarihi','TeklifVerilenTarih','iptalEdenTemsilciID','PaneldenEklendi','CustomerType',
    'GonderilenGun','GonderilenSaat','GonderilenMailEvrakTuru','FormUrl','SurekliMusteri','SubeID','iptalEtmeTarihi','GelenTeklifTarihi',
];

  protected $table = 'teklifler';




public function tercuman()
{
  return $this->hasMany('App\TercumanVeritabani','TercumanID','id');
}


public function temsilci()
{
  return $this->hasMany('App\Temsilciler','TeklifVerenTemsilci','id');
}


public function temsilci2()
{
  return $this->hasMany('App\Temsilciler','OnaylayanTemsilciID','id');
}

public function temsilci3()
{
  return $this->hasMany('App\Temsilciler','iptalEdenTemsilciID','id');
}

}
