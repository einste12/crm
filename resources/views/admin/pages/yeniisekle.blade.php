@extends('admin.master.master')

@section('content')


    @if(Session::has('message'))
          <div class="row">
            <div class="col-md-12">
             <div class="alert alert-success text-center"> {{ Session::get('message') }}</div>
            </div>
          </div>
    @endif


   <div class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="card">

                                  <div class="content">

                                       <legend>Yeni Müşteri Ekle </legend>



                                       <form action="{{ route('isekle') }}" method="POST">
                                         {{ csrf_field() }}
                                       <div class="row">
                                           <div class="col-md-12 form-group">
                                                      <label class=" control-label">Evrak Alma Tarihi </label>
                                                      <input type="date" name="GelenTeklifTarihi" class="form-control datetimepicker" placeholder="Tarih Seçiniz"/>
                                              </div>
                                       </div>



                                       <div class="row">

                                             <div class="col-md-12 form-group">
                                                      <label class=" control-label">Müşteri Nereden Geldi? </label>
                                                      <div class="">
                                                              <select id="musterituru" name="NeredenGeldi" class="form-control">
                                                                      <option value="1">İnternet</option>
                                                                      <option value="2">Sürekli Olan</option>
                                                                      <option value="3"> Referans-Tavsiye</option>
                                                                      <option value="4"> Noter Yönlendirmesi</option>
                                                              </select>
                                                      </div>
                                              </div>
                                       </div>


                                       <div class="row">

                                           <div class="col-md-12 form-group">
                                            <label class=" control-label" for="AdSoyad">Müşteri Adı </label>
                                            <div class="">
                                                  <input  required="true"  id="AdSoyad" name="isimSoyisim" type="text" placeholder="Müşteri  Adını Giriniz" class="form-control input-md">
                                            </div>
                                          </div>
                                        </div>
                                          <div class="row">
                                          <div class="col-md-12 form-group">
                                            <label class=" control-label" for="Telefon">Telefon  </label>
                                            <div class="">
                                                  <input  type="text"  maxlength="25" name="Telefon" id="Telefon" class="form-control input-md" placeholder="Telefon Giriniz " >
                                            </div>
                                          </div>
                                          </div>
                                          <div class="row">
                                         <div class="col-md-12 form-group">
                                            <label class=" control-label" for="Eposta">Email  </label>
                                            <div class="">
                                             <input type="email" name="Email" id="Eposta" class="form-control input-md" placeholder="Email Giriniz">
                                            </div>
                                          </div>
                                        </div>



                                       <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class=" control-label" for="KaynakDil">Kaynak Dil </label>
                                            <div class="">

                                              <select id="KaynakDil" name="KaynakDil" class="form-control">
                                                    @foreach ($diller as $dillers)
                                                      <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi  }}</option>
                                                    @endforeach
                                                  </select>

                                            </div>
                                          </div>
                                          <div class="col-md-6 form-group">
                                            <label class=" control-label" for="HedefDil">Hedef Dil </label>
                                            <div class="">


                                    <select id="temsilci" name="HedefDil" class="form-control">
                                          @foreach ($diller as $dillers)
                                            <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi  }}</option>
                                                @endforeach
                                        </select>



                                            </div>
                                          </div>

                                       </div>



                                       <div class="row">
                                           <div class="col-md-6 form-group">
                                              <label class=" control-label" for="Fiyat">Toplam Fiyat  </label>
                                              <div class="">
                                               <input type="text" name="Fiyat" id="Fiyat" class="form-control input-md" placeholder="..TL">
                                              </div>
                                            </div>

                                           <div class="col-md-6 form-group">
                                              <label class=" control-label" for="Kaparo">Kapora </label> <br />

                                                    <input type="text" class="form-control input-md" name="Kapora"/>

                                            </div>


                                       </div>



                                       <div class="row">
                                             <div class="col-md-12 form-group">
                                            <label class=" control-label" for="Tercuman">Tercuman </label>
                                            <div class="">
                                             <input type="text" name="TercumanID" id="Tercuman" class="form-control input-md" placeholder="">
                                            </div>
                                          </div>
                                       </div>



                                       <div class="row">
                                             <div class="col-md-6 form-group">
                                                  <label class=" control-label">Tastik Sekli</label>
                                                   <select id="TastikSekli" name="TastikSekli" class="form-control">
                                                          <option value="1"> Yeminli Tercume</option>
                                                          <option value="2"> Noter Tasdikli Tercume</option>
                                                          <option value="3"> Apostil Tasdikli Tercume</option>
                                                  </select>
                                          </div>



                                             <div class="col-md-6 form-group">
                                                  <label class=" control-label">Onay Durumu</label>
                                                   <select id="TastikSekli" name="OnayDurumu" class="form-control">
                                                          <option value="1">Onay Bekleyen İşlere Ekle</option>
                                                          <option value="2">Devam Eden İşlere Ekle</option>
                                                          <option value="3">Tamamlanan İşlere Ekle</option>
                                                  </select>
                                          </div>
                                       </div>
                                          <div class="col-md-12 form-group">
                                                  <label class=" control-label">Şubeler</label>

                                                  <select id="SubeID" name="SubeID" class="form-control">
                                                      @foreach ($subeler as $subelers)

                                                      <option value="{{ $subelers->id  }}">{{ $subelers->name  }}</option>

                                                      @endforeach



                                                  </select>

                                          </div>



                                       <div class="row">
                                            <div class="col-md-12 form-group">
                                                  <label class=" control-label">Temsilci </label>

                                                  <select id="temsilci" name="TeklifVerenTemsilci" class="form-control">
                                                      @foreach ($temsilci as $temsilcis)

                                                      <option value="{{ $temsilcis->isimSoyisim  }}">{{ $temsilcis->isimSoyisim  }}</option>

                                                      @endforeach



                                                  </select>

                                          </div>

                                       </div>

                                       <div class="row">
                                          <div class="col-md-12 form-group">
                                            <label class=" control-label" for="temsilcinot">BU MÜŞTERİ İÇİN NOT GİRMEK İSTER MİSİNİZ?</label>
                                            <div class="">
                                             <textarea type="text" name="TemsilciGelenTeklifNot" id="temsilcinot" class="form-control input-md" placeholder=""></textarea>
                                            </div>
                                          </div>
                                       </div>
                                 

                                  <div class="footer">
                                      <button type="submit" class="btn btn-success btn-fill pull-right">Kaydet</button>


                                      <div class="clearfix"></div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                   <div class="col-md-6">
                          <div class="card">
                              <form id="loginFormValidation" action="" method="" novalidate="">
                                  <div class="header text-center">Müşteri Önizlemesi</div>
                                  <div class="content">

                                       <div class="form-group"><strong>Evrak Alma Tarihi: </strong><span id="evrakalmatarihi"></span></div>

                                      <div class="form-group">Müşteri Adı: </strong><span id="madi"></span></div>
                                      <div class="form-group">Telefon: </strong><span id="tel"></span></div>
                                      <div class="form-group">E-Mail: </strong><span id="mail"></span></div>
                                      <div class="form-group">Kaynak Dil: </strong><span id="kaynakdil"></span></div>
                                      <div class="form-group">Hedef Diller: </strong><span id="hedefdil"></span></div>

                                      <div class="form-group">Toplam Fiyat: </strong><span id="fiyat"></span></div>
                                      <div class="form-group">Fatura: </strong><span id="fatura"></span></div>
                                      <div class="form-group">Kaparo: </strong><span id="kaparo"></span></div>
                                      <div class="form-group">Noter Tasdiki: </strong><span id="tastiksekli"></span></div>
                                      <div class="form-group">Sube ID: </strong><span id="subeid"></span></div>
                                      <div class="form-group">Temsilci: </strong><span id="temsilcionizleme"></span></div>
                                      <div class="form-group">Not: </strong><span id="not"></span></div>
                                      
                                  </div>


                              </form>
                          </div>
                      </div>


                  </div>

              </div>
          </div>











@endsection
