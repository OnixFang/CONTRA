@extends('layouts.layout');

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Perfiles</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Actualizar Perfil</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {{--<div class="panel-heading">Añadir</div>--}}
                <div class="panel-body">
                    {!! Form::open(array('route' => ['profiles.update', $user->id], 'class'=> 'form', 'method' => 'put')) !!}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            {{  Form::text('first_name', old('first_name', $user->first_name), ['class'=>'form-control']) }}

                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            {{  Form::text('last_name', old('last_name', $user->last_name), ['class'=>'form-control']) }}

                        </div>
                        <div class="form-group">
                            <label>Correo Electronico</label>
                            {{  Form::email('email', old('email', $user->email), ['class'=>'form-control']) }}
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            @if((bool)Auth::user()->activate == true) 
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            @endif
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection