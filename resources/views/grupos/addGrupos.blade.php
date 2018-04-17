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
		<li class="active">Añadir Grupos</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Añadir Grupos</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Añadir</div>
			<div class="panel-body">
				{!! Form::open(array('route' => 'facilitador.store', 'class'=> 'form')) !!}
				<div class="col-md-6">
					<div class="form-group">
						<label>descripcion</label>
						{{  Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'escriba nombre del facilitador']) }}

						</div>
<div class="form-group">
						<label>Clave</label>
						{{  Form::text('clave',null,['class'=>'form-control','placeholder'=>'escriba ciudad donde vice']) }}
						<div class="form-group">

<label>Horario</label>
						{{  Form::text('clave',null,['class'=>'form-control','placeholder'=>'escriba ciudad donde vice']) }}
</div>
						</div>
						<div class="form-group">
						{{Form::label('id_cliclo','Seleccione un Profesor')}}
						{{ Form::select('id_ciclo',$facilitadores,1,['class'=>'form-control']) }}
					</div>


					<div class="form-group">
						{{Form::label('id_asignatura','Seleccione una Asignatura')}}
						{{ Form::select('id_asignatura',$asignaturas,1,['class'=>'form-control']) }}
					</div>

					<div class="form-group col-md-6">
						{{Form::label('bimestre','Seleccione un bimestre')}}
						{{ Form::select('bimestre', ['1'=>'1','2'=>'2'],['class'=>'form-control']) }}
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

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">grupos Creados</div>
			<div class="panel-body">
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if(count($grupos) > 0) 
@foreach($grupos as $grupo)
<tr>
      <th scope="row">{{$grupo->nombre}}</th>
      <td></td>

    </tr>
    @endforeach
@endif
  </tbody>
</table>


			</div>
		</div>
	</div><!-- /.panel-->
</div>

@endsection