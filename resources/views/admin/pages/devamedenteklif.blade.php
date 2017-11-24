@extends('admin.master.master')

@section('content')

<p>DEVAM EDEN</p>

  <table class="table table-striped">
     <thead>
       <tr>
         <th>İD</th>
         <th>TEKLİF TARİHİ</th>
         <th>TEKLİF VERİLEN TARİH VE TEMSİLCİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>TASDİK ŞEKLİ</th>
         <th>DİLLER</th>
         <th>MÜŞTERİ NOT</th>
         <th>FİYAT ve KAPORA </th>
         <th>TEMSİLCİ TARAFINDAN YOLLANAN NOT</th>
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
         <td>{{ $teklifler->TastikSekli }}</td>

         <td>
          {{$teklifler->KaynakDil}} > </br>
          {{$teklifler->HedefDil}}
        </td>
         <td>{{ $teklifler->MusteriTalebi }}</td>

         <td>{{ $teklifler->Fiyat }}</br>
              {{$teklifler->Kapora}}
          </td>
         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>

       </tr>
       @endforeach
     </tbody>
   </table>

{{ $devamteklif->links() }}








@endsection
