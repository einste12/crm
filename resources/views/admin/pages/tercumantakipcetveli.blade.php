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
         <th>ID</th>
         <th>EKLENME TARİHİ</th>
         <th>TERCUMAN</th>
         <th>PROJE ADI</th>
         <th>DİL</th>
         <th>KARAKTER</th>
         <th>BİRİM FİYAT</th>
         <th>TEMSİLCİ</th>
         <th>PROJE NOT</th>
         <th>İŞLEMLER</th>




       </tr>
     </thead>
     <tbody>



       @foreach ($tercumantakipcetveli as $tercumantakipcetvelis)

	       	<tr>
		         <td>{{ $tercumantakipcetvelis->id }}</td>
		         <td>{{ $tercumantakipcetvelis->EklenmeTarih }}</td>
		         <td>{{ $tercumantakipcetvelis->TercumanAdi }}</td>
		         <td>{{ $tercumantakipcetvelis->ProjeAdi }}</td>
		         <td>
              {{ $tercumantakipcetvelis->KaynakDil }}>{{ $tercumantakipcetvelis->HedefDil }}
             </td>

              <td>{{ $tercumantakipcetvelis->Karakter }}</td>
		         <td>{{ $tercumantakipcetvelis->BirimFiyat }}TL</td>
		            
		        
		         <td>{{ $tercumantakipcetvelis->temsilci['isimSoyisim'] }}</br>{{ $tercumantakipcetvelis->SubeID }} </td>
		         <td>{{ $tercumantakipcetvelis->TercumanTakipNot}}  </td>
		         <td>
		         	<a href="{{ route('tercumanistakipcetvelisil',['id'=>$tercumantakipcetvelis->id]) }}" class="btn btn-danger">SİL</a>
		         	<a href="#myModal" data-toggle="modal" id="{{ $tercumantakipcetvelis->id }}" data-target="#edit-modal5">ONAYLA</a>
              <a href="{{ route('tercumantakipduzenle',['id'=>$tercumantakipcetvelis->id]) }}" class="btn btn-danger">DÜZENLE</a>
		         </td>

	




       		</tr>
     @endforeach
     </tbody>
   </table>
 </div>






<div id="edit-modal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">LKS ye Ekle</h4>
               </div>
<form action="{{ route('lksekle') }}" method="POST"/>
{{ csrf_field() }}
           
           	<h3>LKS ye Eklemek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="lksonay" id="lksonay" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">LKS ye Ekle</button>
               </div>

</form>

           </div>
       </div>
</div>









	



@endsection