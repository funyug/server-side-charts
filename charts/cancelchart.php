<?php


require('SpreadsheetReader.php');
$Reader = new SpreadsheetReader('abc.xlsx');
$Sheets = $Reader -> Sheets();


    $Reader -> ChangeSheet(3);
		$vendor=$_GET['vendor'];

    foreach ($Reader as $Row)
    {
        $a[]=$Row;
    }
    foreach($a as $c)
    {
      $vendors[]=$c;
    }

    foreach($a as $c)
    {
      $orderdata[$c[1]][$c[3]]=$c[4];
    }
    $i=0;
    foreach($orderdata as $e=>$c)
    {

      if($e!='vendor id')
      {
        $d[$e]=$c;

        $i++;
      }
    }
$i=0;
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day']
          <?php foreach($d[$vendor] as $k=>$v)
          {
            echo ",['$k',$v]";
          }?>
        ]);

        var options = {
          title: '',
          legend:{position:'none'},
          pieSliceText:'label',
          pieSliceTextStyle: {
            fontSize:11
          },
          slices: {
            0: { color: '00BFFF' },
            1: { color: '00B0EB' },
            2: { color: '009BCF' },
            3: { color: '008CBA' },
            4: { color: '00678A' }
          },
          pieSliceBorderColor:'transparent'

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 500px; height: 500px;"></div>
  </body>
