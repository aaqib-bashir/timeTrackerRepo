<?php
include '../db.php';
$id=$_COOKIE['userid'];
$from=$_POST['from'];
$to=$_POST['to'];
$sql="select startdate from task where userid='$id' and startdate between '$from' and '$to' group by startdate";
$rec=  mysql_query($sql);
//$dates[] =  array();
while($row=  mysql_fetch_array($rec)){
    $dates[]=$row['startdate'];
}
echo json_encode($dates);
?>
