<?php
include('db.php');
$name=$_POST['name'];
$username=$_POST['username'];
$email = $_POST['email'];
$password=$_POST['password'];
if( mysql_query("insert into user(userid,name,username,email,password,isadmin) values('','".$name."','".$username."','".$email."','".$password."','');")){
echo 'Signup Sucessfull you can login now';
}
else
{
echo 'Database not responding.....';
}
?>