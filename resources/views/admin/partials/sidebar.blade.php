<div class="sidebar" data-color="orange" data-image="">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="" class="logo-text">
           İş Takip Sistemi V4.0
        </a>
    </div>
<div class="logo logo-mini">
  <a href="" class="logo-text">
    Ct
  </a>
</div>

  <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('img/avatar.jpg')  }}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ Auth::user()->name }}

                </a>
                  <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ Auth::user()->subeler->last()->name }}

                  </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li><a href="#">My Profile</a></li>
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="{{ route('logout') }}">Çıkış Yap</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            <li class="active">
              <a href="{{ route('yeniisekle') }}">
                  
                  <i class="fa fa-plus" aria-hidden="true"></i><p>YENİ İŞ EKLE</p>
              </a>
             </li>
             <li> 
                <a href="{{ route('dashboard') }}">
                    
                    <i class="fa fa-commenting-o" aria-hidden="true"></i><p>GELEN TEKLİFLER</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    
                    <i class="fa fa-list-ul" aria-hidden="true"></i><p>Teklifler
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li><a href="{{ route('onaybekleyen')}}">Onay Bekleyen Teklifler</a></li>
                        <li><a href="{{ route('devameden') }}">Devam Eden Teklifler</a></li>
                        <li><a href="{{ route('tamamlanan') }}">Tamamlanan Teklifler</a></li>
                        <li><a href="{{ route('iptalteklif') }}">İptal Edilen Teklifler</a></li>
                        
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples1">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-o" aria-hidden="true"></i><p>TERCUMANLAR
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples1">
                    <ul class="nav">
                        <li><a href="{{ route('tercumanekle') }}">Yeni Tercuman Ekle</a></li>
                        <li><a href="{{ route('tercumanbasvurulari') }}">Tercuman Başvuruları</a></li>
                        <li><a href="{{ route('tercumanmaliyet')}}">Tercuman Maliyet Tablosu</a></li>
                        <li><a href="{{ route('tumtercumanlar') }}">Tüm Tercumanlar</a></li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples2">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i><p>TERCUMAN TAKİP
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples2">
                    <ul class="nav">
                        <li><a href="{{ route('tercumanistakipekle') }}">YENİ EKLE</a></li>
                        <li><a href="{{ route('tercumanistakipcetveli') }}">TERCUMAN TAKİP CETVELİ</a></li>
                        <li><a href="{{ route('lksyeeklenenler') }}">LKS YE EKLENENLER</a></li>
                       
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples3">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i><p>ADLİYE
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples3">
                    <ul class="nav">
                        <li><a href="{{ url('adliyeisekle') }}">YENİ İŞ EKLE</a></li>
                        <li><a href="#">DEVAM EDEN İŞLER</a></li>
                        <li><a href="#">TAMAMLANAN İŞLER</a></li>
                       
                    </ul>
                </div>
            </li>

        </ul>
  </div>
</div>
