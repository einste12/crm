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


  <form action="{{route('onaybekleyenupdate',$teklif->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">İsim Ve Soyisim</label>
      <input type="text" class="form-control"  value="{{ $teklif->isimSoyisim }}" name="isimSoyisim">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Telefon</label>
      <input type="number" class="form-control" value="{{ $teklif->Telefon   }}"  name="Telefon">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-mail</label>
      <input type="email" class="form-control" value="{{  $teklif->Email  }}"   name="Email">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kaynak Dil</label>
        <select  name="KaynakDil" class="form-control">
            @foreach($diller as $dillers)
              <option  @if($teklif->HedefDil ==$dillers->DilAdi ) selected @endif value="{{ $dillers->id }}">{{ $dillers->DilAdi }}</option>
            @endforeach  
     </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Hedef Dil</label>
        <select  name="HedefDil" class="form-control">
            @foreach($diller as $dillers)
              <option @if($teklif->HedefDil ==$dillers->DilAdi ) selected @endif value="{{ $dillers->id }}">{{ $dillers->DilAdi }}</option>
            @endforeach  
        </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kapora</label>
      <input type="text" class="form-control"  value="{{ $teklif->Kapora }}"  name="Kapora">
    </div>
    <div class="form-group">
     <label class=" control-label">Tastik Şekli </label>
      <select  name="TastikSekli" class="form-control">
       <option @if($teklif->TastikSekli == 1) selected @endif  value="1"> Yeminli Tercüme</option>
       <option @if($teklif->TastikSekli == 2) selected @endif  value="2"> Noter Yeminli Tercüme</option>
       <option @if($teklif->TastikSekli == 3) selected @endif  value="3"> Apostil Tasdikli Tercüme</option>
     </select>
   </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Müşteri Talebi</label>
      <textarea  class="form-control"    name="MusteriTalebi">{{ $teklif->MusteriTalebi }}</textarea>
    </div>
  
    <div class="form-group">
      <label for="exampleInputEmail1">Fiyat</label>
      <input type="text" class="form-control"  value="{{ $teklif->Fiyat }}" name="Fiyat">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Temsilci Gelen Not</label>
      <textarea  class="form-control"    name="TemsilciGelenTeklifNot">{{ $teklif->TemsilciGelenTeklifNot }}</textarea>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tercuman ID</label>
      <input type="text" class="form-control"  value="{{ $teklif->tercuman['isimSoyisim'] }}"  name="TercumanID">
    </div>

    <button type="submit" class="btn btn-success">GÜNCELLE</button>
  </form>






@endsection
