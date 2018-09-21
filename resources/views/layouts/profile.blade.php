<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONTRA - CONTROL de ASIGNATURA</title>
    <link href="https://medialoot.com/preview/lumino/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://medialoot.com/preview/lumino/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://medialoot.com/preview/lumino/css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="container-fluid">
    <div class="row auto">
        <div class="col-sm-6 col-sm-offset-3">

            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Actualizar Perfil</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body bg-warning">
                            Su acceso ha sido verificado. Por favor introduzaca su información para activar su cuenta. Se le enviará un correo con un link de activación al correo que usted proporcione.
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>
<!-- /.col-->
<div class="col-sm-12">
    <p class="back-link">CONTRA - Systema de Control de Asignatura</p>
</div>

<script src="https://medialoot.com/preview/lumino/js/jquery-1.11.1.min.js"></script>
<script src="https://medialoot.com/preview/lumino/js/bootstrap.min.js"></script>
</body>
</html>