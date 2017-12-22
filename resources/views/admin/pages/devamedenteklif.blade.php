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
         <th>TEKLİF VERİLEN TARİH VE TEMSİLCİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
          <th>DİLLER</th>
         <th>TASDİK ŞEKLİ</th>
         <th>FİYAT ve KAPORA </th>
         <th>TEMSİLCİ NOT</th>
         <th>TERCUMAN</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       @foreach ($devamteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>
          {{ $teklifler->TeklifVerilenTarih}}</br>
          {{ $teklifler->temsilci['isimSoyisim']}}
         </td>
         <td>
          {{ $teklifler->isimSoyisim }}</br>
          {{ $teklifler->Telefon }}</br>
          {{ $teklifler->Email }}
         </td>
         <td>
          {{$teklifler->KaynakDil}} > </br>
          {{$teklifler->HedefDil}}
        </td>
         <td>
           @if($teklifler->TastikSekli==1) Yeminli Tercume  @elseif ($teklifler->TastikSekli==2) Noter Tasdikli Tercume @else($teklifler->TastikSekli==3) Apostil Tercume @endif
         </td>


         <td>{{ $teklifler->Fiyat }}</br>
              {{$teklifler->Kapora}}
          </td>
         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>
         <td>{{ $teklifler->tercuman->isimSoyisim }}</td>
         <td>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal2">ONAYLA</a>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal9">SİL</a>
           <a href="{{ route('devamedenedit',['id'=>$teklifler->id]) }}" class="btn btn-danger">DÜZENLE</a>
           <a href="{{ route('devamedenyazdir',['id'=>$teklifler->id]) }}" class="btn btn-success">YAZDIR</a>
           <a href="{{ route('devamgidenmail',['id'=>$teklifler->id]) }}" class="btn btn-danger">GİDEN MAİL</a>

         </td>

       </tr>
       @endforeach
     </tbody>
   </table>
</div>




<div id="edit-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Projeyi Tamamla</h4>
               </div>
<form action="{{ route('tekliftamamla') }}" method="POST"/>
{{ csrf_field() }}


            <div class="form-group">

                <label for="self1">Evrak Teslim Tarihi</label>
                <input type="date" name="EvrakTeslimTarihi" class="form-control">

            </div>


               <div class="form-group">
                 <label for="sel1">Onaylayan Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="devamionaylayantemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div>

               <div class="modal-body edit-content">
                    <input type="hidden" name="devamedenid" id="devamedenid" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">Onayla</button>
               </div>

</form>

           </div>
       </div>
</div>


{{-- DEVAM EDEN SİL  --}}
<div id="edit-modal9" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Devam Eden Teklifi İptaL Et</h4>
               </div>
<form action="{{ route('devamsil') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group">
                 <label for="sel1">İptal Eden  Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="DevamİptalEdenTemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div>
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Devamiptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div> 
            


               <div class="modal-body edit-content">
                    <input type="hidden" name="devamedensil" id="devamedensil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">SİL</button>
               </div>

</form>

           </div>
       </div>
</div>














@endsection
