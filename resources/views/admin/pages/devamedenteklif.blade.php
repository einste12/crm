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
          {{ $teklifler->TeklifVerenTemsilci}}
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
         <td>{{ $teklifler->TastikSekli }}</td>


         <td>{{ $teklifler->Fiyat }}</br>
              {{$teklifler->Kapora}}
          </td>
         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>
         <td>{{ $tercumansss[$teklifler->TercumanID-1]->isimSoyisim }}</td>
         <td>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal2">ONAYLA</a>
           <a href="{{ route('devamedensil',['id'=>$teklifler->id]) }}" class="btn btn-danger">SİL</a>
           <a href="{{ route('devamedenedit',['id'=>$teklifler->id]) }}" class="btn btn-danger">DÜZENLE</a>
           <a href="{{ route('devamedenyazdir',['id'=>$teklifler->id]) }}" class="btn btn-success">YAZDIR</a>

         </td>

       </tr>
       @endforeach
     </tbody>
   </table>

{{ $devamteklif->links() }}



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
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Projeyi Tamamla</button>
               </div>

</form>

           </div>
       </div>
</div>







@endsection
