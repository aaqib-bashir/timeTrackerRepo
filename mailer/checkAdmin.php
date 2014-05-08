<?php
include 'db.php';
if(isset($_COOKIE['userid'])){
    $id=$_COOKIE['userid'];
$sql ="select isadmin from user where userid='$id'";
$rec = mysql_query($sql);
$row =  mysql_fetch_array($rec);
if($row['isadmin']>0){
    echo 'ok';
}
 else {
    echo 'not ok';
 }
    
}
?>
