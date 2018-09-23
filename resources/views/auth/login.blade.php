@extends('layouts.app')

@section('content')
<!--Intro Section-->
            <section class="view intro-2 hm-gradient">
                <div class="full-bg-img">
                    <div class="container flex-center">
                        <div class="d-flex align-items-center content-height">
                            <div class="row flex-center">
                                <div class="col-md-6 text-center text-md-left mb-5">
                                    <div class="white-text">
                                        <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">Sistema de Control de Asignaturas </h1>
                                        <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
                                        <h6 class="wow fadeInLeft" data-wow-delay="0.3s">
                                                Este sistema le brinda la información que necesita acerca de su estado académico en la UAPA. 
                                                Nuestro sistema se alimenta de la información que aparece en la sistema académico de la Universidad por lo cual no nos hacemos responsables de veracidad de la información que se brinda. 
                                                Las informaciones oficiales y finales siempre serán las que brinda el departamento de Registro de la universidad.
                                                Advertencia: Su matrícula y contraseña serán almacenadas en nuestra base de datos, las cuales
                                                serán utilizadas por el sistema para acceder periodicamente a la plataforma de UAPA.
                                        </h6>
                                        <br>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-5 offset-xl-1">
                                    <!--Form-->
                                    <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                        <div class="card-body">
                                                <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                            <!--Header-->
                                            <div class="text-center">
                                                <h3 class="white-text"><i class="fa fa-user white-text"></i> Registrarse</h3>
                                                <hr class="hr-light">
                                            </div>

                                            <!--Body-->
                                            <div class="md-form">
                                                    <i class="fa fa-user prefix white-text active"></i>
                                                        <input id="username" type="text" class="form-control text-white{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                            name="username" value="{{ old('username') }}" required>
                                                        @if ($errors->has('username'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                        @endif
                                                        <label for="username" class="white-text active">{{ __('Matrícula')}}</label>                                              
                                                </div>

                                                <div class="md-form">
                                                        <i class="fa fa-lock prefix white-text active"></i>
                                                        <input id="password" type="password" class="form-control text-white{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                        name="password" required>
                
                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                    <label for="password" class="white-text active">{{ __('Contraseña')}}</label>                             
                                                </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Recordar mi usuario') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-indigo">
                                        {{ __('Entrar') }}
                                    </button>                                    
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <hr class="hr-light mb-3 mt-4">

                                <div class="inline-ul text-center d-flex justify-content-center">
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Olvidé mi contraseña') }}
                                    </a>
                                    {{--  <a class="icons-sm tw-ic"><i class="fa fa-twitter white-text"></i></a>
                                    <a class="icons-sm li-ic"><i class="fa fa-linkedin white-text"> </i></a>
                                    <a class="icons-sm ins-ic"><i class="fa fa-instagram white-text"> </i></a>  --}}
                                </div>
                            </div>
                        </form>
                                       </div>
                                    </div>
                                    <!--/.Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </header>
        <!--Main Navigation-->




{{--  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="row">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Matrícula')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Recordar mi usuario') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Entrar') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidé mi contraseña') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <p>
                        <strong>Advertencia: </strong>Su matrícula y contraseña serán almacenadas en nuestra base de datos, las cuales
                        serán utilizadas por el sistema para acceder periodicamente a la plataforma de UAPA.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>  --}}

@endsection