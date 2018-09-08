@extends('layouts.layout'); @inject('calificacionService', 'App\Services\CalificacionesService')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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
</div>
<!--/.row-->
@if(Session::has('message'))
<div class="alert alert-success">
    {{ Session::get('message') }}
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ciclo en curso</h1>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Ciclo {{ $cicloactual[0]->clave }}</h4>
            </div>
            <div class="panel-body">
                @if($cicloactual !== null)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-1 text-center">Código</th>
                            <th class="col-md-5 text-center">Asignatura</th>
                            <th class="col-md-1 text-center">Sección</th>
                            <th class="col-md-1 text-center">Créditos</th>
                            <th class="col-md-1 text-center">Puntos</th>
                            <th class="col-md-1 text-center">Nota</th>
                            <th class="col-md-1 text-center">Calificación</th>
                            <th class="col-md-1 text-center">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cicloactual as $grupociclo)
                        <tr>
                            <td class="text-center"> {{$grupociclo->grupo->asignatura->clave}}</td>
                            <td> {{$grupociclo->grupo->asignatura->descripcion}}</td>
                            <td class="text-center"> {{$grupociclo->grupo->seccion}}</td>
                            <td class="text-right"> {{$grupociclo->grupo->asignatura->cr}}</td>
                            <td class="text-right">{{ $calificacionService->calcularPuntos($calificacionService->calcularLiteral($grupociclo->estado, $grupociclo->nota), $grupociclo->grupo->asignatura->cr) }}</td>
                            @if($grupociclo->nota !== null)
                            <td class="text-right">{{ $grupociclo->nota }} </td>
                            @else
                            <td> hello </td>
                            @endif
                            <td class="text-center">{{ $calificacionService->calcularLiteral($grupociclo->estado, $grupociclo->nota) }}</td>
                            <td class="text-center"> {{$grupociclo->estado}}</td>
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