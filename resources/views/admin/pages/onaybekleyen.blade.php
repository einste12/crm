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
         <th>TEKLİF VERİLEN TARİH</th>
         <th>TEKLİF VEREN TEMSİLCİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>DİLLER</th>
         <th>TASTİK ŞEKLİ</th>
         <th>DOSYA</th>
         <th>FİYAT VE KAPORA</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>TEMSİLCİ GELEN NOT</th>
         <th>İŞLEMLER</th>

       </tr>
     </thead>
     <tbody>
       @foreach ($onaybekleyen as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->TeklifVerilenTarih }}</td>
         <td>{{ $teklifler->temsilci['isimSoyisim']}}  </td>

         <td>
         {{ $teklifler->isimSoyisim }}</br>
         {{ $teklifler->Telefon }}</br>
         {{ $teklifler->Email }}
       </td>


         <td>{{ $teklifler->KaynakDil }}</br>
             {{ $teklifler->HedefDil }}
       </td>
       <td>{{ $teklifler->TastikSekli }}</td>
       <td>DOSYA DENEME</td>
         <td>
         {{ $teklifler->Kapora }}</br>
         {{ $teklifler->Fiyat }}</td>

         <td>{{ $teklifler->MusteriTalebi }}</td>


         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>
         <td>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal">ONAYLA</a>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal8">SİL</a>
           <a href="{{ route('onaybekleyenedit',['id'=>$teklifler->id]) }}" class="btn btn-danger">DÜZENLE</a>
           <a href="{{ route('onaybekleyenyazdir',['id'=>$teklifler->id]) }}" class="btn btn-danger">YAZDIR</a>
           <a href="{{ route('onaygidenmail',['id'=>$teklifler->id]) }}" class="btn btn-danger">GİDEN MAİL</a>

         </td>
       </tr>
    @endforeach
     </tbody>
   </table>

{{ $onaybekleyen->links() }}

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Devam Eden Tekliflere Ekle</h4>
               </div>
<form action="{{ route('gelenteklifonayla') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group">
                 <label for="sel1">Onaylayan Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="onaylayantemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div>

               <div class="modal-body edit-content">
                    <input type="hidden" name="bookId" id="bookId" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Devam Edenlere Ekle</button>
               </div>

</form>

           </div>
       </div>
</div>

{{-- Silme Modalı --}}

<div id="edit-modal8" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Onay Bekleyen Teklifi İptaL Et</h4>
               </div>
<form action="{{ route('onaysil') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group">
                 <label for="sel1">İptal Eden  Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="OnayİptalEdenTemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div>
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Onayiptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div> 
            


               <div class="modal-body edit-content">
                    <input type="hidden" name="onaybekleyensil" id="onaybekleyensil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">İptal Et</button>
               </div>

</form>

           </div>
       </div>
</div>











@endsection
