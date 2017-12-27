@extends('admin.master.master')


@section('content')




  <form action="{{ route('lksara')  }}" method="POST">
    {{ csrf_field() }}

    
  
   <div class="form-group">
    <label for="exampleFormControlSelect1">Diller</label>
    <select class="form-control" id="exampleFormControlSelect1" name="dil3">
      @foreach($diller as $dillers)
        <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
      @endforeach
    </select>
  </div>


  <select name="temsilci3" class="form-control col-md-3">
  	<label for="exampleFormControlSelect1">Temsilciler</label>
      @foreach($temsilci as $temsilcis)
      	<option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
      @endforeach
 
  </select>

<input type="submit" class="btn btn-success" value="Ara">

</form>







 <table class="table table-striped">
     <thead>
       <tr>
         <th>ID</th>
         <th>LKS EKLENME TARİHİ</th>
         <th> TERCUMAN İSİM SOYİSİM</th>
         <th>PROJE ADI</th>
         <th>DİL</th>
         <th>KARAKTER</th>
         <th>BİRİM FİYAT</th>
         <th>TEMSİLCİ VE ŞUBEID</th>
         <th>PROJE NOT</th>



       </tr>
     </thead>
     <tbody>



       @foreach ($lksekle as $lksekles)

	       	<tr>
		         <td>{{ $lksekles->id }}</td>
		         <td>{{ $lksekles->OnayTarihi }}</td>
		         <td>{{ $lksekles->TercumanAdi }}</td>
		         <td>{{ $lksekles->ProjeAdi }}</td>
		         <td>
              {{ $lksekles->KaynakDil }}></br>{{ $lksekles->HedefDil }}
             </td>

              <td>{{ $lksekles->Karakter }}TL</td>
		         <td>{{ $lksekles->BirimFiyat }}TL</td>
		            
		      
		         <td>{{ $lksekles->temsilci['isimSoyisim'] }}</br>{{ $lksekles->SubeID }} </td>
		         <td>{{ $lksekles->TercumanTakipNot}}  </td>

	




       		</tr>
     @endforeach
     </tbody>
   </table>





@endsection