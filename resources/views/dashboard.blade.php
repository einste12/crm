@extends('admin.master.master')

@section('content')

  @if(Session::has('message'))
        <div class="row">
          <div class="col-md-12">
           <div class="alert alert-success text-center"> {{ Session::get('message') }}</div>
          </div>
        </div>
  @endif




  <table class="table table-striped">
     <thead>
       <tr>
         <th>İD</th>
         <th>GELEN TEKLİF TARİHİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>DİLLER</th>
         <th>TASDİK ŞEKLİ</th>
         <th>DOSYA</th>
         <th>MÜŞTERİ NOT</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       @foreach($teklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->isimSoyisim }}</br>
             {{ $teklifler->Email }}</br>
             {{ $teklifler->Telefon }}
       </td>
         <td>
          {{ $teklifler->KaynakDil }} > </br>
          {{ $teklifler->HedefDil }}
       </td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>DENEME DOSYA ALANI</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>
           <a href="{{ route('gelenteklifsil',['id'=>$teklifler->id]) }}" class="btn btn-danger">SİL</a>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal6">Fiyat Ver</a>

         </td>
       </tr>
       @endforeach
     </tbody>
   </table>

{{ $teklif->links() }}

<div id="edit-modal6" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Teklife Fiyat Verin</h4>
               </div>
<form action="{{ route('gelenteklifonayla') }}" method="POST"/>
{{ csrf_field() }}


              <div class="form-group">
                <label>Evrak tipi</label>
                <select name="evraktipi" id="evraktipi" class="form-control">
                    <option value="" selected="">Seçiniz</option>
                    <option value="1">Evraklı</option>
                    <option value="2">Evraksız</option>
                    

              </select>

              </div>

                <div class="form-group" id="sube2">
                 <label for="sel1">Sube:</label>
                 <select class="form-control" name="sube">
                  @foreach($subeler as $subelers)
                   <option value="{{ $subelers->id }}">{{ $subelers->name }}</option>
                 @endforeach
                 </select>
               </div>

            <div class="form-group" id="temsilcinot">
                <label>Bu Bölüm sadece Temsilci Tarafından görüntülenir.</label>
            <textarea name="" class="form-control"></textarea>   
           </div>

                
              <div class="hidden form-group" id="tastiksekli">
                <label>Evrak tipi</label>
                <select name="tastiksekli" id="tastiksekli" class="form-control">
                    
                    <option value="1">Tasdikli</option>
                    <option value="2">Tasdiksiz</option>
                    

              </select>

              </div>

              <div class="hidden form-group" id="teslimzamani">
                <label>Teslimat Zamanı</label>
                <select name="teslimzamani" id="teslimzamani" class="form-control">
                    <option value="" selected="">Seçiniz</option>
                    <option value="1">Gün</option>
                    <option value="2">Saat</option>
                    

              </select>

              </div>

            <div class="hidden form-group" id="isgunu">
               <label>Kaç İş Günü İçinde Verilecek?</label>
   
                  <input type="text" name="isgunu" class="form-control">            
    
              </div>



              <div class="hidden form-group" id="fiyat">
               <label>Teslim Zamanı</label>
   
                  <input type="text" name="fiyat" class="form-control">            
    
              </div>
          




              <div class="hidden form-group" id="not1">
                <label>Müşteriye Gidicek Mail</label>
               <textarea class="form-control" readonly>
                    

              Sayın <span class="madi"></span><br />
<span id="tasdikHtml">Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ <span id="fiyat1">XXX</span> TL + %18 KDV’ dir.</span>
Ödemenin yapılması halinde belge/belgelerinizin tercümesi <span id="sure">XX</span><span id="suretur"> iş günü/saat </span>içerisinde teslim edilecektir.  

Değerlendirmenize sunar, <br />
İyi çalışmalar dileriz.

<span id="temsilci-adi"></span> / Proje Koordinatörü<br /><br />
<b>Temsilci Gsm:</b> <span id="temsilci-telefon"> </span>
<b>Çağrı Merkezi:</b>  444 82 86
www.portakaltercume.com.tr

FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDA Kİ GİBİDİR. 

1- EFT YA DA HAVALE
HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI
IBAN NO: TR170020500009380768500001 

HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. ZİRAAT BANKASI
IBAN NO: TR860001000485758944095001 

2- İNTERNET SİTEMİZ ÜZERİNDEN VISA-MASTERCARD YA DA AMERICAN EXPRESS KREDİ KARTLARIYLA ÖDEME YAPABİLİRSİNİZ. https://www.portakaltercume.com/online-odeme/ 

3- MAİL ORDER SİSTEMİ İLE ÖDEME YAPABİLİRSİNİZ.(FİRMAMIZDAN FORMU TALEP EDİNİZ)
</div>
                                            
                            
<div class="hidden" id="evraksiznot"><p>Sayın <span class="madi"></span><br />
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz. 

​1- ​Hızlı teklif almak için <a href="https://www.portakaltercume.com/fiyat-teklifi-al/?ref=crm">https://www.portakaltercume.com/fiyat-teklifi-al/</a> adresinden belgelerinizi bize gönderebilirsiniz.

​2- Evraklarınızı ​<b> <span id="temsilci-telefon"></span></b> nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.

3- ​<a href="mailto:info@portakaltercume.com.tr">info@portakaltercume.com.tr</a> adresine mail atabilirsiniz.

Değerlendirmenize sunar, <br />
İyi çalışmalar dileriz.

<span id="temsilci-adi"></span> / Proje Koordinatörü<br /><br />
<b>Temsilci Gsm:</b> <span id="temsilci-telefon"></span>
<b>Çağrı Merkezi:</b>  444 82 86
www.portakaltercume.com.tr
</div>            
          


                





               </textarea>
              </div> 


               <div class="modal-body edit-content">
                    <input type="hidden" name="tekliffiyat" id="tekliffiyat" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Devam Edenlere Ekle</button>
               </div>

</form>

           </div>
       </div>
</div>





@endsection
