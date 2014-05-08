<?php
include('db.php');
if(isSet($_POST['fd']))
{
$fd = $_POST['fd'];
$data = explode(" ",$fd) ;
$size = sizeof($data);
$userid=$_COOKIE["userid"];
for($i=1;$i<$size;$i=$i+6)
{
    $taskname =(string)$data[$i];
    $project = $data[$i+1];
    $starttime =  $data[$i+2];
    $endtime = $data[$i+3];
    $startdate = $data[$i+4];
    $duration =  $data[$i+5];
    $sql ="insert into task values('$userid','','$taskname','$project','$starttime', '$endtime','$startdate','$duration')";
    mysql_query($sql);
    
}
echo "Data Successfull Updated"; 
}
else
{
echo 'not correct';
}
?>