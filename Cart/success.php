<?php

session_start();
require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//echo $_SESSION['checkout_id'];
include('../database/paymentDbconfig.php');

$id = $_SESSION['checkout_id'];
$email = $_SESSION['email'];


$result = updCheckout($id);

if($result){
    
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = "true";

            $mail->SMTPSecure = "tls";

            $mail->Port = 587;

            $mail->Username = "texshriraam@gmail.com";

            $mail->Password = 'shriraamtex';

            $mail->Subject = "Email verification";

            $mail->isHTML(true);

            $mail->setFrom('texshriraam@gmail.com');

            $mail->Body ="<h1>Your order has been placed successfully.</h1><br><p>You can view your order by clicking the link below.</p><a href='http://localhost/SRT/UserDash/Orders/viewMySingleOrder.php?order_id=$id'>View your order</a><p>You will recieve the products at any moment. Make sure you place a review and tell the others on how you feel.</p></div>";

            $mail->addAddress($email);

            if($mail->Send()){
                unset($_SESSION['checkout_id']);
                unset($_SESSION['email']);
                unset($_SESSION['cart']);
            } else {
                echo "Error";
            }

            $mail->smtpClose();
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = "true";

            $mail->SMTPSecure = "tls";

            $mail->Port = 587;

            $mail->Username = "texshriraam@gmail.com";

            $mail->Password = 'shriraamtex';

            $mail->Subject = "New Order has been placed";

            $mail->isHTML(true);

            $mail->setFrom('texshriraam@gmail.com');

            $mail->Body ="<h1>A new order has been placed</p></h1><a href='http://localhost/srt/AdminPanel/Orders/newOrders.php'>View the order</a></div>";

            $mail->addAddress('tanusheduresource@gmail.com');

            if($mail->Send()){
                header('Location:../default.php');
            } else {
                echo "Error";
            }

            $mail->smtpClose();

    
    
} else {
    echo "Error making the payment";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success page</title>
</head>
<body>
    
</body>
</html>