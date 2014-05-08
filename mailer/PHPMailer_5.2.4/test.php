<?php
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");
require_once('./class.phpmailer.php');
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "coolvk01@gmail.com";
$mail->Password = "a9419170652";
$mail->SetFrom("coolvk01@gmail.com");
$mail->Subject = "Test";
$mail->Body = $body;
$mail->AddAddress("coolvk01@live.com");
$mail->ClearAllRecipients( );
$mail->AddAddress("coolvk01@yahoo.in");
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }
	?>    