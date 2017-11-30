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
         <th>İSİM SOYİSİM</th>
         <th>ÇEVİRİ YAPTIĞI DİL</th>
         <th>FİYAT</th>
         
       </tr>
     </thead>
     <tbody>



       @foreach ($tercumanmali as $tercumans)

	       	<tr>
		         
		         <td>{{ upper($tercumans->isimSoyisim) }}</td>
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