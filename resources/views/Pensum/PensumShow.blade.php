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
		<h1 class="page-header">Pensum {{ $id_pensum }}</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
				
    @if(count($collection) > 0)
    @foreach($collection as $cuatrimestre => $asignaturas)
     <h4>{{"Cuatrimestre ". $cuatrimestre}}</h4>
     <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Clave</th>
      <th scope="col">Asignatura</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
     @foreach($asignaturas as $asignatura)

  <tbody>
     <tr>
      <td scope="col">{{$asignatura->clave}}</td>
      <td scope="col"> {{ $asignatura->descripcion }}</td>

{{ Form::open(array('route'=>['asignatura.destroy',$asignatura->id], 'method'=>'DELETE')) }}
     <td>{{ Form::button('Borrar',['class'=>'btn btn-danger','type'=>'submit']) }}
     {{ link_to_route('asignatura.edit', 'Editar', [$asignatura->id],['class'=>'btn btn-success']) }} </td>
{{ Form::close() }}
      </tr>
   @endforeach
   
    
     </tbody>
</table>
   @endforeach
@endif

{{ link_to_route('asignatura.create','Añadir',[$id_pensum],['class'=>'btn btn-primary']) }}
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection