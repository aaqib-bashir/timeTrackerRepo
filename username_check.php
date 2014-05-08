<?php
include('db.php');

if(isSet($_POST['username']))
{
$username = $_POST['username'];
$username = mysql_real_escape_string($username);
$sql_check = mysql_query("SELECT userid FROM user WHERE username='$username'");

if(mysql_num_rows($sql_check))
{
echo $username.' is already in use';
}
else
{
echo 'OK';
}
}
?>