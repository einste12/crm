@extends('admin.master.master')

@section('content')


    <div class="form-group">
      <label for="exampleInputEmail1">Teklif Verilen Tarih</label>
      <input type="text" class="form-control"  value="{{ $tamammaildetay->TeklifVerilenTarih }}" name="isimSoyisim" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Müşteri Adı</label>
      <input type="text" class="form-control" value="{{ $tamammaildetay->isimSoyisim   }}"  name="Telefon" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-POSTA</label>
      <input type="email" class="form-control" value="{{  $tamammaildetay->Email  }}"   name="Email" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Telefon</label>
      <input type="text" class="form-control"  value="{{ $tamammaildetay->Telefon }}" name="KaynakDil" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">TeklifVerenTemsilci</label>
      <input type="text" class="form-control"  value="{{ $tamammaildetay->temsilci['isimSoyisim'] }}"  name="HedefDil" readonly="">
    </div>
 

 <div class="form-group">
      <label for="exampleInputPassword1">NOT EKLE</label>
    <textarea name="" class="form-control" readonly="">
      
      {{ $tamammaildetay->TemsilciGelenTeklifNot }}


    </textarea>

​</div>



    <div class="form-group">
  <label for="comment">Giden Mail</label>
  <textarea class="form-control" rows="5" id="comment" readonly="">
      @if($maildetay->GonderilenMailEvrakTuru==1)
Sayın {{ $maildetay->isimSoyisim }}, 
  Göndermiş olduğunuz belge/belgelerin tercüme+noter tasdik ücreti {{ $maildetay->Fiyat }} + %18 KDV'dir.Apostil hizmeti fiyata dahil değildir. 
Ödemenin yapılması halinde belge/belgelerinizin tercümesi {{ $maildetay->GonderilenGun }} iş günü içerisinde teslim edilecektir.  

Değerlendirmenize sunar, 
İyi çalışmalar dileriz.

{{ $maildetay->temsilci['isimSoyisim'] }} / Proje Koordinatörü
Temsilci Gsm: {{ $maildetay->temsilci['Telefon']  }}
Çağrı Merkezi:  444 82 86
www.portakaltercume.com.tr

FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDA Kİ GİBİDİR. 

1- EFT YA DA HAVALE
HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI
IBAN NO: TR170020500009380768500001 

HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. ZİRAAT BANKASI
IBAN NO: TR860001000485758944095001 

2- İNTERNET SİTEMİZ ÜZERİNDEN VISA-MASTERCARD YA DA AMERICAN EXPRESS KREDİ KARTLARIYLA ÖDEME YAPABİLİRSİNİZ. https://www.portakaltercume.com/online-odeme/ 

3- MAİL ORDER SİSTEMİ İLE ÖDEME YAPABİLİRSİNİZ.(FİRMAMIZDAN FORMU TALEP EDİNİZ)

@else

Sayın {{ $maildetay->isimSoyisim }}, 
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz. 

​1- ​Hızlı teklif almak için https://www.portakaltercume.com/fiyat-teklifi-al/ adresinden belgelerinizi bize gönderebilirsiniz.

​2- Evraklarınızı ​ +90 543 953 21 75 nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.

3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.

Değerlendirmenize sunar, 
İyi çalışmalar dileriz.

{{ $maildetay->temsilci['isimSoyisim'] }} / Proje Koordinatörü
Temsilci Gsm:  {{ $maildetay->temsilci['Telefon']  }}
Çağrı Merkezi:  444 82 86
www.portakaltercume.com.tr


@endif

  </textarea>
</div>
   




<a href="{{ url('/') }}" role="button" class="btn btn-danger readonly=""">Geri Dön</button>


@endsection
