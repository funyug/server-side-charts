<?php

require('SpreadsheetReader.php');
$Reader = new SpreadsheetReader('abc.xlsx');
$Sheets = $Reader -> Sheets();

$vendor=$_GET['vendor'];

		$Reader -> ChangeSheet(1);


		foreach ($Reader as $Row)
		{
				$a[]=$Row;
		}
		foreach($a as $c)
		{
			$vendors[$c[2]][]=$c;
		}

		foreach($a as $c)
		{
			$orderdata[$c[2]][]=$c[11];
		}
		$i=0;
		foreach($orderdata as $c)
		{

			if(count($c)==7)
			{
				$d[$i]=$c;

				$i++;
			}
		}



		//$week[]=VOID;
		for($i=0;$i<7;$i++)
		{

			$week[]=getday(substr($vendors[$vendor][$i][5],5,7),substr($vendors[$vendor][$i][5],0,4));
		}




function getday($week, $year) {
$dto = new DateTime();

$dto->setISODate($year, $week);
$ret = $dto->format('M-d');
return $ret;
}
$i=0;


?>

<!doctype html>
<html>
	<head>
		<title>Line Chart</title>
		<script src="Chart.min.js"></script>

	</head>
	<body>
		<div style="width:40%" id="chart">

				<canvas id="canvas" height="450" width="600"></canvas>

		</div>


	<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : [<?php foreach($week as $x) echo "'$x',";?>],
			datasets : [
				{
					label: "My First dataset",
					fillColor:"rgba(0,0,0,0)",
					strokeColor : "#30CF9A",
					pointColor : "rgba(0,0,0,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php foreach($orderdata[$vendor] as $x) echo "'$x',"; ?>]
				}
			]
		}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true,
			animation:false,
			bezierCurve:false,
			scaleShowVerticalLines: false,
			scaleGridLineWidth : 2,
			scaleGridLineColor : "rgba(0,0,0,.1)",
			scaleLineColor: "rgba(0,0,0,0)",
			scaleLineWidth: 2
		});
	}
	</script>
	</body>
</html>
