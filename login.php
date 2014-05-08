<?php
include('db.php');
$username=$_POST['login_username'];
$password=$_POST['login_password'];
$sql_check = mysql_query("SELECT * FROM user WHERE ( username='$username' OR email='$username') AND password='$password'");

if(mysql_num_rows($sql_check))
{
	while($row = mysql_fetch_array($sql_check, MYSQL_ASSOC))
{
	$userid =(int)$row['userid'];
	$name=$row['name'];
   
} 
echo 'login Successfull';

setcookie("name", $name,time()+3600,"/","", 0);
setcookie("userid",$userid,time()+3600,"/","",0);
}
else
{
echo 'Username or Password is incorrect';
}
?>