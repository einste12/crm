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
         <th>TARİH</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>DİLLER</th>
         <th>TASDİK ŞEKLİ</th>
         <th>DOSYA</th>
         <th>MÜŞTERİ NOT</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       @foreach($teklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>{{ $teklifler->isimSoyisim }}</br>
             {{ $teklifler->Email }}</br>
             {{ $teklifler->Telefon }}
       </td>
         <td>
          {{ $teklifler->KaynakDil }} > </br>
          {{ $teklifler->HedefDil }}
       </td>
         <td>{{ $teklifler->TastikSekli }}</td>
         <td>DENEME DOSYA ALANI</td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>
           <a href="{{ route('gelenteklifsil',['id'=>$teklifler->id]) }}" class="btn btn-danger">SİL</a>

         </td>
       </tr>
       @endforeach
     </tbody>
   </table>

{{ $teklif->links() }}







@endsection
