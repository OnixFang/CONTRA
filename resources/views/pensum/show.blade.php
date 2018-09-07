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
            <h1 class="page-header">Pensum {{  $pensum->carrera->descripcion}}</h1>
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
                                    <th class="col-md-1">Clave</th>
                                    <th class="col-md-3">Asignatura</th>
                                    <th class="col-md-1">HT</th>
                                    <th class="col-md-1">HP</th>
                                    <th class="col-md-1">CR</th>
                                </tr>
                                </thead>
                                @foreach($asignaturas as $asignatura)

                                    <tbody>
                                    <tr>
                                        <td >{{  $asignatura->clave}}</td>
                                        <td > {{ $asignatura->descripcion }}</td>
                                        <td > {{ $asignatura->ht }}</td>
                                        <td > {{ $asignatura->hp }}</td>
                                        <td > {{ $asignatura->cr}}</td>
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