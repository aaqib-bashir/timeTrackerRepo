<?php
include('db.php');
if(isset($_COOKIE['userid'])){
    $id=$_COOKIE['userid'];
$current_date = date("Y-m-d");
$d = strtotime( $current_date . " -1 week" );
$weekend = date("Y-m-d", $d);
 $result = mysql_query("SELECT * FROM `task` WHERE userid='$id' and startdate BETWEEN '$weekend' and '$current_date'");
  $result = mysql_query("SELECT * FROM `task` WHERE userid='$id' and startdate BETWEEN '$weekend' and '$current_date'");
  $msg;
  $msg=",taskid,taskname,project,startdate,starttime,endtime,duration,";
   while($row=mysql_fetch_array($result))
    {
        $msg=$msg.$row['taskid'].",";
		$msg=$msg.$row['taskname'].",";
		$msg=$msg.$row['project'].",";
        $msg=$msg.$row['startdate'].","; 
		$msg=$msg.$row['starttime'].","; 
		$msg=$msg.$row['endtime'].",";
		$msg=$msg.$row['duration'].",";  
    }
	echo $msg;
}
?>