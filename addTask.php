<?php
include 'db.php';
$userid=$_COOKIE["userid"];
$taskname=  $_POST['taskName'];
$project= $_POST['project'];
$start=$_POST['startTime'];
$end=$_POST['endTime'];
$startDate=$_POST['startDate'];
$duration=$_POST['duration'];
$enddate=$_POST['enddate'];
mysql_query("INSERT INTO task
    VALUES ('$userid','','$taskname','$project','$start','$end','$startDate','$duration')");

?>