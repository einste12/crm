@extends('admin.master.master')

@section('content')

  @if(Session::has('message'))
        <div class="row">
          <div class="col-md-12">
           <div class="alert alert-success text-center"> {{ Session::get('message') }}</div>
          </div>
        </div>
  @endif


  <form action="{{route('tamamlananupdate',$teklif->id)}}" method="POST">
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
        <label for="exampleFormControlSelect1">Kaynak Dil</label>
          <select class="form-control" id="exampleFormControlSelect1" name="KaynakDil">
            @foreach($diller as $dillers)
            <option @if($teklif->KaynakDil ==$dillers->DilAdi ) selected @endif value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
           @endforeach
          </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">HedefDil</label>
          <select class="form-control" id="exampleFormControlSelect1" name="HedefDil">
            @foreach($diller as $dillers)
            <option @if($teklif->HedefDil ==$dillers->DilAdi ) selected @endif value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
           @endforeach
          </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kapora</label>
      <input type="text" class="form-control"  value="{{ $teklif->Kapora }}"  name="Kapora">
    </div>
    <div class="form-group">
     <label class=" control-label">Noter Tasdiki </label>
      <select  name="TastikSekli" class="form-control">
       <option @if($teklif->TastikSekli == 1) selected @endif  value="1"> Yeminli Tercüme</option>
       <option @if($teklif->TastikSekli == 2) selected @endif  value="2"> Noter Yeminli Tercüme</option>
       <option @if($teklif->TastikSekli == 3) selected @endif  value="3"> Apostil Tasdikli Tercüme</option>
     </select>
   </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Müşteri Talebi</label>
      <input type="text" class="form-control"  value="{{ $teklif->MusteriTalebi }}" name="MusteriTalebi">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">ONAY VEREN TEMSİLCİ</label>
          <select class="form-control" id="exampleFormControlSelect1" name="TercumanID">
            @foreach($temsilci as $temsilcis)
            <option @if($teklif->TeklifVerenTemsilci ==$temsilcis->id ) selected @endif value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
           @endforeach
          </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Fiyat</label>
      <input type="text" class="form-control"  value="{{ $teklif->Fiyat }}" name="Fiyat">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Temsilci Gelen Not</label>
      <input type="text" class="form-control"  value="{{ $teklif->TemsilciGelenTeklifNot }}"  name="TemsilciGelenTeklifNot">
    </div>


    <button type="submit" class="btn btn-success">GÜNCELLE</button>
  </form>






@endsection
