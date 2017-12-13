@extends('admin.master.master')


@section('content')


  <div class="content">
      <div class="container-fluid">
          <div class="card row">

         <form method="POST" action="{{ route('tercumanguncelle',['id'=>$tercumand->id]) }}">
           {{ csrf_field() }}
      <div class="container" style="padding-top:40px; padding-bottom: 50px;">
          <section>
              <div class="row">
                  <legend>YENİ TERCÜMAN EKLE</legend>

                  <div class="row">
                         <div class="col-md-12 form-group">
                       <label class=" control-label" for="adsoyad">Tercüman Adı Soyadı <span class="red">*</span></label>
                       <div class="">
                             <input name="isimSoyisim" type="text" value="{{ $tercumand->isimSoyisim }}" class="form-control input-md" >
                       </div>
                     </div>

                  </div>

                  <div class="row">
                       <div class="col-md-12 form-group">
                       <label class=" control-label" for="email">E-Posta Adresi <span class="red">*</span></label>
                       <div class="">
                             <input id="email" name="Email" type="email" value="{{ $tercumand->Mail }}" class="form-control input-md" >
                       </div>
                     </div>
                  </div>




                  <div class="row">
                         <div class="col-md-12 form-group">
                       <label class=" control-label" for="ceptelefon"> Telefon Numarası <span class="red">*</span></label>
                       <div class="">
                             <input  id="ceptelefon" name="Telefon" type="number" value="{{ $tercumand->Telefon }}"  class="form-control input-md" >
                       </div>
                     </div>
                  </div>




                  <div class="row">
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="Lokasyon">Lokasyon<span class="red">*</span></label>
                        <div class="">
                              <input id="Lokasyon" name="Lokasyon" type="text" value="{{ $tercumand->Locasyon }}" class="form-control input-md" >
                        </div>
                     </div>
                 </div>


                   <div class="row">
                      <div class="col-md-12 form-group">
                          <label>Hesap Sahibi Giriniz</label>
                          <input id="HesapSahibi" name="HesapSahibi" type="text" value="{{ $tercumand->Hesapsahibi }}" class=" form-control">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12 form-group">
                          <label>IBAN Numarası Giriniz</label>
                          <input id="ibanno" name="ibanno" type="text" value="{{ $tercumand->ibanno }}" class=" form-control">
                      </div>
                  </div>

                   <div class="row">
                  <div class="col-md-12 form-group">
                     <label>TERCÜMAN HAKKINDA KISACA BİLGİ</label>
                     <textarea  id="TemsilciNot" name="TemsilciNot" type="text"  class=" form-control">{{ $tercumand->temsilciNot }}</textarea>
                  </div>
              </div>



          </div>

      </section>



      <section>
          <div class="row">

             <legend>DİL EKLE</legend>


             <div class="row" style="padding-top:50px;">
                  <div class="col-md-12 form-group">
                    <label class=" control-label" for="">Tercüme Türü Seçiniz</label>
                    <div class="">
                    <select id="TercumeTuru" name="TercumeTuru" class="form-control" >
                                <option value="0">Yazılı Tercüme</option>
                                <option value="1">Sözlü Tercüme</option>
                          </select>
                    </div>
                    </div>
                  </div>
              </div>

              <div class="row">
                 <div class="col-md-12 form-group">
                     <div class="form-group" style="margin:0;">
                         <label class="control-label" for="kaynakdil">Kaynak Dil </label>

                         <select id="kaynakdil" name="kaynakdil" class="form-control" >

                           @foreach($diller as $dillers)
                            <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
                           @endforeach

                         </select>

                      </div>
                  </div>

                  <div class="col-md-12 form-group">

                      <label class="control-label" for="hedefdil">Hedef Dil </label>
                  <select id="hedefdil" name="hedefdil" class="form-control" >

                    @foreach($diller as $dillers)
                     <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
                    @endforeach

                  </select>

                  </div>


                  <div class="col-md-12 form-group">
                      <div class="form-group">
                      <label class="control-label" for="adsoyad"> Birim Fiyat </label>
                      <div class="">
                            <input ="true" id="KarakterFiyati" name="birimfiyat" type="number" placeholder="Fiyat" class="sayi form-control input-md" >
                      </div>
                    </div>
                  </div>

                   <div class="col-md-12 " role="alert">
                  <div style="font-size:20px;" class="form-group alert alert-danger">
                          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Dil Bilgisini girdikten sonra "DİL EKLE" butonuna basmanız gerekiyor. Eklediğiniz dili aşağıdaki tabloda görüyorsanız dil eklenmiştir.Daha sonra "BİLGİLERİ KAYDET" butonuna basarak işleminizi sonlandırın.

                  </div>
              </div>


                  <div class="col-md-12 form-group">
                     <div class=" text-left">
                         <a id="dilekle" class="btn btn-md btn-wd btn-fill btn-warning"><i class="fa fa-plus "></i> Dil Ekle   <br> </a>
                         <button id="submit" name="submit" role="submit" class="btn btn-md btn-fill btn-wd btn-success"> Bilgileri Güncelle</button>
                     </div>
                 </div>

              </div>

            <div style="margin:40px 0px;"><legend>EKLENEN DİLLER</legend></div>

              <div class="row">
                  <div class="col-xs-12">
                      <div class="fresh-datatables">
                          <table id="diltablosu" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                              <thead>

                                      <tr>
                                      <th>Kaynak Dil</th>
                                      <th>Hedef Dil</th>
                                      <th>BİRİM FİYAT</th>
                                      <th>TERCÜME TÜRÜ </th>
                                      <th>İşlem</th>
                              </tr></thead>
                            <tbody>
                              @foreach($tercumand->tercumandilbilgileri as $tercumandd)
                                <tr>
                                  <td>{{ $tercumandd->KaynakDil}}</td>
                                  <td>{{ $tercumandd->HedefDil }}</td>
                                  <td>{{ $tercumandd->BirimFiyat }}</td>
                                  <td>@if($tercumandd->tercume_turu==0) Yazılı Tercume @else ($tercumandd->tercume_turu==1) Sözlü Tercume @endif </td>
                                  <td>
                                    <a href="{{ url('/dilsil/'.$tercumandd->id) }}" class="btn btn-danger">SİL</a>
                                  </td>

                                </tr>
                              @endforeach

                          </tbody>
                          </table>
                      </div>
                  </div>
              </div>


          </div>

      </section>



      </div>


  </form>


         </div>
      </div>
  </div>


  <script>
      $("#dilekle").click(function(){
          var kaynakdil = $("[name='kaynakdil']").val();
          var hedefdil = $("[name='hedefdil']").val();
          var karakterFiyati = $("[name='birimfiyat']").val();
          var tercumeTuru = $("[name='TercumeTuru']").val();



          if(kaynakdil == "" || hedefdil == "") return;

          var appendText = '<tr data-new="true"><td><input type="hidden" id="kaynakdil" name="kaynakdil1" value="'+kaynakdil+'">'+kaynakdil+'</td><td><input type="hidden" id="hedefdil" name="hedefdil1" value="'+hedefdil+'">'+hedefdil+'</td><td><input type="hidden" id="birimfiyat" name="birimfiyat1" value="'+karakterFiyati+'">'+karakterFiyati+' TL</td><td><input type="hidden" id="tercumeturu" name="tercumeturu1" value="'+tercumeTuru+'">'+$("[name='TercumeTuru'] option:selected").text()+'</td><td class="td-actions text-left"><a id="dilsil" rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action view" data-original-title="Sil">SİL<i class="fa fa-remove"></i></a></td></tr>';
          $("#diltablosu tbody").append(appendText);

          tabloDuzenle();
      });

      $(document).ready(function(){
          $(document).on("click","#diltablosu tbody #dilsil",function(){
              $(this).parent().parent().remove();
              tabloDuzenle();
          });
      });

      function tabloDuzenle(){
        
          $("#diltablosu tr").each(function(){
              var index = $(this).index();

              $(this).find("#kaynakdil").attr("name","kaynakdil"+index);
              $(this).find("#hedefdil").attr("name","hedefdil"+index);
              $(this).find("#birimfiyat").attr("name","birimfiyat"+index);
              $(this).find("#tercumeturu").attr("name","tercumeturu"+index);

          });
      }



  </script>




@endsection
