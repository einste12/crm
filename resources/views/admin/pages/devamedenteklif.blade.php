@extends('admin.master.master')

@section('content')

<p>DEVAM EDEN</p>

  <table class="table table-striped">
     <thead>
       <tr>
         <th>İD</th>
         <th>TARİH</th>
         <th>ADSOYAD</th>
         <th>TELEFON</th>
         <th>MAİL</th>
         <th>TASDİK ŞEKLİ</th>
         <th>MÜŞTERİ NOT</th>
         <th>TEKLİF VEREN TEMSİLCİ</th>
         <th>FİYAT </th>
         <th>TEMSİLCİ TARAFINDAN YOLLANAN NOT</th>
       </tr>
     </thead>
     <tbody>
       @foreach ($devamteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->isimSoyisim }}</td>
         <td>{{ $teklifler->Telefon }}</td>
         <td>{{ $teklifler->Email }}</td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>{{ $teklifler->TeklifVerenTemsilci}}  </td>
         <td>{{ $teklifler->Fiyat }}</td>
         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>

       </tr>
       @endforeach
     </tbody>
   </table>

{{ $devamteklif->links() }}



@endsection
