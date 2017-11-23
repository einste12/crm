@extends('admin.master.master')

@section('content')

  <table class="table table-striped">
     <thead>
       <tr>
         <th>İD</th>
         <th>TARİH</th>
         <th>ADSOYAD</th>
         <th>TELEFON</th>
         <th>MAİL</th>
         <th>KAYNAK DİL</th>
         <th>HEDEF DİL</th>
         <th>TASDİK ŞEKLİ</th>
         <th>MÜŞTERİ NOT</th>
       </tr>
     </thead>
     <tbody>
       @foreach($teklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->isimSoyisim }}</td>
         <td>{{ $teklifler->Email }}</td>
         <td>{{ $teklifler->Telefon }}</td>
         <td>{{ $teklifler->KaynakDil }}</td>
         <td>{{ $teklifler->HedefDil }}</td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
       </tr>
       @endforeach
     </tbody>
   </table>

{{ $teklif->links() }}







@endsection
