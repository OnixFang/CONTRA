 @extends('layouts.layout');

@section('content')
<div class="row">
  <ol class="breadcrumb">
    <li><a href="#">
      <em class="fa fa-home"></em>
    </a></li>
    <li class="active">Ciclos</li>
  </ol>
</div><!--/.row-->
@if(Session::has('message'))
<div class="alert alert-success">   
  {{ Session::get('message') }}
</div>
@endif
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Historial de Ciclos</h1>
  </div>
</div><!--/.row-->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
        
    @foreach($ciclos as $ciclo)
     <h4>Ciclo {{ $ciclo->clave }}</h4>
     <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Clave</th>
      <th scope="col">Asignatura</th>
      <th scope="col">Facilitador</th>
      <th scope="col">Bimestre</th>
      <th scope="col">Horario</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
     
  <tbody>
     @foreach($ciclo->grupos as $grupociclo)
     <tr>
      <td scope="col">{{$grupociclo->clave}}</td>
      <td scope="col"> {{$grupociclo->asignatura->descripcion}}</td>
      <td scope="col"> {{$grupociclo->facilitadores->nombre}}</td>
      <td scope="col"> {{$grupociclo->bimestre}}</td>
      <td scope="col"> {{$grupociclo->horario}}</td>

<!-- {{ Form::open(array('route'=>['asignatura.destroy',$ciclo->id], 'method'=>'DELETE')) }}
           <td>{{ Form::button('Borrar',['class'=>'btn btn-danger','type'=>'submit']) }}
           {{ link_to_route('ciclo.edit', 'Editar', [$ciclo->id],['class'=>'btn btn-success']) }} </td>
      {{ Form::close() }}
       -->      </tr>
   @endforeach

    
     </tbody>
</table>
   @endforeach

{{ link_to_route('ciclo.create','Añadir',[$ciclo],['class'=>'btn btn-primary']) }}
      </div>
    </div>
  </div><!-- /.panel-->
</div>
@endsection