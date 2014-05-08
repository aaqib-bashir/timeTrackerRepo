<?php
include 'db.php';
if(isset($_COOKIE['userid'])){
$userid=$_COOKIE['userid'];
$old=$_POST['oldpassword'];
$new=$_POST['newpassword'];

$sql="update user set password='$new' where (userid='$userid' AND password='$old')";
if($old!="" && $new!=""){
mysql_query($sql);
if(mysql_affected_rows()>0)
{
    echo "Password successfully changed";
}
else{
    echo "Please Check The Password Again";
}
}
else{
    echo "Please Enter All The Fields";
}
}
else{

 echo 'ok';   
}
?>
