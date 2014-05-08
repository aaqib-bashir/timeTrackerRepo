<?php
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");
include('db.php');
require_once('./PHPMailer_5.2.4/class.phpmailer.php');
if (isset($_POST['str'])&& isset($_POST['weekend']) && isset($_POST['current_date'])){
$id=explode(",",$_POST['str']);
//echo print_r( $id);
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "timetrackerfov@gmail.com";
$mail->Password = "fovtimetracker";

$sql="select * from task";
$current_date = $_POST['weekend'];
//echo $current_date;
//$d = strtotime( $current_date . " -1 week" );
$weekend = $_POST['current_date'] ;
//echo $weekend;
for($i=0;$i<sizeof($id);$i++){
$sql1 ="select userid,name,email from user where userid='$id[$i]'";
$rec1=mysql_query($sql1);
$sub="Time Tracker Alert";
$mail->SetFrom("timetrackerfov@gmail.com");
$mail->Subject = $sub;

while($row = mysql_fetch_array($rec1)){
	$body="<html><body><h1>Time Tracker<h1>";
	$userid=$row['userid'];
	//echo $userid;
	$username=$row['name'];
	$email=$row['email'];
	$body=$body."<h2>Hello ".$username."<h2><br>";
	$mail->ClearAllRecipients();
	$mail->AddAddress($email);
	$sql2 ="select * from task where userid='$userid' and startdate between '$weekend' and '$current_date' group by taskname";
	$rec2=mysql_query($sql2);
	if(mysql_num_rows($rec2))
{
	
	$body=$body."<p>Here are Your pervious task From '$current_date' to '$weekend' :<p><br>";
	$body=$body."<table>
	<tr>
	<th>taskname<th>
	<th>project<th>
	<tr>";
	while($row2 = mysql_fetch_array($rec2)){
		
		$body=$body."<tr><th>".$row2['taskname']."<th>";
		$body=$body."<th>".$row2['project']."<th><tr>";
		}
		$body=$body."</table></body></html>";
		$mail->Body=$body;
		$mail->Send();
		//echo $body;
}
else{
	$body=$body."<p>You have Not added any Task from '$current_date' to '$weekend' <p></body></html>";
	$mail->Body=$body;
	$mail->Send();
	//echo $body;
	}
	
	}
}
echo "mail send";
}
else
{
	echo "select email first";
	}
?>