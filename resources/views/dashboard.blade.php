@extends('layouts/layout')

@section('content')
<div ng-controller="dashboardController">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div>
	<!--/.row-->

	<div class="panel panel-container">
		<div class="row">
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<a href="/pensum" style="text-decoration:none;">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding text-red">
							<!-- <em class="fa fa-xl fa-shopping-cart"></em> -->
							<div class="large">{{ count($asignaturas) }}</div>
							<div class="text-muted">Total de asignaturas</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<div class="panel panel-blue panel-widget border-right">
					<div class="row no-padding">
						<!-- <em class="fa fa-xl fa-comments color-orange"></em> -->
						<div class="large">{{ count($aprobadas)}}</div>
						<div class="text-muted">Asignaturas aprobadas</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<a href="/pensum" style="text-decoration:none;">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding">
							<!-- <em class="fa fa-xl fa-users color-teal"></em> -->
							<div class="large">{{ count($pendientes) }}</div>
							<div class="text-muted">Asignaturas pendientes</div>

						</div>
					</div>
				</a>
			</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<a href="/ciclos" style="text-decoration:none;">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding">
							<!-- <em class="fa fa-xl fa-search color-red"></em> -->
							<div class="large">{{ count($ciclos) }}</div>
							<div class="text-muted">Ciclos cursados</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<!--/.row-->
	</div>


	<div class="row">
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel bg-info color-white">
					<h4>Pendiente</h4>
					<div class="easypiechart color-white" id="easypiechart-orange" data-percent="{{ ($asignaturas->count() > 0) ? ((count($pendientes) / count($asignaturas))*100 ) : 0 }}">
						<span class="percent">
							{{ ($asignaturas->count() > 0) ? number_format((count($pendientes)/count($asignaturas))*100) : 0 }}%
						</span>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Comments</h4>
					<div class="easypiechart" id="easypiechart-orange" data-percent="65"><span class="percent">40%</span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>New Users</h4>
					<div class="easypiechart" id="easypiechart-teal" data-percent="56"><span class="percent">56%</span></div>
				</div>
			</div>
		</div> --}}
		<div class="col-xs-6 col-md-3 ">
			<div class="panel panel-default ">
				<div class="panel-body easypiechart-panel white-text bg-success">
					<h4>Completado</h4>
					<div class="easypiechart color-white" id="easypiechart-teal" data-percent="{{ ($asignaturas->count() > 0) ? ((count($aprobadas) / count($asignaturas))*100) : 0}}%">
						<span class="percent">
							{{ ($asignaturas->count() > 0) ? number_format((count($aprobadas) / count($asignaturas))*100) :0 }}%</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-9 col-md-6">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel bg-warning">
					<h4 style="color:#ffff !important">Índice acumulado</h4>
					<div class="easypiechart" style="padding-top: 10px">
						<div ng-hide="noIndice">
							<h1><strong><span style="color:#ffff !important; font-size:2em" ng-bind="indiceAcumulado | number:2"></span></strong></h1>
						</div>
						<div ng-show="noIndice" class="text-center">Aún no tiene un índice acumulado</div>
						<div ng-show="noCiclos" class="text-center">No hay ningún ciclo en el historial</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default chat">
				<div class="panel-heading">
					Asignaturas pendientes
					<span class="pull-right clickable panel-toggle panel-button-tab-left">
						<em class="fa fa-toggle-up"></em>
					</span>
				</div>
				<div class="panel-body">
					<ul>
						@if(count($pendientes)>0)
						@foreach($pendientes as $pendiente)
						<li>
							<div class="chat-body clearfix">
								<div class="header"><strong class="primary-font">{{ $pendiente->descripcion }}</strong>
									<small class="text-muted">{{ "cuatrimestre: ".$pendiente->cuatrimestre }}</small>
								</div>
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
						@else<li>{{ "No hay asignturas pendiente actualmente." }}</li>
						@endif
					</ul>
				</div>
				<div class="panel-footer">
					<div class="input-group"></div>
				</div>
			</div>
		</div>
		<!--/.col-->


		<div class="col-md-6">
			<div class="panel panel-default chat">
				<div class="panel-heading">
					Asignaturas en curso
					<span class="pull-right clickable panel-toggle panel-button-tab-left">
						<em class="fa fa-toggle-up"></em></span></div>
				<div class="panel-body">
					<ul>
						@if(count($cicloactual) > 0 )
						@foreach($cicloactual as $actual)
						<li>
							<div class="chat-body clearfix">
								<div class="header"><strong class="primary-font">{{ $actual->grupo->asignatura->descripcion }}</strong> <small
									 class="text-muted">{{ "cuatrimestre: ".$actual->grupo->asignatura->cuatrimestre }}</small></div>
								<p>
									<table class="table">
										<thead>
											<tr>
												<th scope="col-md-2">Clave</th>
												<th scope="col-md-2">Descripcion</th>
												<th scope="col-md-2">Seccion</th>
												<th scope="col-md">CR</th>
												<th scope="col-md">Nota</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{ $actual->grupo->asignatura->clave }}</td>
												<td>{{ $actual->grupo->asignatura->descripcion }}</td>
												<td>{{ $actual->grupo->seccion }}</td>
												<td>{{ $actual->grupo->asignatura->cr }}</td>
												<td>{{ $actual->nota }}</td>
												<td>{{ $actual->literal }}</td>
											</tr>
										</tbody>
									</table>
								</p>
							</div>
						</li>
						@endforeach
						@else
						<li>{{ "No hay ningún ciclo inscrito actualmente." }}</li>
						@endif
					</ul>
				</div>
				<div class="panel-footer">
					<div class="input-group"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection