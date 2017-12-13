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

    <input type="text" name="ara" class="form-control">
    

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
         <th>İSİM SOYİSİM</th>
         <th>E-MAİL</th>
         <th>TELEFON</th>
         <th>ÇEVİRİ YAPTIĞI DİL</th>
         <th>FİYAT</th>
         <th>İŞLEMLER</th>
         
       </tr>
     </thead>
     <tbody>


@if(count($result))
       @foreach ($result as $results)

	       	<tr>
		         
		         <td>{{ mb_strtoupper($results->isimSoyisim) }}</td>
             <td>{{ mb_strtoupper($results->Mail) }}</td>
             <td>{{ $results->Telefon }}</td>
		         <td>
		          {{$results->KaynakDil}}>{{$results->HedefDil}}</br>
	 	         </td>
               <td>
                
              {{ $results->tercume_turu }}

              </td>
              <td>
                
              {{ $results->temsilciNot}}

              </td>
              <td><a href="#myModal" data-toggle="modal" id="{{ $results->id }}" data-target="#edit-modal10">SİL</a></td>
       		</tr>
     @endforeach

     @else
     <tr>
        <td colspan="5" style="text-align: center;">Aradığınız Sonuç Bulunamadı!</td>
      </tr>
      @endif
     </tbody>
   </table>





<div id="edit-modal10" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Tercuman Sil</h4>
               </div>
<form action="{{ route('tercumansil') }}" method="POST"/>
{{ csrf_field() }}
           
            <h3>Seçilen Tercumanı Silmek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="tercumansil" id="tercumansil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Tercumanı Sil</button>
               </div>

</form>

           </div>
       </div>
</div>








@endsection