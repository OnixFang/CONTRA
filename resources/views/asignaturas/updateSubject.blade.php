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
				{{ Form::model($asignatura,['route'=>['asignatura.update',$asignatura->id],'method'=>'PUT']) }}
				{{ Form::hidden('id_pensum',$asignatura->id_pensum) }}
				<div class="col-md-6">
					<div class="form-group">
						<label>Nombre Asignatura</label>
						{{Form::text('descripcion',null,['class'=>'form-control'])}}					</div>
						<div class="form-group">
							<label>Pre-requisito 1</label>
							{{Form::select( 'pre_requisito1',$prereq,null,['class' => 'form-control', 'placeholder' => 'Seleccionar'])}}
						</div>
						<div class="form-group">
							<label>Pre-requisito 2</label>
							{{Form::select( 'pre_requisito2',$prereq,null,['class' => 'form-control', 'placeholder' => 'Seleccionar'])}}
						</div>
						<div class="form-group checkbox">
							<label>
								{{ Form::hidden('propedeutico', '0') }} 
								{{ Form::checkbox('propedeutico', '1') }} Esta materia es propedéutico
							</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Créditos</label>
							{{Form::text('cr',null,['class'=>'form-control'])}}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Horas prácticas</label>
							{{Form::text('hp',null,['class'=>'form-control'])}}					</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Horas Teóricas</label>
								{{Form::text('ht',null,['class'=>'form-control'])}}					</div>
							</div>	
							<div class="col-md-3">
								<div class="form-group">
									<label>cuatrimestre</label>
									{{Form::text('cuatrimestre',null,['class'=>'form-control'])}}					</div>
								</div>	
								<div class="col-md-3">
									<div class="form-group">
										<label>Clave </label>
										{{Form::text('clave',null,['class'=>'form-control'])}}					</div>
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