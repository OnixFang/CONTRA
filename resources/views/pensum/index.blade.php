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
		<h1 class="page-header">Añadir Pensum</h1>
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
    </tr>
  </thead>
  <tbody>
    @foreach($pensumes as $pensum)
    <tr>
      <th scope="row">{{$pensum->id}}</th>
      <td>{{ link_to_route('asignatura.show',$pensum->carrera->descripcion,[$pensum->id]) }}</td>
      </tr>
     @endforeach
  </tbody>
</table>
			</div>
		</div>
	</div><!-- /.panel-->
</div>
@endsection