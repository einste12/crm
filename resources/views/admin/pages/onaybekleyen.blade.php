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


  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
       <td>@if($teklifler->TastikSekli==1) Yeminli Tercume  @elseif ($teklifler->TastikSekli==2) Noter Tasdikli Tercume @else($teklifler->TastikSekli==3) Apostil Tercume @endif</td>
       <td>DOSYA DENEME</td>
         <td>
         {{ $teklifler->Kapora }}TL</br>
         {{ $teklifler->Fiyat }}TL</td>

         <td>{{ $teklifler->MusteriTalebi }}</td>


         <td>
          {{ $teklifler->TemsilciGelenTeklifNot }}</br>
          Tercüman:{{ (!empty($teklifler->tercuman['isimSoyisim']))? $teklifler->tercuman['isimSoyisim'] : 'BELİRTİLMEDİ'}} 
        </td>
         <td>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal" class="btn btn-danger">ONAYLA</a>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal8" class="btn btn-danger">SİL</a>
           <a href="{{ route('onaybekleyenedit',['id'=>$teklifler->id]) }}" class="btn btn-danger">GÜNCELLE</a>
           <a target="_blank" href="{{ route('onaybekleyenyazdir',['id'=>$teklifler->id]) }}" class="btn btn-danger">YAZDIR</a>
           <a href="{{ route('onaygidenmail',['id'=>$teklifler->id]) }}" class="btn btn-danger">GİDEN MAİL</a>

         </td>
       </tr>
    @endforeach
     </tbody>
   </table>
 </div>



<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Bu Projeyi Devam Edenlere Taşı</h4>
               </div>
<form action="{{ route('gelenteklifonayla') }}" method="POST"/>
{{ csrf_field() }}
       {{--         <div class="form-group">
                 <label for="sel1">Bu İşi Onaylamak İstiyor Musunuz?</label>
                 <select class="form-control" name="onaylayantemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div> --}}

               BU PROJEYE ONAY VERMEK İSTİYOR MUSUNUZ ?

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
               <div class="form-group hidden">
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
                   <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">SİL</button>
               </div>

</form>

           </div>
       </div>
</div>




<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "ordering": false,
          "stateSave": true,

          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              
                {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9]
                }
            },




          ],
          language: {
          search: "_INPUT_",
          searchPlaceholder: "Arama Yapınız",
          }


      });
        var table = $('#datatables').DataTable();     
      });

</script>





@endsection
