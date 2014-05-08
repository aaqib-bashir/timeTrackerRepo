<?php
include 'db.php';
$id=$_COOKIE['userid'];
$sql ="select isadmin from user where userid='$id'";
$rec = mysql_query($sql);
$row =  mysql_fetch_array($rec);
if($row['isadmin']>0){
    echo 'Send Mail';
}
 else {
    echo 'user';
 }
?>
