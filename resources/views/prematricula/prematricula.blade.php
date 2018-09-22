@extends('layouts.layout');
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
        <li class="active">Consulta de simulación de preselección</li>
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
        <h1 class="page-header">Simulación de preselección</h1>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            @if($collection->count() !== 0)
            <div class="panel-heading">
                <h4>Ciclo {{ $collection[0]->clave }}</h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-1 text-center">Código</th>
                            <th class="col-md-6 text-center">Asignatura</th>
                            <th class="col-md-1 text-center">Créditos</th>
                            <th class="col-md-1 text-center">Sección</th>
                            <th class="col-md-2 text-center">Horario</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($collection as $prematricula)
                        <tr>
                            <td class="text-center"> {{ $prematricula->grupo->asignatura->clave }}</td>
                            <td> {{ $prematricula->grupo->asignatura->descripcion }}</td>
                            <td class="text-center"> {{ $prematricula->grupo->asignatura->cr }}</td>
                            <td class="text-center"> {{ $prematricula->grupo->seccion }}</td>
                            <td class="text-center"> {{ $prematricula->grupo->horario }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @else
                <div>
                    <div class="panel-heading">
                        <div class="text-center">{{ "No tiene ninguna simulación de preselección." }}</div>
                    </div>
                </div>
                @endif
            </div>
            <div class="panel-footer">
                <span>{{ link_to_action('GrupoController@create', $title = 'Realizar una prematrícula nueva', $parameters = array(), $attributes = array('class'=>'btn btn-danger')) }}
                    </span>
            </div>
        </div>
    </div><!-- /.panel-->
</div>

@endsection