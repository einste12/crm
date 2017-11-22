@extends('admin.master.master')

@section('content')

<p>TAMAMLANAN TEKLİF</p>

  <table class="table table-striped">
     <thead>
       <tr>
         <th>İD</th>
         <th>TARİH</th>
         <th>EVRAK TESLİM TARİHİ</th>
         <th>KAYNAK DİL</th>
         <th>HEDEF DİL</th>
         <th>İsim Soyisim</th>
         <th>Kapora</th>
         <th>Telefon</th>
         <th>Email</th>
         <th>Tasdik Şekli</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>TEKLİF VEREN TEMSİLCİ</td>
         <th>ONAY VEREN TEMSİLCİ</td>
         <th>TEMSİLCİYE GELEN NOT</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($tamamlananteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->EvrakTeslimTarihi }}</td>
         <td>{{ $teklifler->KaynakDil }}</td>
         <td>{{ $teklifler->HedefDil }}</td>
         <td>{{ $teklifler->isimSoyisim }}</td>
          <td>{{ $teklifler->Kapora }}</td>
         <td>{{ $teklifler->Telefon }}</td>
         <td>{{ $teklifler->Email }}</td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>{{ $teklifler->TeklifVerenTemsilci}}  </td>
         <td>{{ $teklifler->OnaylayanTemsilciID  }}  </td>
         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>
       </tr>
       @endforeach
     </tbody>
   </table>

{{ $tamamlananteklif->links() }}



@endsection
