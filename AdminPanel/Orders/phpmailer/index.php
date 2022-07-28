<?php
require '../phpmailer/include/PHPMailer.php';
require '../phpmailer/include/SMTP.php';
require '../phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = "true";

$mail->SMTPSecure = "tls";

$mail->Port = 587;

$mail->Username = 'tanusheduresource@gmail.com';

$mail->Password = 'alaporan';

$mail->Subject = 'Email verification';

$mail->isHTML(true);

$mail->setFrom('tanusheduresource@gmail.com');

$mail->Body ="<a href='http://localhost/ADD%20to%20cart/User/verifyPage.php'>Register</a>";

$mail->addAddress("tanush0525@gmail.com");


// echo 'Message has been sent';

if($mail->Send()){
    echo"Login";
} else {
    echo "Error";
}

$mail->smtpClose();






?>