@extends('admin.master.master')

@section('content')

<p>İPTAL TEKLİF</p>

 
  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>İD</th>
         <th>İSİM SOYİSİM</th>
         <th>TELEFON</td>
         <th>MAİL</th>
         <th>KATEGORİ</th>
         <th>MESAJ</th>
         <th>NEDEN</th>
         <th>CEVAP</td>
         <th>TARİH</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($gb as $gbs)
       <tr>
         <td>{{ $gbs->id }}</td>
         <td>{{ $gbs->isimSoyisim }}</td>
         <td> {{$gbs->Telefon }}</td>
         <td>{{ $gbs->Mail }}</td>
         <td>{{ $gbs->Kategori }}</td>
         <td>{{ $gbs->Mesaj }}</td>
         <td>{{ $gbs->Neden }}</td>
         <td>{{ $gbs->Cevap }}</td>
         <td>{{ $gbs->Tarih }}</td>
       </tr>
       @endforeach
     </tbody>
   </table>
</div>






<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "ordering": false,
          "stateSave": true,  
          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              'excelHtml5',

          ],
          language: {
          search: "_INPUT_",
          searchPlaceholder: "Arama Yapınız",
          }


      });
        var table = $('#datatables').DataTable();     
      });

</script>



@endsection
