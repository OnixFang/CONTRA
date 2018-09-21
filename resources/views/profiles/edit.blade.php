@extends(((bool)Auth::user()->activate == false ? 'layouts.profile':'layouts.layout'))

@section('content')
    @if((bool)Auth::user()->activate == true)
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Perfil</li>
                <li class="active">Editar</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Perfil</h1>
            </div>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(array('route' => ['profiles.update', $user->id], 'class'=> 'form', 'method' => 'put')) !!}
                    {{--<div class="col-md-12">--}}
                    <div class="form-group col-md-6{{ $errors->first('first_name') ? ' has_error' : '' }}">
                        <label>Nombre</label>
                        {{  Form::text('first_name', old('first_name', $user->first_name), ['class'=>'form-control']) }}
                    </div>
                    <div class="form-group col-md-6{{ $errors->first('first_name') ? ' has_error' : '' }}">
                        <label>Apellido</label>
                        {{  Form::text('last_name', old('last_name', $user->last_name), ['class'=>'form-control']) }}
                    </div>

                    <div class="form-group col-md-12{{ $errors->first('first_name') ? ' has_error' : '' }}">
                        <label>Correo Electronico</label>
                        {{  Form::email('email', old('email', $user->email), ['class'=>'form-control']) }}
                    </div>

                    <div class="form-group col-md-6{{ $errors->first('first_name') ? ' has_error' : '' }}">
                        <label>Carrera </label>
                        {{  Form::select('inscripcion[carrera_id]', $careers, old('inscripcion.carrera_id', $inscripcion->carrera_id), ['class'=>'form-control']) }}
                    </div>
                    <div class="form-group col-md-6{{ $errors->first('first_name') ? ' has_error' : '' }}">
                        <label>Pensum</label>
                        {{  Form::select('inscripcion[pensum_id]', $pensums, old('inscripcion.pensum_id', $inscripcion->pensum_id), ['class'=>'form-control']) }}
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        @if((bool)Auth::user()->activate == true)
                            <a href="{{ url('/') }}" class="btn btn-default">Cancelar</a>
                        @endif
                    </div>
                    {{--</div>--}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection