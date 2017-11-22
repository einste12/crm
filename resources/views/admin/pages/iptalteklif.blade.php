@extends('admin.master.master')

@section('content')

<p>İPTAL TEKLİF</p>

  <table class="table table-striped">
     <thead>
       <tr>
         <th>İD</th>
         <th>TARİH</th>
         <th>EVRAK İPTAL TARİHİ</th>
         <th>KAYNAK DİL</th>
         <th>HEDEF DİL</th>
         <th>İsim Soyisim</th>
         <th>Kapora</th>
         <th>Telefon</th>
         <th>Email</th>
         <th>Tasdik Şekli</th>
         <th>fİYAT</th>
         <th>İPTAL EDEN TEMSİLCİ</td>
         <th>İPTAL NEDENİ</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($iptalteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->iptalEtmeTarihi }}</td>
         <td>{{ $teklifler->KaynakDil }}</td>
         <td>{{ $teklifler->HedefDil }}</td>
         <td>{{ $teklifler->isimSoyisim }}</td>
          <td>{{ $teklifler->Kapora }}</td>
         <td>{{ $teklifler->Telefon }}</td>
         <td>{{ $teklifler->Email }}</td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>{{ $teklifler->Fiyat }}</td>
         <td>{{ $teklifler->iptalEdenTemsilciID}}  </td>
         <td>{{ $teklifler->iptalNedeni  }}  </td>
       </tr>
       @endforeach
     </tbody>
   </table>

{{ $iptalteklif->links() }}



@endsection
