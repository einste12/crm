<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geribildirim extends Model
{
  public $timestamps ="false";




      protected $fillable = [
      'isimSoyisim', 'Telefon','Mail','Kategori','Resim','Mesaj','Neden','Cevap','Tarih',
    
    ];





  protected $table = 'geribildirim';
}
