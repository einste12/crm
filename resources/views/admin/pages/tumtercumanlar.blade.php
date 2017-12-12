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



  <form action="{{ route('tercumanara')  }}" method="POST">
    {{ csrf_field() }}

    
  
   <div class="form-group">
    <label for="exampleFormControlSelect1">Diller</label>
    <select class="form-control" id="exampleFormControlSelect1" name="dil2">
      @foreach($diller as $dillers)
        <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
      @endforeach
    </select>
  </div>


  <select name="calisilan2" class="form-control col-md-3">
      
      <option value="3">Sık Çalıştığımız Tercumanlar</option>
      <option value="2">Onaylanan Tercumanlar</option>
 
  </select>

<input type="submit" class="btn btn-success" value="Ara">

</form>





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
