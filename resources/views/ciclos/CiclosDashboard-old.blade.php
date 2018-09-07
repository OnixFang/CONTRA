 @extends('layouts.layout'); @inject('calificacionService', 'App\Services\CalificacionesService')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>

@section('content')
<div class="row">
  <ol class="breadcrumb">
    <li><a href="#">
        <em class="fa fa-home"></em>
      </a></li>
    <li class="active">Ciclos</li>
  </ol>
</div>
<!--/.row-->
@if(Session::has('message'))
<div class="alert alert-success">
  {{ Session::get('message') }}
</div>
@endif
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Historial de Ciclos</h1>
  </div>
</div>
<!--/.row-->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
        @foreach($collection as $ciclo => $calificaciones)
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>{{ $ciclo }}</th>
            </tr>
            <tr>
              <th class="col-md-2">Código</th>
              <th class="col-md-3">Asignatura</th>
              <th class="col-md-3">Sección</th>
              <th class="col-md-3">Crédito</th>
              <th class="col-md-3">Puntos</th>
              <th class="col-md-3">Nota</th>
              <th class="col-md-1">Calificación</th>
              <th class="col-md-3">Estado</th>
            </tr>
          </thead>

          <tbody>
            @foreach($calificaciones as $calificacion)
            <tr>
              <td> {{ $calificacion->grupo->asignatura->clave }}</td>
              <td> {{ $calificacion->grupo->asignatura->descripcion }}</td>
              <td> {{ $calificacion->grupo->seccion }}</td>
              <td> {{ $calificacion->grupo->asignatura->cr }}</td>
              <td> {{ $calificacionService->calcularPuntos($calificacionService->calcularLiteral($calificacion->estado, $calificacion->nota), $calificacion->grupo->asignatura->cr) }} </td>
              <td> {{ $calificacion->nota }}</td>
              <td> {{ $calificacionService->calcularLiteral($calificacion->estado, $calificacion->nota) }}</td>
              <td> {{ $calificacion->estado }}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
        @endforeach {{ link_to_route('grupo.index','Añadir',null,['class'=>'btn btn-primary']) }}

      </div>
    </div>
  </div><!-- /.panel-->
</div>

@endsection