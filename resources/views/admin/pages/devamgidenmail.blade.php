@extends('admin.master.master')

@section('content')


    <div class="form-group">
      <label for="exampleInputEmail1">Teklif Verilen Tarih</label>
      <input type="text" class="form-control"  value="{{ $maildetay->TeklifVerilenTarih }}" name="isimSoyisim" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Müşteri Adı</label>
      <input type="text" class="form-control" value="{{ $maildetay->isimSoyisim   }}"  name="Telefon" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-POSTA</label>
      <input type="email" class="form-control" value="{{  $maildetay->Email  }}"   name="Email" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Telefon</label>
      <input type="text" class="form-control"  value="{{ $maildetay->Telefon }}" name="KaynakDil" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Teklif Veren Temsilci</label>
      <input type="text" class="form-control"  value="{{ $maildetay->temsilci['isimSoyisim'] }}"  name="HedefDil" readonly="">
    </div>
 

 <div class="form-group">
      <label for="exampleInputPassword1">NOT EKLE</label>
    <textarea name="" class="form-control" readonly="">
      
      {{ $maildetay->TemsilciGelenTeklifNot }}


    </textarea>

​</div>



<a href="{{ url('/') }}" role="button" class="btn btn-danger readonly=""">Geri Dön</button>


@endsection
