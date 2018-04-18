@extends('layouts.layout'); @section('content')

<div ng-controller="cicloController" ng-cloak>
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
			<li class="active">Añadir Grupos</li>
		</ol>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Inscribir Ciclo</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Ciclo</div>
				<form>
					<div class="panel-body">
						<div class="col-md">
							<div class="form-group col-md-9">
								<label>Clave</label>
								<input type="text" name="clave" id="clave" class="form-control" ng-model="ciclo.clave" ng-change="actualizarGrupoClaveAll()">
							</div>
							<div class="form-group col-md-3">
								<label>Fecha</label>
								<input type="date" name="fecha" id="fecha" class="form-control" ng-model="ciclo.fecha">
							</div>
						</div>
						<div class="col-md-12">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Grupos</th>
									</tr>
									<tr>
										<th class="col-md-6">Clave</th>
										<th class="col-md">Horario</th>
										<th class="col-md">Facilitador</th>
										<th class="col-md">Sección</th>
										<th class="col-md">Bimestre</th>
										<th class="col-md">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="asignatura in seleccionadas">
										<td>
											<input class="form-control" id="claveGrupo" ng-change="actualizarGrupoClave(asignatura)" ng-model="asignatura.grupo" ng-value="ciclo.clave + '-' + asignatura.clave + '-' + asignatura.descripcion + '-' + asignatura.seccion + '-' + asignatura.bimestre"
											 readonly>
										</td>
										<td>
											<input class="form-control" type="datetime-local" ng-model="asignatura.horario">
										</td>
										<td>
											<select ng-change="asignarFacilitador(facilitador.id, asignatura)" ng-model="facilitador.id">
												<option ng-repeat="facilitador in facilitadores" ng-value="facilitador.id" ng-bind="facilitador.nombre"></option>
											</select>
										</td>
										<td>
											<input class="form-control" type="number" min="1" ng-model="asignatura.seccion" ng-change="actualizarGrupoClave(asignatura)">
										</td>
										<td>
											<input class="form-control" type="number" min="1" max="2" ng-model="asignatura.bimestre" ng-change="actualizarGrupoClave(asignatura)">
										</td>
										<td class="text-right">
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
				<div class="panel-heading">Asignaturas</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Descripción</th>
								<th>Clave</th>
								<th>HP</th>
								<th>HT</th>
								<th>CR</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="asignatura in asignaturas" ng-hide="asignatura.hidden">
								<td ng-bind="asignatura.descripcion"></td>
								<td ng-bind="asignatura.clave"></td>
								<td ng-bind="asignatura.hp"></td>
								<td ng-bind="asignatura.ht"></td>
								<td ng-bind="asignatura.cr"></td>
								<td class="text-right">
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection