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

         <th>EVRAK TESLİM TARİHİ</th>
         <th>DİLLER</th>
         <th>Tasdik Şekli</th>
         <th>Müşteri Bilgileri</th>
         <th>Fiyat Ve Kapora</th>
        <th>DOSYA</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>TEKLİF VEREN TEMSİLCİ</td>
         <th>ONAY VEREN TEMSİLCİ</td>
         <th>TEMSİLCİ NOT</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($tamamlananteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>

         <td>{{ $teklifler->EvrakTeslimTarihi }}</td>
         <td>{{ $teklifler->KaynakDil }}
         {{ $teklifler->HedefDil }}</td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>{{ $teklifler->isimSoyisim }}
             {{ $teklifler->Telefon }}
             {{ $teklifler->Email }}<td>
          <td>   {{ $teklifler->Kapora }}
                 {{ $teklifler->Fiyat }}
          </td>

          <td>DENEME DOSYA</td>
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
