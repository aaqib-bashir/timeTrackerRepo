<?php
include('db.php');

if(isSet($_POST['email']))
{
$email = $_POST['email'];
$email = mysql_real_escape_string($email);
$sql_check = mysql_query("SELECT userid FROM user WHERE email='$email'");

if(mysql_num_rows($sql_check))
{
echo $email. ' is already in use';
}
else
{
echo 'OK';
}

}
?>