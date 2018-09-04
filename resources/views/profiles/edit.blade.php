<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CONTRA - CONTROL de ASIGNATURA</title>
	<link href="https://medialoot.com/preview/lumino/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/datepicker3.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/styles.css" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
	 crossorigin="anonymous"></script>


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
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(array('route' => ['profiles.update', $user->id], 'class'=> 'form', 'method' => 'put')) !!}
                    <div class="col-md-12">
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
</div>
    </div>
</div>
	<!-- /.col-->
	<div class="col-sm-12">
		<p class="back-link">CONTRA - Systema de Control de Asignatura
		</p>
	</div>
	</div>
	<!--/.row-->
	</div>
	<!--/.main-->

	<script src="https://medialoot.com/preview/lumino/js/jquery-1.11.1.min.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/bootstrap.min.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/chart.min.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/chart-data.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/easypiechart.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/easypiechart-data.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/bootstrap-datepicker.js"></script>
	<script src="https://medialoot.com/preview/lumino/js/custom.js"></script>
	<script>
		window.onload = function () {
			var chart1 = document.getElementById("line-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(lineChartData, {
				responsive: true,
				scaleLineColor: "rgba(0,0,0,.2)",
				scaleGridLineColor: "rgba(0,0,0,.05)",
				scaleFontColor: "#c5c7cc"
			});
		};
	</script>
</body>

</html>
