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
         <th>ADI VE SOYADI</th>
         <th>EPOSTA</th>
         <th>TELEFON</th>
         <th>ÇEVİRİ YAPTIĞI DİLLER</th>
         <th>TERCÜME TÜRÜ</th>
         <th>TEMSİLCİ NOT</th>



       </tr>
     </thead>
     <tbody>



       @foreach ($tercuman as $tercumans)

       <tr>
         <td>{{ $tercumans->id }}</td>
         <td>{{ $tercumans->isimSoyisim }}</td>
         <td>{{ $tercumans->Mail }}</td>
         <td>{{ $tercumans->Telefon}}  </td>
         <td>
            @foreach($tercumans->tercumandilbilgileri as $data) {{ $data->KaynakDil}}>{{$data->HedefDil}}={{ $data->BirimFiyat }}<br> @endforeach
         </td>
         <td>@foreach($tercumans->tercumandilbilgileri as $data) {{ $data->tercume_turu}}</br>  @endforeach </td>
         <td> {{$tercumans->temsilciNot}} </td>





       </tr>
     @endforeach
     </tbody>
   </table>

{{ $tercuman->links() }}












@endsection
