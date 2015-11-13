<?php

    require('SpreadsheetReader.php');
    $Reader = new SpreadsheetReader('abc.xlsx');
    $Sheets = $Reader -> Sheets();


        $Reader -> ChangeSheet(1);


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
        for($i=1;$i<8;$i++)
        {

          $week[]=getday(substr($vendors[$i][5],5,7),substr($vendors[$i][5],0,4));
        }




function getday($week, $year) {
$dto = new DateTime();

$dto->setISODate($year, $week);
$ret = $dto->format('Y,m,d');
return $ret;
}
$i=0;
foreach($orderdata as $x)
{
  if(count($x)==7)
  {
  ?>
    <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Response Time']<?php for($j=0;$j<7;$j++)
          {
          echo ",
          [new Date('$week[$j]'),".number_format((float)$x[$j], 2, '.', '')."]";}?>
        ]);

        var options = {
          series: {
            0: { color: '#30CF9A' }
          },
          title: 'Response Time',
          curveType: 'none',
          legend: { position: 'none' },
          hAxis: {
          textStyle: { bold:true},
          format: 'dd-MMM',
          ticks: [<?php foreach($week as $y){echo "new Date('$y'),";}?>],
          gridlines: {
         color: 'transparent'
          }
        },
          vAxis: {
            format:'##.##',
            textStyle:{
            bold:true
          }
          }
        };
        //console.log(new Date('2015,3,22'));

        var chart = new google.visualization.LineChart(document.getElementById('response<?php echo $i;?>'));
        var my_div = document.getElementById('responsepic');

    google.visualization.events.addListener(chart, 'ready', function () {
      responsepic<?php echo $i;?>.innerHTML = '<img src="' + chart.getImageURI() + '">';
    });
        chart.draw(data, options);
      }
    </script>
    <div id="response<?php echo $i;?>" style="width: 900px; height: 500px"></div>
    <div id="responsepic<?php echo $i;?>"></div>
    <?php
$i++;
  }}
  ?>
  </body>
</html>
