@extends('layouts.app')

@section('content')


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="../../assets/img/full-screen-image-1.jpg">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="POST" action="{{ route('login')}}">
                       {{ csrf_field() }}
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card card-hidden">
                                <div class="header text-center">Giriş Ekranı</div>
                                <div class="content">
                                  <div class="form-group">
                                      <label for="exampleFormControlSelect1">ŞUBE SEÇİNİZ</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="sube">
                                          <option value="1">MERKEZ</option>
                                          <option value="2">KARTAL</option>
                                          <option>ATAŞEHİR</option>
                                          <option>MALTEPE</option>
                                          <option>KADIKÖY</option>
                                        </select>
                                      </div>


                                    <div class="form-group">
                                        <label>Email Adresiniz</label>
                                        <input type="email" placeholder="E-mail Adresiniz" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Şifreniz</label>
                                        <input type="password" placeholder="Şifreniz" class="form-control"name="password">
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-fill btn-warning btn-wd">Giriş Yap</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
