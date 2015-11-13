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
          $orderdata[$c[2]][]=$c[6];
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
          ['Date', 'Orders']<?php for($j=0;$j<7;$j++)
          {
          echo ",
          [new Date('$week[$j]'),$x[$j]]";}?>
        ]);

        var options = {
          title: 'Orders over the past 6 Weeks',
          curveType: 'none',
          legend: { position: 'none' },
          hAxis: {
          format: 'dd-MMM',
          ticks: [<?php foreach($week as $y){echo "new Date('$y'),";}?>],
          gridlines: {
         color: 'transparent'
     }}
        };
        //console.log(new Date('2015,3,22'));

        var chart = new google.visualization.LineChart(document.getElementById('orders<?php echo $i;?>'));
        var my_div = document.getElementById('orderspic');

    google.visualization.events.addListener(chart, 'ready', function () {
      orderspic<?php echo $i;?>.innerHTML = '<img src="' + chart.getImageURI() + '">';
    });
        chart.draw(data, options);
      }
    </script>
    <div id="orders<?php echo $i;?>" style="width: 900px; height: 500px"></div>
    <div id="orderspic<?php echo $i;?>"></div>
    <?php
$i++;
  }}
  ?>
  </body>
</html>
