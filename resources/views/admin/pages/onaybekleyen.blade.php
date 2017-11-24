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
         <th>TEKLİF VERİLEN TARİH</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>DİLLER</th>
         <th>FİYAT VE KAPORA</th>
         <th>TASTİK ŞEKLİ</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>TEKLİF VEREN TEMSİLCİ</th>
         <th>TEMSİLCİ GELEN NOT</th>
         <th>TERCUMAN ID</th>
         <th>İŞLEMLER</th>

       </tr>
     </thead>
     <tbody>
       @forelse ($onaybekleyen as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->TeklifVerilenTarih }}</td>

         <td>
         {{ $teklifler->isimSoyisim }}</br>
         {{ $teklifler->Telefon }}</br>
         {{ $teklifler->Email }}
       </td>

         <td>{{ $teklifler->KaynakDil }}</br>
             {{ $teklifler->HedefDil }}
       </td>
         <td>
         {{ $teklifler->Kapora }}</br>
         {{ $teklifler->Fiyat }}</td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>{{ $teklifler->TeklifVerenTemsilci}}  </td>

         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>
         <td>{{ $teklifler->TercumanID }}</td>
         <td>
           <a href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal">ONAYLA</a>
           <a href="{{ route('onaybekleyensil',['id'=>$teklifler->id]) }}" class="btn btn-danger">SİL</a>
           <a href="{{ route('onaybekleyenedit',['id'=>$teklifler->id]) }}" class="btn btn-danger">DÜZENLE</a>
           <a href="{{ route('onaybekleyenyazdir',['id'=>$teklifler->id]) }}" class="btn btn-danger">YAZDIR</a>
         </td>
       </tr>
     @empty
       <H3 style="text-align:center; color:red;">ŞUANDA ONAY BEKLEYEN TEKLİF BULUNMAMAKTADIR!</H3>
     @endforelse
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













@endsection
