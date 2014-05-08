<!DOCTYPE HTML>
<?php 
            include './db.php';
            function convertToMins($totalDuration){
             $hh="";
             $ss="";
             $mm="";
             for($i=strlen( $totalDuration)-1;$i>=0;$i--){
              if($i==strlen($totalDuration)-1||$i==strlen($totalDuration)-2){
               $ss=$totalDuration[$i].$ss;
                }
                else if($i==strlen($totalDuration)-3||$i==strlen($totalDuration)-4){
                    $mm=$totalDuration[$i].$mm;
                   }
                   else
                       {
                       $hh=$totalDuration[$i].$hh;
	                }
                       }
                       $DurationInMins=$hh*60+$mm+$ss/60;
                       return  $DurationInMins; 
               }
               $id=$_COOKIE['userid'];
            $sql1="select project,sum(duration) from task where userid='$id' group by project";
            $result1=  mysql_query($sql1);
            while($row=  mysql_fetch_array($result1)){
                $projects=$row['project'];
                $durations=  convertToMins($row['sum(duration)']);
                $array1[]=$projects;
                $array2[]=$durations;
            }
            ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Column Chart</title>
            
        
        <script type="text/javascript" src="./jquery.js"></script>
        <script type="text/javascript">
            $(function () {
                 $('#cont').highcharts({
                 chart: {
                 type: 'column',
                 renderTo:'cont'
                 },
                 title: {
                 text: 'Average Project Duration'
                 },
                 subtitle: {
                text: 'Source: Time Tracker (FoV)',
                //x: -20
            },
                 xAxis: {
                 categories: <?php echo json_encode($array1); ?>
                 },
                 yAxis: {
                 min: 0,
                 title: {
                 text: 'duration (mins.)'
                 }
                 },
                 tooltip: {
                 headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                 pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                 '<td style="padding:0"><b>{point.y:.1f} mins</b></td></tr>',
                 footerFormat: '</table>',
                 shared: true,
                 },
                 plotOptions: {
                 column: {
                 pointPadding: 0.2,
                 borderWidth: 0
                 }
                 },
                 series: [{
                 name: 'Project Name',
                 data: <?php echo json_encode($array2); ?>
                 }]
                 });
                 });
                         
        </script>
    </head>
    <body>
        
        <script src="./highcharts.js"></script>

        <div id="cont" align ="center" style="min-width: 310px; height: 400px; "></div> 
    </body>
</html>
