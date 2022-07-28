<?php

$rand= "Thanush";

$email = "texshriraam@gmail.com";

$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = "true";

$mail->SMTPSecure = "tls";

$mail->Port = 587;

$mail->Username = "texshriraam@gmail.com";

$mail->Password = 'xmtbxtrpvwrjwadh';

$mail->Subject = "Email verification";

$mail->isHTML(true);

$mail->setFrom('texshriraam@gmail.com');

$mail->Body ="<h1>Verification token</h1><br><h3>Your verification token is</h3><h1>$rand<h1><div>Do not share this code with anyone.</div>";

$mail->addAddress($email);

if($mail->Send()){
    echo"Login";
} else {
    echo "Error";
}

$mail->smtpClose();

header("Location: verifyAccount.php");

?>