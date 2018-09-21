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
		<li class="active">Editar Pensum</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Editar Pensum</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Editar Pensum {{ $pensum->descripcion }}</div>
			<div class="panel-body">
				{{ Form::model($pensum, ['route' => ['pensum.update', $pensum->id], 'method'=> 'PUT']) }}
				<div class="col-md-6">
					<div class="form-group">
						<label>Descripcion</label>
						{{  Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'pensum']) }}
						</div>
					
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary">Añadir</button>
					{!! Form::close() !!}
					<button type="/pensum" class="btn btn-default">Cancelar</button>
				</div>
				
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection