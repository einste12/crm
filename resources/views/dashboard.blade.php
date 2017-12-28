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


<div class="toolbar">
                                  <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
  <div class="fresh-datatables">
     <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
</div>   






<div id="edit-modal6" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Teklife Fiyat Verin</h4>
               </div>


  <script type="text/javascript">
    

    function setForm(){

      var type = document.getElementById('evraktipi').value=='1'?'evrakli':'evraksiz';


      document.getElementById('mailMetin').value = document.getElementById(type).innerHTML;

      return true;


    }




  </script>



<form action="{{ route('gelentekliffiyatver') }}" onSubmit="return setForm()" method="POST"/>
{{ csrf_field() }}



  <input type="hidden" name="mailMetin" id="mailMetin">

              <div class="form-group">
                <label>Evrak tipi</label>
                <select name="evraktipi" id="evraktipi" class="form-control" required="">
                    <option value="" selected="">Evrak Tipi Seçiniz</option>
                    <option value="1">Evraklı</option>
                    <option value="2">Evraksız</option>
                    

              </select>

              </div>

                <div class="form-group" id="sube2">
                 <label for="sel1">Sube:</label>
                 <select class="form-control" name="sube" required="true">
                  @foreach($subeler as $subelers)
                   <option value="">Seçiniz</option>
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

​1- ​Hızlı teklif almak için https://www.portakaltercume.com/fiyat-teklifi-al/ adresinden belgelerinizi bize gönderebilirsiniz.

​2- Evraklarınızı ​ +90 543 953 21 75 nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.

3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.

Değerlendirmenize sunar, 
İyi çalışmalar dileriz.

<b style="color:red;">{{Auth::user()->name}}</b> / Proje Koordinatörü
Temsilci Gsm:  <b style="color:red;">{{Auth::user()->number}}</b>
Çağrı Merkezi:  444 82 86
www.portakaltercume.com.tr
                      
          

              </div> 

        
    <div class="hidden form-group" id="evrakli">
               


Sayın <span id="isimSoyisim"></span>, 
Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ <div id="evraklifiyat"></div> TL + %18 KDV’ dir.
Ödemenin yapılması halinde belge/belgelerinizin tercümesi <div id="isgosterme"></div> <span class="gunText" style="display:none;">iş günü</span><div id="saatgosterme"></div> <span class="saatText" style="display:none;">saat</span> içerisinde teslim edilecektir.  
Değerlendirmenize sunar, 
İyi çalışmalar dileriz.

<b style="color:red;">{{Auth::user()->name}}</b> / Proje Koordinatörü
Temsilci Gsm: <b style="color:red;">{{Auth::user()->number}}</b>
Çağrı Merkezi:  444 82 86
www.portakaltercume.com.tr

FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDA Kİ GİBİDİR. 

1- EFT YA DA HAVALE
HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI
<b style="color:red;">IBAN NO: TR170020500009380768500001</b> 

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
                   <button type="submit" disabled="false"  class="btn btn-success disa">Teklife Fiyat Ver</button>
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






<script type="text/javascript">
  

var inputBox1=document.getElementById('gun');

inputBox1.onkeyup=function(){
    
    var test = document.getElementById('isgosterme').innerHTML = inputBox1.value;

}




var inputBox2=document.getElementById('saat');


inputBox2.onkeyup=function(){
    var test2=document.getElementById('saatgosterme').innerHTML = inputBox2.value;

}







var inputBox= document.getElementById('evrakfiyati');


inputBox.onkeyup = function(){
    var test = document.getElementById('evraklifiyat').innerHTML = inputBox.value;

}

$(function(){
  $('#teslimzamani').change(function(){
      if( $(this).val() == '2'){
          $('#isgosterme').html('');
          $('input[name="isgunu"]').val('');


        $('.saatText').show();
        $('.gunText').hide();
      }
      if( $(this).val() == '1'){
        $('#saatgosterme').html('');
        $('input[name="issaati"]').val('');

         $('.saatText').hide();
         $('.gunText').show();

      }
      console.log($(this).val());
  })
})



</script>

@endsection
