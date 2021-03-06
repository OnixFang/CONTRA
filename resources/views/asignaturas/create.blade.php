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
				{{ Form::hidden('id_pensum',$pensum) }}
					<div class="form-group">
						<label>Nombre Asignatura</label>
						<input class="form-control" placeholder="Nombre de la asignatura" name="descripcion">
					</div>
					<div class="form-group">
						<label>Prerrequisito 1</label>
						{{Form::select( 'pre_requisito1',$prereq,null,['class' => 'form-control', 'placeholder' => 'Seleccionar'])}}
					</div>
					<div class="form-group">
						<label>Prerrequisito 2</label>
						{{Form::select( 'pre_requisito2',$prereq,null,['class' => 'form-control', 'placeholder' => 'Seleccionar'])}}
					</div>
					<div class="form-group checkbox">
						<label>
							{{ Form::checkbox('propedeutico', '1') }} Esta materia es propedéutico
						</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Créditos</label>
						<input class="form-control" placeholder="Cr" name="cr">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Horas Prácticas</label>
						<input class="form-control" placeholder="HP" name="hp">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Horas Teóricas</label>
						<input class="form-control" placeholder="HT" name="ht">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Cuatrimestre</label>
						<input class="form-control" placeholder="Cuatrimestre" name="cuatrimestre">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Clave </label>
						<input class="form-control" placeholder="Clave" name="clave">
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary">Añadir</button>
				<button type="reset" class="btn btn-default">Cancelar</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection