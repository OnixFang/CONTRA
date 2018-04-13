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
				<div class="panel-body">
					{!! Form::open(array('route' => 'facilitador.store', 'class'=> 'form')) !!}
					<div class="col-md">
						<div class="form-group col-md-9">
							<label>Clave</label>
							{{ Form::text('clave',null,['class'=>'form-control', 'ng-model'=>'ciclo.clave']) }}
						</div>
						<div class="form-group col-md-3">
							<label>Fecha</label>
							{{ Form::text('fecha',null,['class'=>'form-control','ng-model'=>'ciclo.fecha']) }}
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Grupos</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="grupo in grupos">
									<td class="col-md-11" ng-bind="grupo"></td>
									<td class="col-md-1">
										<button class="btn btn-danger" ng-click="removerGrupo(grupo, $index)">Remover</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary">Añadir</button>
					<button type="reset" class="btn btn-default">Cancelar</button>
					<button type="button" class="btn btn-danger" ng-click="test()">Test</button>
				</div>
				{!! Form::close() !!}
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
								<th>Nombre</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="asignatura in asignaturas">
								<td class="col-md-11" ng-bind="asignatura.descripcion"></td>
								<td class="col-md-1">
									<button class="btn btn-primary" ng-click="agregarGrupo(asignatura, $index)">Agregar</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.panel-->
	</div>
</div>
@endsection