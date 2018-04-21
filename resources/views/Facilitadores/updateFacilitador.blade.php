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
		<li class="active">Editar Facilitador</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Editar Facilitador</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Editar facilitador {{ $facilitador->nombre }}</div>
			<div class="panel-body">
				{!! Form::model($facilitador,['route' => ['facilitador.update',$facilitador->id],'method'=>'PUT','class'=> 'form']) !!}
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
					<button type="submit" class="btn btn-success">Editar</button>
					<button type="reset" class="btn btn-default">Cancelar</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection