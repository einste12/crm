<div class="sidebar" data-color="orange" data-image="../assets/img/full-screen-image-3.jpg">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="http://www.creative-tim.com" class="logo-text">
            Creative Tim
        </a>
    </div>
<div class="logo logo-mini">
  <a href="http://www.creative-tim.com" class="logo-text">
    Ct
  </a>
</div>

  <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="../assets/img/default-avatar.png" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ Auth::user()->name }}

                </a>
                  <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ $genel_subeler[Auth::user()->Yer-1]->name }}

                  </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li><a href="#">My Profile</a></li>
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            <li class="active">
                <a href="{{ route('dashboard') }}">
                    <i class="pe-7s-graph"></i>
                    <p>GELEN TEKLİFLER</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="pe-7s-plugin"></i>
                    <p>Components
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li><a href="{{ route('onaybekleyen')}}">Onay Bekleyen Teklifler</a></li>
                        <li><a href="{{ route('devameden') }}">Devam Eden Teklifler</a></li>
                        <li><a href="{{ route('tamamlanan') }}">Tamamlanan Teklifler</a></li>
                        <li><a href="{{ route('iptalteklif') }}">İptal Edilen Teklifler</a></li>
                        <li><a href="components/panels.html">Panels</a></li>
                        <li><a href="components/sweet-alert.html">Sweet Alert</a></li>
                        <li><a href="{{ route('logout') }}">Çıkış Yap</a></li>
                    </ul>
                </div>
            </li>

        </ul>
  </div>
</div>
