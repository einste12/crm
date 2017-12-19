@extends('admin.master.master')

@section('content')


  @if (alert()->ready())
    <script>
        swal({
          title: "{!! alert()->message() !!}",
          text: "{!! alert()->option('text') !!}",
          type: "{!! alert()->type() !!}"
        });
    </script>
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
         <td>
          {{ $teklifler->isimSoyisim }}</br>
          {{ $teklifler->Email }}</br>
          {{ $teklifler->Telefon }}
       </td>
         <td>
          {{ $teklifler->KaynakDil }} > </br>
          {{ $teklifler->HedefDil }}
       </td>
         <td>@if($teklifler->TastikSekli==1) Yeminli Tercume  @elseif ($teklifler->TastikSekli==2) Noter Tasdikli Tercume @else($teklifler->TastikSekli==3) Apostil Tercume @endif</td>
         <td>DENEME DOSYA ALANI</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal7" class="send-id btn btn-danger">SİL</a>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal6" class="send-id">Fiyat Ver</a>

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
<form action="{{ route('gelentekliffiyatver') }}" method="POST"/>
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
            <textarea name="temsilcinot" class="form-control"></textarea>   
           </div>

                
              <div class="hidden form-group" id="tastiksekli">
                <label>Evrak tipi</label>
                <select name="tastiksekli" id="tastiksekli" class="form-control">
                    
                    <option value="1">Tasdikli</option>
                    <option value="2">Tasdiksiz</option>
                    

              </select>

              </div>

              <div class="hidden form-group" id="teslimzamani1">
                <label>Teslimat Zamanı</label>
                <select name="teslimzamani" id="teslimzamani" class="form-control">
                    <option value="" selected="">Seçiniz</option>
                    <option value="1">Gün</option>
                    <option value="2">Saat</option>
                    

              </select>

              </div>

            <div class="hidden form-group" id="isgunu">
               <label>Kaç İş Günü İçinde Verilecek?</label>
   
                  <input type="text" id="gun" name="isgunu" class="form-control">            
    
              </div>


            <div class='printchatbox' id='printchatbox'></div>

              <div class="hidden form-group" id="issaati">
               <label>Kaç Saat İçinde Verilecek?</label>
   
                  <input type="text" id="saat" name="issaati" class="form-control">            
    
              </div>



              <div class="hidden form-group" id="fiyat">
               <label>Fiyat</label>
   
                  <input type="text" id="evrakfiyati" name="fiyat" class="form-control">            
    
              </div>
          
         

              <div class="hidden form-group" id="evraksiz">
                <label>Müşteriye Gidicek Mail</label>
    
                    EVRAKSIZ DOKUMAN

    
      
                 Sayın <span class="ilkisim"></span>, 
                      Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz. 

​                       1- ​Hızlı teklif almak için https://www.portakaltercume.com/fiyat-teklifi-al/ adresinden belgelerinizi bize gönderebilirsiniz.

​                       2- Evraklarınızı ​ +90 543 953 21 75 nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.

                        3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.

                        Değerlendirmenize sunar, 
                        İyi çalışmalar dileriz.

                        {{Auth::user()->name}} / Proje Koordinatörü
                        Temsilci Gsm:  {{Auth::user()->number}}
                        Çağrı Merkezi:  444 82 86
                        www.portakaltercume.com.tr
                      
          

              </div> 

        
                <div class="hidden form-group" id="evrakli">
                <label>Müşteriye Gidicek Mail</label>

                  Sayın <span id="isimSoyisim"></span>, 
                      Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ <div id="evraklifiyat"></div> TL + %18 KDV’ dir.
                        Ödemenin yapılması halinde belge/belgelerinizin tercümesi <div id="isgosterme"></div> iş günü/<div id="saatgosterme"></div> saat içerisinde teslim edilecektir.  

                        Değerlendirmenize sunar, 
                        İyi çalışmalar dileriz.

                        {{Auth::user()->name}} / Proje Koordinatörü
                        Temsilci Gsm: {{Auth::user()->number}}
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
              
                      
              </div> 




               <div class="modal-body edit-content">
                    <input type="hidden" name="tekliffiyat" id="tekliffiyat1" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Teklife Fiyat Ver</button>
               </div>

</form>

           </div>
       </div>
</div>


{{-- SiLME MODALI --}}

<div id="edit-modal7" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Gelen Teklifi İptal Et</h4>
               </div>
<form action="{{ route('gelenteklifsil') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri</label>
                 <select class="form-control" name="iptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div> 
            
                <div class="modal-body edit-content">
                    <input type="hidden" name="teklifsil" id="gelenteklifsil1" value=""/>
               </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">Onayla</button>
               </div>

</form>

           </div>
       </div>
</div>




@endsection
