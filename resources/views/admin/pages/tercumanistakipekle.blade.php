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


<form  id="teklifform" name="teklifform" action="{{ route('tercumanformistakipekle') }}"class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
<div class=" col-md-6 col-md-offset-3" style="padding-top:40px; padding-bottom: 50px;">

<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<legend>Tercuman İş Takip Ekle</legend>
    
        <div class="col-md-12  form-group">
           <label class="control-label">Tercuman İsmi</label>
              <select name="tercumanismi" class="form-control">
                @foreach($tercumanlist as $tercumanlist1)
                  <option value="{{ $tercumanlist1->isimSoyisim  }}">{{ $tercumanlist1->isimSoyisim  }}</option>
                 @endforeach 
              </select>
        </div>
       
        <div class="col-md-12  form-group">
         <label class="control-label" for="BirimFiyat">Birim Fiyat  </label>  
            <input required="true" id="BirimFiyats" name="BirimFiyat" type="number" placeholder="Birim Fiyat Giriniz" class="sayi form-control input-md">
          
        </div>
      
        
                                           
        
                                       <div class="row" >
                                        <div class="col-md-12">
                                              <div class="form-group">
                                              <label class=" control-label" for="tarih">Evrak Alma Tarihi <star>*</star></label>  
                                              <div class='input-group date'>
                                                  <input id="tarih" required="true" placeholder="Evrak Tarihi Giriniz" name='EvrakAlmaTarihi' type='text' class="datetimepicker form-control" />
                                                  <label for="tarih" class="input-group-addon">
                                                      <span class="fa fa-calendar"></span>
                                                  </label>
                                              </div>
                                              </div>
                                           </div>
                                        </div>
                                    
        

        <div class="col-md-12  form-group">
         <label class="control-label" for="ProjeAdi">Proje Adı </label>  
             <input required="true" id="AdSoyad" name="ProjeAdi" type="text" placeholder="Proje Adı Giriniz" class="form-control input-md">
        </div>

       <div class="col-md-12  form-group">
            <label class="control-label" for="Karakter">Karakter </label>  
            <input required="true" id="Karakters" name="Karakter" type="number" placeholder="Karakter Sayısını Giriniz" class=" form-control input-md">
       </div>


       <div class="col-md-12  form-group">
         <label class="control-label" for="KaynakDil">Kaynak Dil</label>
                 <select name="KaynakDil" class="form-control">
                @foreach($diller as $dillers)
                  <option value="{{ $dillers->DilAdi  }}">{{ $dillers->DilAdi  }}</option>
                 @endforeach 
              </select>
       </div>

      <div class="col-md-12  form-group">
         <label class="control-label" for="HedefDil">Hedef Dil  </label>
            <select name="HedefDil" class="form-control">
                @foreach($diller as $dillers)
                  <option value="{{ $dillers->DilAdi  }}">{{ $dillers->DilAdi  }}</option>
                 @endforeach 
              </select>
              
       </div>

   {{--       
         <div class="col-md-12 form-group">
            <label class=" control-label" for="GonderenYer">Gönderen Yer </label>
            <select required="true" id="GonderenYer" name="GonderenYer" class="form-control">
                    @foreach($subeler as $subelers)
                          <option value="{{ $subelers->name  }}">{{ $subelers->name  }}</option>
                        @endforeach 
              </select>
            </select>
        </div> --}}


    {{--     <div class="col-md-12 form-group">
            <label class=" control-label" for="Temsilci">Temsilci</label>
               <select name="Temsilci" class="form-control">
                @foreach($temsilci as $temsilcis)
                  <option value="{{ $temsilcis->id  }}">{{ $temsilcis->isimSoyisim  }}</option>
                 @endforeach 
              </select>
  
       </div> --}}


       <div class="col-md-12  form-group">
         <label class="control-label" for="TercumanTakipNot">Proje Hakkında Not Ekle  </label>
        
          <textarea type="text" name="TercumanTakipNot" id="TercumanTakipNot" rows="4" class="form-control input-md" placeholder="" tabindex="7"></textarea>
        
       </div>

       <div class="col-md-12" style="">
               <button type="submit" name="kayit" class="btn btn-warning btn-fill btn-wd">Kaydet</button>
       </div>

    </div>
</form>


 @endsection