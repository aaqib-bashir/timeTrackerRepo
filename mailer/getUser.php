<?php
include('db.php');
$sql = "select * from user";
$rec = mysql_query($sql);
$str="";
$id="";
$name="";
$email="";
while($row = mysql_fetch_array($rec)){
	$id=(string) $row['userid'];
	$name =(string) $row['name'];
	$email =(string)$row['email'];
	echo '<input required type="checkbox" id="users" name="users" value="'.$id.'">'.$name." (".$email.")<br>";
	}