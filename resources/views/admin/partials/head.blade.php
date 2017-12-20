<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
						<i class="fa fa-navicon visible-on-sidebar-mini"></i>
					</button>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"></a>
				</div>
				<div class="collapse navbar-collapse">

					<form class="navbar-form navbar-left navbar-search-form" role="search">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input type="text" value="" class="form-control" placeholder="Müşteri Ara...">
						</div>
					</form>

					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="charts.html">
								<i class="fa fa-line-chart"></i>
								<p>İstatistik</p>
							</a>
						</li>


						

						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-list"></i>
								<p class="hidden-md hidden-lg">
									More
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<li>
									<a href="#">
										<i class="fa fa-angle-right" aria-hidden="true"></i> Taslaklar
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-angle-right" aria-hidden="true"></i> Hesap Numaraları
									</a>
								</li>
									<li>
									<a href="#">
										<i class="fa fa-angle-right" aria-hidden="true"></i> Şube İletişim Bilgileri
									</a>
								</li>
									<li>
									<a href="#">
										<i class="fa fa-angle-right" aria-hidden="true"></i>Logolar
									</a>
								</li>
									<li>
									<a href="#">
										<i class="fa fa-angle-right" aria-hidden="true"></i>Deneme Metinleri
									</a>
								</li>
									<li>
									<a href="#">
										<i class="fa fa-angle-right" aria-hidden="true"></i>İstatistikler
									</a>
								</li>
									<li>
									<a href="{{ url('logout') }}">
										<i class="fa fa-close" aria-hidden="true"></i> Çıkış
									</a>
								</li>
							
							
							</ul>
						</li>

					</ul>
				</div>
			</div>
    </nav>
