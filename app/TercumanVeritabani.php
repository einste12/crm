<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TercumanVeritabani extends Model
{
  public $timestamps =false;

  protected $table = 'tercumanveritabani';

  protected $fillable = [
      'id','isimSoyisim', 'Mail', 'Telefon','temsilciNot','Locasyon','Hesapsahibi','ibanno','BasvuruTarihi','onaydurumu',
  ];


public function teklif()

{
  return $this->belongsTo('App\Teklifler','id','TercumanID');
}

public function tercumandilbilgileri()
{

  return $this->hasMany('App\Tercumandilbilgileri','TercumanID');

}


}
