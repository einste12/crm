@extends('admin.master.master')

@section('content')

<p>İPTAL TEKLİF</p>

 
  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>İD</th>
         <th>İPTAL EDİLEN TARİH</th>
         <th>İPTAL EDEN TEMSİLCİ</td>
         <th>DİLLER</th>
         <th>TASDİK ŞEKLİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>FİYAT VE KAPORA</th>
         <th>İPTAL NEDENİ</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($iptalteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->iptalEtmeTarihi }}</td>
         <td> {{$teklifler->temsilci_iptal['isimSoyisim']  }}</td>
         <td>
           {{ $teklifler->KaynakDil }} > </br>
           {{ $teklifler->HedefDil }}
         </td>
         <td>@if($teklifler->TastikSekli==1) Yeminli Tercume  @elseif ($teklifler->TastikSekli==2) Noter Tasdikli Tercume @else($teklifler->TastikSekli==3) Apostil Tercume @endif</td>
         <td>
          {{ $teklifler->isimSoyisim }}</br>
          {{ $teklifler->Telefon }}</br>
          {{ $teklifler->Email }}
        </td>
         <td>
          {{ $teklifler->Kapora }}</br>
          {{ $teklifler->Fiyat }}
         </td>
         
         <td>{{ $teklifler->iptalNedeni  }}  </td>
       </tr>
       @endforeach
     </tbody>
   </table>
</div>
{{ $iptalteklif->links() }}



@endsection
