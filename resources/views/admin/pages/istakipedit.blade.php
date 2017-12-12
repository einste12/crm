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


  <form action="{{route('istakipupdate',$istakip->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">Tarih</label>
      <input type="datetime" class="form-control"  value="{{ $istakip->EklenmeTarih }}" name="EklenmeTarih">
    </div>
      <div class="form-group">
     <label class=" control-label">Tercuman Seçiniz </label>
      <select class="form-control" name="TercumanAdi">
        @foreach($tercuman as $tercumans)
          <option value="{{ $tercumans->isimSoyisim }}">{{ $tercumans->isimSoyisim }}</option>
        @endforeach
     </select>
   </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Proje Adi</label>
      <input type="textarea" class="form-control"  value="{{ $istakip->ProjeAdi }}" name="ProjeAdi">
    </div>
   <div class="form-group">
    <label class=" control-label">Kaynak Dil</label>
     <select class="form-control" name="KaynakDil">
     
        @foreach($diller as $dillers)
          <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
        @endforeach
     </select>
   </div>
   <div class="form-group"> 
    <label class=" control-label">Hedef Dil</label>
     <select class="form-control" name="HedefDil">
        @foreach($diller as $dillers)
          <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
        @endforeach
     </select>
   </div>
     <div class="form-group">
      <label for="exampleInputPassword1">Gönderen Yer</label>
     <select class="form-control" name="SubeID">
        @foreach($subeler as $subelers)
          <option value="{{ $subelers->name }}">{{ $subelers->name }}</option>
        @endforeach
     </select>   
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Temsilci</label>
    <select class="form-control" name="TemsilciID">
        @foreach($temsilci as $temsilcis)
          <option value="{{ $temsilcis->isimSoyisim }}">{{ $temsilcis->isimSoyisim }}</option>
        @endforeach
     </select>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Karakter</label>
      <input type="text" class="form-control"  value="{{ $istakip->Karakter }}"  name="Karakter">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Birim Fiyat</label>
      <input type="text" class="form-control"  value="{{ $istakip->BirimFiyat }}"  name="BirimFiyat">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Not Ekle</label>
      <input type="textarea" class="form-control"  value="{{ $istakip->TercumanTakipNot }}" name="TercumanTakipNot">
    </div>
 

    <button type="submit" class="btn btn-success">GÜNCELLE</button>
  </form>






@endsection
