@extends('layouts.layout'); @section('content')

<div ng-controller="cicloController">
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
			<li class="active">Publicar Calificaciones Grupos</li>
		</ol>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Calificaciones</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Calificar</div>
				<div class="panel-body">
					{!! Form::open(array('route' => 'calificacion.store','class'=> 'form')) !!}
					<div class="col-md-6">
					{{ Form::hidden('id_grupo',$grupo->id) }}
					{{ Form::hidden('id_asignatura',$grupo->asignatura->id) }}

						<div class="form-group">
							<label>Asignatura</label>
							<div class="">{{ Form::label('asignatura',$grupo->asignatura->descripcion) }}</div>
						</div>
						
						<div class="form-group">
							<label>Facilitador</label>

							<div class="">{{Form::label('facilitador',$grupo->facilitadores->nombre)}} </div>
						</div>

						<div class="form-group col-md-6">
							<label>bimestre</label>	
							<div class="">{{Form::label('bimestre',$grupo->bimestre)}} </div>
						</div>
						<div class="form-group">
							<label>Clave</label>
							{{ Form::text('calificacion',null,['class'=>'form-control','placeholder'=>'escriba calificacion']) }}
							<div class="form-group">


						
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Añadir</button>
							<button type="reset" class="btn btn-default">Cancelar</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- /.panel-->
		</div>
			<!-- /.panel-->
		</div>
	</div>
</div>
@endsection