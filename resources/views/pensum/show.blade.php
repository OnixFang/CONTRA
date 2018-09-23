@extends('layouts.layout');
@inject('aprobado', 'App\Services\InscripcionCicloService');

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
        <h1 class="page-header">Pensum: {{ $pensum->carrera->descripcion}}</h1>
    </div>
</div>
<!--/.row-->
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
                            <th class="col-md-1 text-center">Clave</th>
                            <th class="col-md-6 text-center">Asignatura</th>
                            <th class="col-md-1 text-center">HT</th>
                            <th class="col-md-1 text-center">HP</th>
                            <th class="col-md-1 text-center">CR</th>
                            <th class="col-md-2 text-center">Prerrequisito</th>
                        </tr>
                    </thead>
                    @foreach($asignaturas as $asignatura)
                    <tbody>
                        <tr @if($aprobado->checkIfApproved(Auth::user(),$asignatura->clave)) {{ 'class= alert-success' }} @endif>
                            <td> {{ $asignatura->clave }}</td>
                            <td> {{ $asignatura->descripcion }}</td>
                            <td class="text-center"> {{ $asignatura->ht }}</td>
                            <td class="text-center"> {{ $asignatura->hp }}</td>
                            <td class="text-center"> {{ $asignatura->cr }}</td>
                            <td class="text-center"> {{ $asignatura->prerequisito }}</td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
                @endforeach
                @endif
            </div>
        </div>
    </div><!-- /.panel-->
</div>
@endsection