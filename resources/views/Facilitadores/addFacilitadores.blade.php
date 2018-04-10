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
		<li class="active">Añadir Facilitador</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Añadir Facilitador</h1>
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
						<label>Nombre</label>
						{{  Form::text('nombre',null,['class'=>'form-control','placeholder'=>'escriba nombre del facilitador']) }}

						</div>
<div class="form-group">
						<label>ciudad</label>
						{{  Form::text('ciudad',null,['class'=>'form-control','placeholder'=>'escriba ciudad donde vice']) }}

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
			<div class="panel-heading">Facilitadores Creados</div>
			<div class="panel-body">
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if(count($facilitadores) > 0) 
@foreach($facilitadores as $facilitador)
<tr>
      <th scope="row">{{$facilitador->nombre}}</th>
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