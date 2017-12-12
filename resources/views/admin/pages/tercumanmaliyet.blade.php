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
  
  <form action="{{ route('maliyetara')  }}" method="POST">
    {{ csrf_field() }}

    
  
   <div class="form-group">
    <label for="exampleFormControlSelect1">Diller</label>
    <select class="form-control" id="exampleFormControlSelect1" name="dil">
      @foreach($diller as $dillers)
        <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
      @endforeach
    </select>
  </div>


  <select name="calisilan" class="form-control col-md-3">
      
      <option value="3">Sık Çalıştığımız Tercumanlar</option>
      <option value="2">Onaylanan Tercumanlar</option>
 
  </select>

<input type="submit" class="btn btn-success" value="Ara">

</form>




  <table class="table table-striped">
     <thead>
       <tr>
         <th>İSİM SOYİSİM</th>
         <th>ÇEVİRİ YAPTIĞI DİL</th>
         <th>FİYAT</th>
         
       </tr>
     </thead>
     <tbody>



       @foreach ($tercumanmali as $tercumans)

	       	<tr>
		         
		         <td>{{ mb_strtoupper($tercumans->isimSoyisim) }}</td>
		         <td>
		            @foreach($tercumans->tercumandilbilgileri as $data)
                 {{ $data->KaynakDil}}>{{$data->HedefDil}}
                @endforeach
	 	         </td>
              <td>
                
              {{ $data->BirimFiyat }}TL

              </td>
       		</tr>
     @endforeach
     </tbody>
   </table>

{{ $tercuman->links() }}



@endsection