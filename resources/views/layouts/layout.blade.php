<!DOCTYPE html>
<html ng-app="angularApp" lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Control de Asignatura</title>
	<link href="https://medialoot.com/preview/lumino/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/styles.css" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
	 crossorigin="anonymous"></script>

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- Angular Scripts -->
	<script src="/js/angular/angular.js"></script>
	<script src="/js/angular/angularapp.js"></script>
	<script src="/js/angular/controllers/maincontroller.js"></script>
	<script src="/js/angular/controllers/dashboardcontroller.js"></script>
	<script src="/js/angular/controllers/preseleccioncontroller.js"></script>
	<script src="/js/angular/controllers/ciclohistorialcontroller.js"></script>
	<script src="/js/angular/services/contradata.js"></script>
</head>

<body ng-controller="mainController">
	@include('layouts.nav')
	@include('layouts.sidebar')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" ng-init="userId = {{ Auth::user()->id }}">
		@yield('content')

	</div>
	<!-- /.col-->
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<p class="back-link">Sistema de Control de Asignatura</p>
		</div>
	</div>

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