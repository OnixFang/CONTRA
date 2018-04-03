<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
	<link href="https://medialoot.com/preview/lumino/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/datepicker3.css" rel="stylesheet">
	<link href="https://medialoot.com/preview/lumino/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
@include('layouts.nav')

@yield('content') 



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