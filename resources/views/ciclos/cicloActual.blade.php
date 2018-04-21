 @extends('layouts.layout');
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
    <li><a href="/">
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
    <h1 class="page-header">Ciclo en curso</h1>
  </div>
</div><!--/.row-->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
        @if(count($cicloactual)>0)
        
        <h4>Ciclo {{ $cicloactual->clave }}</h4>
        <table class="table table-bordered">
          <thead>
            <tr>
            <th class="col-md-2">Clave</th>
              <th class="col-md-3">Asignatura</th>
              <th class="col-md-1">Facilitador</th>
              <th class="col-md-1">Bimestre</th>
              <th class="col-md-1">Horario</th>
              <th class="col-md-1">Calificaciones</th>
            </tr>
          </thead>

          <tbody>
           @foreach($cicloactual->grupos as $grupociclo)
           <tr>
            <td>{{$grupociclo->clave}}</td>
            <td> {{$grupociclo->asignatura->descripcion}}</td>
            <td> {{$grupociclo->facilitadores->nombre}}</td>
            <td> {{$grupociclo->bimestre}}</td>
            <td> {{$grupociclo->horario}}</td>


            @if(count($grupociclo->calificacion) > 0)
            <td>{{ $grupociclo->calificacion->calificacion }}
             @else
             <td><!-- Button trigger modal -->

              {{link_to_route('calificacion.show','Calificar',[$grupociclo->id],['class'=>'btn btn-warning',"data-toggle"=>"modal", "data-target"=>"#exampleModalCenter","type"=>"button" ]) }}
              @endif
             </td>
            </tr>
            @endforeach


          </tbody>
        </table>

        @else
        <div class="text-center">{{ "No tiene ningún ciclo en curso" }}</div>
        @endif
      </div>
    </div>
  </div><!-- /.panel-->
</div>

@endsection