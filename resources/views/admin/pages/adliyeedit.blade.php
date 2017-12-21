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


<form  id="teklifform" name="teklifform" action="{{ route('adliyeupdate',$adliyedata->id) }}"class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
<div class=" col-md-6 col-md-offset-3" style="padding-top:40px; padding-bottom: 50px;">

<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<legend>Adliye İş Takip Ekle</legend>
    
  
        
           <div class="row" >
              <div class="col-md-12">
            <div class="form-group">
            <label class=" control-label" for="tarih">Evrak Alma Tarihi <star>*</star></label>  
            <div class='input-group date'>
        <input id="tarih" value="{{ $adliyedata->EvrakAlmaTarihi }}" required="true" placeholder="Evrak Tarihi Giriniz" name='EvrakAlmaTarihi' type='text' class="datetimepicker form-control" />
                <label for="tarih" class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </label>
                </div>
              </div>
              </div>
          </div>
          <div class="row" >
              <div class="col-md-12">
            <div class="form-group">
            <label class=" control-label" for="tarih">Evrak Teslim Tarihi <star>*</star></label>  
            <div class='input-group date'>
        <input id="tarih" value="{{ $adliyedata->EvrakTeslimTarihi }}" required="true" placeholder="Evrak Tarihi Giriniz" name='EvrakTeslimTarihi' type='text' class="datetimepicker form-control" />
                <label for="tarih" class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </label>
                </div>
              </div>
              </div>
          </div>

  <div class="row">
        <div class="col-md-6  form-group">
         <label class="control-label" for="ProjeAdi">Mahkeme Numarası</label>  
             <input required="true" value="{{ $adliyedata->MahkemeNo }}" id="AdSoyad" name="MahkemeNo" type="number" placeholder="Mahkeme Numarasını Giriniz" class="form-control input-md" required="">
        </div>

       <div class="col-md-6  form-group">
            <label class="control-label" for="Karakter">Mahkeme Seçiniz</label>  
              <select name="MahkemeID" class="form-control">
                @foreach($mahkemeler as $mahkemelers)
                  <option value="{{ $mahkemelers->id  }}">{{ $mahkemelers->MahkemeAdi  }}</option>
                 @endforeach 
              </select>
       </div>

</div>


          <div class="col-md-12  form-group">
         <label class="control-label" for="ProjeAdi">Esas No</label>  
          <input required="true" id="AdSoyad" value="{{$adliyedata->EsasNo}}" name="EsasNo" type="text" placeholder="Esas Numarasını Giriniz" class="form-control input-md" required="">
        </div>

<div class="row">
       <div class="col-md-6  form-group">
         <label class="control-label" for="KaynakDil">Kaynak Dil</label>
                 <select name="KaynakDil" class="form-control">
                @foreach($diller as $dillers)
                  <option @if($adliyedata->KaynakDil ==$dillers->DilAdi ) selected @endif  value="{{ $dillers->DilAdi  }}">{{ $dillers->DilAdi  }}</option>
                 @endforeach 
              </select>
       </div>

      <div class="col-md-6  form-group">
         <label class="control-label" for="HedefDil">Hedef Dil  </label>
            <select name="HedefDil" class="form-control">
                @foreach($diller as $dillers)
                  <option @if($adliyedata->HedefDil ==$dillers->DilAdi ) selected @endif  value="{{ $dillers->DilAdi  }}">{{ $dillers->DilAdi  }}</option>
                 @endforeach 
              </select>
              
       </div>

</div>
        <div class="col-md-12  form-group">
         <label class="control-label" for="ProjeAdi">Talep Edilen Fiyat</label>  
          <input required="true" value="{{ $adliyedata->TalepEdilenFiyat }}" id="AdSoyad" name="TalepEdilenFiyat" type="number" placeholder="Esas Numarasını Giriniz" class="form-control input-md" >
        </div>
           <div class="col-md-12  form-group">
         <label class="control-label" for="ProjeAdi">Alınan Ödeme</label>  
          <input required="true" value="{{ $adliyedata->AlinanOdeme }}" id="AdSoyad" name="AlinanOdeme" type="number" placeholder="Esas Numarasını Giriniz" class="form-control input-md" >
        </div>
   <div class="col-md-12 form-group">
            <label class=" control-label" for="Temsilci">İlgili Kişi</label>
               <select name="TemsilciID" class="form-control">
                @foreach($temsilci as $temsilcis)
                  <option @if($temsilcis->id ==$adliyedata->TemsilciID ) selected @endif  value="{{ $temsilcis->id  }}">{{ $temsilcis->isimSoyisim  }}</option>
                 @endforeach 
              </select>
  
       </div> 


       <div class="col-md-12  form-group">
         <label class="control-label" for="TercumanTakipNot">Temsilci Not Ekle</label>
        
          <textarea type="text" name="TemsilciNot" id="TercumanTakipNot" rows="4" class="form-control input-md" placeholder="" tabindex="7">
            {{ $adliyedata->TemsilciNot }}
          </textarea>
        
       </div>

       <div class="col-md-12" style="">
               <button type="submit" name="kayit" class="btn btn-warning btn-fill btn-wd">Kaydet</button>
       </div>

    </div>
</form>


 @endsection