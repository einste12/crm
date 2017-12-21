<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdliyeTakipCetveli extends Model
{
    public $timestamps = false;

    protected $table='adliyetakipcetveli';


    protected $fillable = [
      'EvrakAlmaTarihi', 'EvrakTeslimTarihi','EsasNo','KaynakDil','HedefDil','TalepEdilenFiyat','AlinanOdeme','TemsilciID','TemsilciNot','
      OnaylayanTemsilci','OnayDurumu','Silindi','MahkemeID','MahkemeNo',
    ];





  public function mahkeme()
{
  return $this->hasOne('App\AdliyeTakipMahkemeler','id','MahkemeID');
}

    public function temsilci()
{
  return $this->hasOne('App\Temsilciler','id','TemsilciID');
}


}
