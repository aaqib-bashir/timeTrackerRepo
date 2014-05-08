<?php
include '../db.php';
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
            $from=$_POST['from'];
            $to=$_POST['to'];
            $sql="select sum(duration) from task where userid='$id' and startdate between '$from' AND '$to' group by startdate";
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){
                $duration[] = convertToMins($row['sum(duration)']);
                }
                echo json_encode($duration);
?>
