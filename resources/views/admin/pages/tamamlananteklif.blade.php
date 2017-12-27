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

         <th>EVRAK TESLİM TARİHİ</th>
         <th>Müşteri Bilgileri</th>
         <th>DİLLER</th>
         <th>Tasdik Şekli</th> 
         <th>Fiyat Ve Kapora</th>
        <th>DOSYA</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>ONAY VEREN TEMSİLCİ</th>
         <th>TEMSİLCİ NOT</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       @foreach ($tamamlananteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>

         <td>
           {{ $teklifler->EvrakTeslimTarihi }}
         </td>
          <td>
             {{ $teklifler->isimSoyisim }}
             {{ $teklifler->Telefon }}
             {{ $teklifler->Email }}
         </td>
         <td>
           {{ $teklifler->KaynakDil }} > </br>
           {{ $teklifler->HedefDil }}
       </td>
         <td>@if($teklifler->TastikSekli==1) Yeminli Tercume  @elseif ($teklifler->TastikSekli==2) Noter Tasdikli Tercume @else($teklifler->TastikSekli==3) Apostil Tercume @endif</td>
        
          <td>
            {{ $teklifler->Kapora }}TL
            {{ $teklifler->Fiyat }}TL
          </td>

          <td>DENEME DOSYA</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>{{ $teklifler->temsilci2['isimSoyisim']  }}  </td>

         <td>{{ $teklifler->TemsilciGelenTeklifNot }}</td>
         <td>
           <a href="{{ route('tamamlananedit',['id'=>$teklifler->id]) }}" class="btn btn-danger hidden">DÜZENLE</a>
           <a target="_blank" href="{{ route('tamamlananyazdir',['id'=>$teklifler->id]) }}" class="btn btn-success">YAZDIR</a>
           <a href="{{ route('tamamgidenmail',['id'=>$teklifler->id]) }}" class="btn btn-danger">GİDEN MAİL</a>
           
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
 </div>





@endsection
