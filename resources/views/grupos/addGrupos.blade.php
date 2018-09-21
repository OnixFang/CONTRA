@extends('layouts.layout'); @section('content')

<div ng-controller="preseleccionController" ng-cloak>
	@if(Session::has('message'))
	<div class="alert alert-success">
		{{ Session::get('message') }}
	</div>
	@endif
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="#">
					<em class="fa fa-home"></em>
				</a>
			</li>
			<li class="active">Simulación de preselección</li>
		</ol>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Simulación de preselección</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Ciclo <span ng-bind="ciclo.clave"></span></div>
				<form>
					<div class="panel-body">
						<div class="col-md-12">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Grupos</th>
									</tr>
									<tr>
										<th class="col-md-6">Asignatura</th>
										<th class="col-md-2">Horario</th>
										<th class="col-md-1">Sección</th>
										<th class="col-md-1">Bimestre</th>
										<th class="col-md-2 text-center">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="asignatura in seleccionadas">
										<td ng-bind="asignatura.clave + '-' + asignatura.descripcion"></td>
										<td ng-bind="asignatura.horario"></td>
										<td ng-bind="asignatura.seccion"></td>
										<td ng-bind="asignatura.bimestre"></td>
										<td class="text-center">
											<button class="btn btn-danger" ng-click="removerAsignatura(asignatura, $index)">Remover</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-primary" ng-click="fillGrupos()">Inscribir Ciclo</button>
					</div>
				</form>
			</div>
			<!-- /.panel-->
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Grupos disponibles</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="col-md-2">Clave</th>
								<th class="col-md-6">Descripción</th>
								<th class="col-md-1">Creditos</th>
								<th class="col-md-2">Horario</th>
								<th class="col-md-1 text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="asignatura in asignaturas | orderBy: 'cuatrimestre'" ng-hide="asignatura.hidden">
								<td ng-bind="asignatura.clave"></td>
								<td ng-bind="asignatura.descripcion"></td>
								<td ng-bind="asignatura.cr"></td>
								<td ng-bind="asignatura.horario"></td>
								<td class="text-center">
									<button class="btn btn-primary" ng-click="validarAsignatura(asignatura)">Agregar</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.panel-->
	</div>
	<!-- Modal -->
	<div class="modal fade" id="cicloModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Advertencia</h5>
				</div>
				<div class="modal-body">
					<p ng-bind="modalMessage"></p>
					<ul>
						<li ng-repeat="prerrequisito in prerrequisitos" ng-bind="prerrequisito"></li>
					</ul>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-danger" ng-click="agregarTempAsignatura(tempAsignatura)" ng-show="showAgregar">Agregar de todos modos</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="clearModalMessage()">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection