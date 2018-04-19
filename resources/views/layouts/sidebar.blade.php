<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<div class="profile-sidebar">
		<div class="profile-userpic">
			<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
		</div>
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">Username</div>
			<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="divider"></div>
	<form role="search">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		</div>
	</form>
	<ul class="nav menu">
		<li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		<li class="{{ request()->is('pensum') ? 'active' : '' }}"><a href="/pensum"><em class="fa fa-calendar ">&nbsp;</em> Pensum</a></li>
		<li class="{{ request()->is('facilitador') ? 'active' : '' }}"> <a href="/facilitador"><em class="fas fa-users">&nbsp;</em> Facilitadores</a></li>
		<li class="{{ request()->is('grupo') ? 'active' : '' }} {{ request()->is('ciclo') ? 'active' : '' }} {{ request()->is('cicloactual') ? 'active' : '' }} parent "><a data-toggle="collapse" href="#sub-item-3">
			<em class="fab fa-cloudscale">&nbsp;</em> Ciclos <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
		</a>
		<ul class="children collapse" id="sub-item-3">
			<li><a class="" href="/grupo">
				<span class="fa fa-arrow-right">&nbsp;</span> Inscribir Nuevo
			</a></li>
			<li><a class="" href="/ciclo">
				<span class="fa fa-arrow-right">&nbsp;</span> Historial
			</a></li>

			<li><a class="" href="/cicloactual">
				<span class="fa fa-arrow-right">&nbsp;</span> Actual
			</a></li>
		</ul>
		<li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
	</ul>
</div><!--/.sidebar-->