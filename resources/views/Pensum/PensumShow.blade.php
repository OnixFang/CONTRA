 @extends('layouts.layout');

@section('content')
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
			<em class="fa fa-home"></em>
		</a></li>
		<li class="active">Pensumes</li>
	</ol>
</div><!--/.row-->
@if(Session::has('message'))
<div class="alert alert-success">   
	{{ Session::get('message') }}
</div>
@endif
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Pensum</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Añadir</div>
			<div class="panel-body">
				<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pensum</th>
      <th scope="col">Acciones</th>

    </tr>
  </thead>
  <tbody>
    @foreach($asignaturas as $asignatura)
    <tr>
      <th scope="row">{{$asignatura->id}}</th>
      <td>{{ $asignatura->descripcion }}</td>
     {{ Form::open(array('route'=>['pensum.destroy',$asignatura->id], 'method'=>'DELETE')) }}
     <td>{{ Form::button('Borrar',['class'=>'btn btn-danger','type'=>'submit']) }}
     {{ link_to_route('asignatura.edit', 'Editar', [$asignatura->id],['class'=>'btn btn-success']) }} 
    </tr>
    {{ Form::close() }}
   @endforeach
  </tbody>
</table>
{{ link_to_route('pensum.create', $title='Añadir', $parameters =array(),$attributes=array('class'=>'btn btn-primary')) }}
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection