
@extends('layouts/layout')

@section('content')
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
			<em class="fa fa-home"></em>
		</a></li>
		<li class="active">Contra</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Control de Asignaturas</h1>
	</div>
</div><!--/.row-->

<div class="panel panel-container">
	<div class="row">
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-teal panel-widget border-right">
				<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
					<div class="large">{{ count($pendientes) }}</div>
					<div class="text-muted">Asignaturas pendientes</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-blue panel-widget border-right">
				<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
					<div class="large">{{ count($aprobadas)}}</div>
					<div class="text-muted">Asignaturas aprobadas</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<a href="/ciclo" style="text-decoration:none;">
				<div class="panel panel-orange panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
						<div class="large">{{ count($ciclos) }}</div>
						<div class="text-muted">Ciclos cursados</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<a href="/pensum" style="text-decoration:none;">
				<div class="panel panel-red panel-widget ">
					<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
						<div class="large">{{ count($asignaturas) }}</div>
						<div class="text-muted">total de asignaturas</div>
					</div>
				</div>
			</a>
		</div>
	</div><!--/.row-->
</div>


<div class="row">
	<div class="col-xs-6 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body easypiechart-panel">
				<h4>Pendiente</h4>
				<div class="easypiechart" id="easypiechart-blue" data-percent="{{((count($pendientes) / count($asignaturas))*100 ) }}" ><span class="percent">{{ number_format((count($pendientes)/count($asignaturas))*100),0}}%</span></div>
			</div>
		</div>
	</div>
	{{-- <div class="col-xs-6 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body easypiechart-panel">
				<h4>Comments</h4>
				<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">40%</span></div>
			</div>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body easypiechart-panel">
				<h4>New Users</h4>
				<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
			</div>
		</div>
	</div> --}}
	<div class="col-xs-6 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body easypiechart-panel">
				<h4>Completado</h4>
				<div class="easypiechart" id="easypiechart-red" data-percent="{{  ((count($aprobadas) / count($asignaturas))*100 )}}%" ><span class="percent">{{  number_format((count($aprobadas) / count($asignaturas))*100),0}}%</span></div>
			</div>
		</div>
	</div>
</div><!--/.row-->

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default chat">
			<div class="panel-heading">
				Asignaturas pendientes
				<ul class="pull-right panel-settings panel-button-tab-right">
					<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
						<em class="fa fa-cogs"></em>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<ul class="dropdown-settings">
								<li><a href="#">
									<em class="fa fa-cog"></em> Settings 1
								</a></li>
								<li class="divider"></li>
								<li><a href="#">
									<em class="fa fa-cog"></em> Settings 2
								</a></li>
								<li class="divider"></li>
								<li><a href="#">
									<em class="fa fa-cog"></em> Settings 3
								</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
			<div class="panel-body">
				<ul>
				@if(count($pendientes)>0)
					@foreach($pendientes as $pendiente)
					<li class="left clearfix"><span class="chat-img pull-left">
						<img src="http://placehold.it/60/30a5ff/fff" alt="User Avatar" class="img-circle" />
					</span>
					<div class="chat-body clearfix">
						<div class="header"><strong class="primary-font">{{ $pendiente->descripcion }}</strong> <small class="text-muted">{{ "cuatrimestre: ".$pendiente->cuatrimestre }}</small></div>
						<p>
							<table class="table">
								<thead>
									<tr>
										<th scope="col-md-2">Clave</th>
										<th scope="col-md-2">HP</th>
										<th scope="col-md-2">HT</th>
										<th scope="col-md">CR</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{ $pendiente->clave }}</td>
										<td>{{ $pendiente->hp }}</td>
										<td>{{ $pendiente->ht }}</td>
										<td>{{ $pendiente->cr }}</td>
									</tr>
								</tbody>
							</table>
						</p>
					</div>
				</li>
				@endforeach
				@else<li>{{   "No hay asignturas pendiente actualmente "}}</li>
				@endif
			</ul>
		</div>
		<div class="panel-footer">
			<div class="input-group">

			</span></div>
		</div>
	</div>

</div><!--/.col-->


<div class="col-md-6">
	<div class="panel panel-default ">
		<div class="panel-heading">
			Asignaturas en curso
			<ul class="pull-right panel-settings panel-button-tab-right">
				<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
					<em class="fa fa-cogs"></em>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					
					<li>
						<ul class="dropdown-settings">
							<li><a href="#">
								<em class="fa fa-cog"></em> Settings 1
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<em class="fa fa-cog"></em> Settings 2
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<em class="fa fa-cog"></em> Settings 3
							</a></li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
		<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
		<div class="panel-body timeline-container">
			<ul class="timeline">
				{{-- {{ count($actuales) }}
				@if(count($actuales)>0  )								
				@foreach($actuales as $actual)
				<li>
					<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">{{ $actual->asignatura->descripcion }}</h4>
						</div>
						<div class="timeline-body">
							<p>{{ "profesor: ".$actual->facilitadores->nombre  }}</p>
							<p>{{ "bimestre: ".$actual->bimestre }}</p>
							<p>{{ "Horario: ".date('D - h:i A',strtotime($actual->horario)) }}</p>
						</div>
					</div>
				</li>
				@endforeach
				@else
				<li>{{   "no hay ningún ciclo inscrito actualmente "}}</li>
				@endif --}}
			</ul>
		</div>
	</div>
	@endsection