@extends('admin.master.master')

@section('content')

  @if(Session::has('message'))
        <div class="row">
          <div class="col-md-12">
           <div class="alert alert-success text-center"> {{ Session::get('message') }}</div>
          </div>
        </div>
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
      <input type="text" class="form-control"  value="{{ $teklif->KaynakDil }}" name="KaynakDil">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Hedef Dil</label>
      <input type="text" class="form-control"  value="{{ $teklif->HedefDil }}"  name="HedefDil">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kapora</label>
      <input type="text" class="form-control"  value="{{ $teklif->Kapora }}"  name="Kapora">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tastik Şekli</label>
      <input type="text" class="form-control"  value="{{ $teklif->TastikSekli }}" name="TastikSekli">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Müşteri Talebi</label>
      <input type="text" class="form-control"  value="{{ $teklif->MusteriTalebi }}" name="MusteriTalebi">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Teklif Veren Temsilci</label>
      <input type="text" class="form-control"  value="{{ $teklif->TeklifVerenTemsilci }}" name="TeklifVerenTemsilci">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Fiyat</label>
      <input type="text" class="form-control"  value="{{ $teklif->Fiyat }}" name="Fiyat">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Temsilci Gelen Not</label>
      <input type="text" class="form-control"  value="{{ $teklif->TemsilciGelenTeklifNot }}"  name="TemsilciGelenTeklifNot">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tercuman ID</label>
      <input type="text" class="form-control"  value="{{ $teklif->TercumanID }}"  name="TercumanID">
    </div>

    <button type="submit" class="btn btn-success">GÜNCELLE</button>
  </form>






@endsection
