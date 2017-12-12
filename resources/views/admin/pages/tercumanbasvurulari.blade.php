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

  <table class="table table-striped">
     <thead>
       <tr>
         <th>Başvuru Tarihi</th>
         <th>Başvuru Amacı</th>
         <th>İSİM SOYİSİM</th>
         <th>E-POSTA</th>
         <th>TELEFON</th>
         <th>ÇEVİRİ YAPTIĞI DİL</th>
         <th>ÇEVİRİ TÜRÜ</th>
         <th>LOKASYON</th>
         <th>İŞLEMLER</th>



       </tr>
     </thead>
     <tbody>



       @foreach ($tercuman as $tercumans)

	       	<tr>
		         <td>{{ $tercumans->BasvuruTarihi }}</td>
		         <td>{{ $tercumans->BasvuruAmaci }}</td>
		         <td>{{ mb_strtoupper($tercumans->isimSoyisim) }}</td>
		         <td>{{ $tercumans->Mail}}  </td>
		         <td>{{ $tercumans->Telefon}}  </td>

		         <td>
		            @foreach($tercumans->tercumandilbilgileri as $data) {{ $data->KaynakDil}}>{{$data->HedefDil}}={{ $data->BirimFiyat }}TL</br> @endforeach
		         </td>
		         <td>@foreach($tercumans->tercumandilbilgileri as $data) {{ $data->tercume_turu}}</br>  @endforeach </td>
		         <td> {{ mb_strtoupper($tercumans->Locasyon)}} </td>
		         <td>
		         	<a href="{{ route('tercumanbasvurusil',['id'=>$tercumans->id]) }}" class="btn btn-danger">SİL</a>
		         	<a href="#myModal" data-toggle="modal" id="{{ $tercumans->id }}" data-target="#edit-modal4">ONAYLA</a>
		         </td>

	




       		</tr>
     @endforeach
     </tbody>
   </table>

{{ $tercuman->links() }}




<div id="edit-modal4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Devam Eden Tekliflere Ekle</h4>
               </div>
<form action="{{ route('tercumanbasvuruonayla') }}" method="POST"/>
{{ csrf_field() }}
           
           	<h3>Tercuman Basvuruyu Onaylamak İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="basvuruonay" id="basvuruonay" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Tercumanı Onayla</button>
               </div>

</form>

           </div>
       </div>
</div>









	



@endsection