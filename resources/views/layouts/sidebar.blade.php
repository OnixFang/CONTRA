<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<div class="profile-sidebar">
		{{-- <div class="profile-userpic">
			<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
		</div> --}}
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				<a href="{{ route('profiles.edit', Auth::user()) }}">{{ Auth::user()->first_name." ".Auth::user()->last_name}}</a>
			</div>
			<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="divider"></div>
	{{-- <form role="search">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		</div>
	</form> --}}
	<ul class="nav menu">
		<li class="{{ request()->is('/') ? 'active' : '' }}">
			<a href="/"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
		</li>
		<li class="{{ request()->is('pensum') ? 'active' : '' }}">
			<a href="/pensum"><em class="fa fa-calendar">&nbsp;</em> Pensum</a>
		</li>
		<li><a class="" href="/grupo">
				<span class="fa fa-calendar">&nbsp;</span> Simulación de preselección
			</a></li>
		<li><a class="" href="/prematricula">
				<span class="fa fa-calendar">&nbsp;</span> Consulta de simulación
			</a></li>
		<li class="{{ request()->is('grupo') ? 'active' : '' }} {{ request()->is('ciclo') ? 'active' : '' }} {{ request()->is('cicloactual') ? 'active' : '' }} parent ">
			<a data-toggle="collapse" href="#sub-item-3">
				<em class="fab fa-cloudscale">&nbsp;</em>
				Ciclos
				<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
					<em class="fa fa-plus"></em>
				</span>
			</a>
			<ul class="children collapse" id="sub-item-3">
				<li><a class="" href="/ciclo">
						<span class="fa fa-arrow-right">&nbsp;</span> Historial de ciclos
					</a></li>

				<li><a class="" href="/cicloactual">
						<span class="fa fa-arrow-right">&nbsp;</span> Ciclo en curso
					</a></li>
			</ul>
		<li>

			<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
				{{ __('Salir') }}
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
	</ul>
</div>
<!--/.sidebar-->