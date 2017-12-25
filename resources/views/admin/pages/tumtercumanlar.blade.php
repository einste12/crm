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




<div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>İD</th>
         <th>ADI VE SOYADI</th>
         <th>EPOSTA</th>
         <th>TELEFON</th>
         <th>ÇEVİRİ YAPTIĞI DİLLER</th>
         <th>TERCÜME TÜRÜ</th>
         <th>TEMSİLCİ NOT</th>
         <th>İŞLEMLER</th>



       </tr>
     </thead>
     <tbody>



       @foreach ($tercumanlist as $tercumans)

       <tr>
         <td>{{ $tercumans->id }}</td>
         <td>{{ $tercumans->isimSoyisim }}</td>
         <td>{{ $tercumans->Mail }}</td>
         <td>{{ $tercumans->Telefon}}  </td>
         <td>
            @foreach($tercumans->tercumandilbilgileri as $data) {{ $data->KaynakDil}}>{{$data->HedefDil}}={{ $data->BirimFiyat }}<br> @endforeach
         </td>
         <td>@foreach($tercumans->tercumandilbilgileri as $data) @if($data->tercume_turu==1) Var @else Yok @endif</br>  @endforeach </td>
         <td> {{$tercumans->temsilciNot}} </td>

    <td>
      <a href="#myModal" data-toggle="modal" id="{{ $tercumans->id }}" data-target="#edit-modal10">SİL</a>
      <a href="{{ route('tercumanduzenle',['id'=>$tercumans->id]) }}" class="btn btn-danger">DÜZENLE</a>
    </td>



       </tr>
     @endforeach
     </tbody>
   </table>
 </div>


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
