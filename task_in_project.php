<?php
include("db.php");
function convertSec($totalDuration){
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
	 $DurationInSec=$hh*3600+$mm*60+$ss;
	 return  $DurationInSec;
 }
		$sql="select project from task where userid=1 limit 1";
		$result=mysql_query($sql);
		while($r =mysql_fetch_array($result)){
			$p = $r['project'];
			}
	$sql1 = "select sum(duration) from task where userid=1 and project='$p'";
$sql2="select taskname,sum(duration) from task where userid=1 and project='$p' GROUP BY taskname";
//$sql2="select taskname,sum(duration)from (select distinct taskname, userid, duration from task))";
//$sql2="SELECT taskname,SUM(duration) FROM task where userid=2 and project='project1' GROUP BY taskname,userid WITH ROLLUP";
$result1 = mysql_query($sql1);
$result2 = mysql_query($sql2);
$totalDuration = mysql_fetch_array($result1);
$totalDurationInSec = convertSec($totalDuration[0]);
$data="";
$d="";
	 $i=0;
	 while($row = mysql_fetch_array($result2))
  {
      $task= $row['taskname'];
	  $duration=(float)(convertSec($row['sum(duration)'])/$totalDurationInSec)*100;
	  $ret[] = array($task,$duration);
  $i++;
  }
  echo json_encode($ret);

?>
