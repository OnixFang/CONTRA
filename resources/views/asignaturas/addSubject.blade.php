@extends('layouts.layout');

@section('content')
@if(Session::has('message'))
<div class="alert alert-success">   
	{{ Session::get('message') }}
</div>
@endif
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
			<em class="fa fa-home"></em>
		</a></li>
		<li class="active">Añadir Asignatura</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Añadir Asignaturas</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Añadir</div>
			<div class="panel-body">
				{!! Form::open(array('route' => 'asignatura.store', 'class'=> 'form')) !!}
				<div class="col-md-6">
					<div class="form-group">
						<label>Nombre Asignatura</label>
						<input class="form-control" placeholder="Placeholder">
					</div>
					<div class="form-group">
						<label>Pre-requisito</label>
						<input class="form-control" placeholder="Placeholder">
					</div>
					<div class="form-group checkbox">
						<label>
							<input type="checkbox">Esta materia es propedéutico
						</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Créditos</label>
						<input class="form-control" placeholder="Cr">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Horas prácticas</label>
						<input class="form-control" placeholder="HP">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Horas Teóricas</label>
						<input class="form-control" placeholder="HT">
					</div>
				</div>	
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary">Añadir</button>
					<button type="reset" class="btn btn-default">Cancelar</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection