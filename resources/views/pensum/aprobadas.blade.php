@extends('layouts.layout');
@inject('nota', 'App\Services\InscripcionCicloService');


@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Pensum</li>
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
        <h1 class="page-header">Asignaturas aprobadas</h1>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <h5>Pensum: {{ $pensum->carrera->descripcion}}</h5>
        <h5>Total de Asignaturas aprobadas: {{ $asignaturas->count()}}</h5>
        <div class="panel panel-default">
            <div class="panel-body">
                @if(count($asignaturas) > 0)
                {{-- @foreach($collection as $cuatrimestre => $asignaturas) --}}

                {{-- <h4>{{"Cuatrimestre ". $cuatrimestre}}</h4> --}}
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class="col-md-1">Clave</th>
                            <th class="col-md-3">Asignatura</th>
                            <th class="col-md-1">CR</th>
                            <th class="col-md-1">Nota</th>
                            <th class="col-md-1">Calificación</th>
                        </tr>
                    </thead>
                    @foreach($asignaturas as $asignatura)
                    <tbody>
                        <tr>
                            <td> {{ $asignatura['clave'] }}</td>
                            <td> {{ $asignatura['descripcion'] }}</td>
                            <td> {{ $asignatura['cr'] }}</td>
                            <td> {{ $nota->getSubjectGrade(Auth::user(),$asignatura['id']) }}</td>
                            <td> {{ $nota->getSubjectLiteral(Auth::user(),$asignatura['id']) }}</td>

                        </tr>
                    </tbody>
                    @endforeach
                </table>
                {{-- @endforeach --}}
                @endif
            </div>
        </div>
    </div><!-- /.panel-->
</div>
@endsection