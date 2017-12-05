@extends('admin.master.master')

@section('content')


@if(Session::has('message'))
        <div class="row">
          <div class="col-md-12">
           <div class="alert alert-success text-center"> {{ Session::get('message') }}</div>
          </div>
        </div>
  @endif




  <form action="{{ route('lksara')  }}" method="POST">
    {{ csrf_field() }}

    <input type="text" name="ara" class="form-control">
    

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
         <th>ID</th>
         <th>TARİH</th>
         <th>PROJE ADI</th>
         <th>ÇEVİRİ YAPTIĞI DİL</th>
         <th>KARAKTER</th>
         <th>BİRİM FİYAT </th>
         <th>TEMSİLCİ</th>
         <th>PROJE NOT</th>
         
       </tr>
     </thead>
     <tbody>


  @if(count($result))
       @foreach ($result as $results)

	       	<tr>
		         <td>{{ $results->id }}</td>
             <td>{{ $results->EklenmeTarih }}</td>
             <td>{{ $results->ProjeAdi }}</td>
		         <td>
		          {{$results->KaynakDil}}>{{$results->HedefDil}}</br>
	 	         </td>
             <td>{{ $results->Karakter }}</td>
              <td>
              {{ $results->BirimFiyat }}
              </td>
              <td>{{ $results->isimSoyisim }}</td>
              <td>{{ $results->TercumanTakipNot}}</td>
       		</tr>
     @endforeach
      @else
     <tr>
        <td colspan="5" style="text-align: center;">Aradığınız Sonuç Bulunamadı!</td>
      </tr>
      @endif
     </tbody>
   </table>


@endsection