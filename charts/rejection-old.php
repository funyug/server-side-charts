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
          $orderdata[$c[2]][]=$c[8];
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
  <html>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Date');
      data.addColumn('number', 'Order Declines');

      data.addRows([<?php for($j=0;$j<7;$j++)
      {
      echo "[new Date('$week[$j]'),".number_format((float)$x[$j], 2, '.', '')."],";}?>
      ]);

      var options = {
        title: 'Rejections over the past 6 weeks',
        hAxis: {
          title: '',
          format: 'dd-MMM',
          textStyle: { bold:true},
          gridlines: {
         color: 'transparent'
     }
   },
    vAxis: {
      textStyle: { bold:true}
    },
        height: '400',
        width:'800',
        legend: {
          position:'none'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('rejection<?php echo $i;?>'));
        google.visualization.events.addListener(chart, 'ready', function () {
          rejectionpic<?php echo $i;?>.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });

      chart.draw(data, options);
    }
    </script>
<div id="rejection<?php echo $i;?>" style="width:600;"></div>
<div id="test">Test</div>
<div id="rejectionpic<?php echo $i;?>" class="test"></div>
<?php
$i++;
}}
?>
