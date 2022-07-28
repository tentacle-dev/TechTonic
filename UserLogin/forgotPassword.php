<?php
require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include('../database/userDbconfig.php');

    $email ='';
    $error =['email'=>'','user'=>''];
    if(isset($_POST['submit'])){
    $code = random_int(100000,999999);

        $email = $_POST['email'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error['email'] = 'Email must be a valid email address';
		}
        if(array_filter($error)){
			
        }else{
            $result = forgetPass($email,$code);
            if($result){
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = "true";

            $mail->SMTPSecure = "tls";

            $mail->Port = 587;

            $mail->Username = "texshriraam@gmail.com";

            $mail->Password = 'xmtbxtrpvwrjwadh';

            $mail->Subject = 'Email verification';

            $mail->isHTML(true);

            $mail->setFrom('texshriraam@gmail.com');

            $mail->Body ="<h1>Forget Password Verification token</h1><br><h3>Your forget password verification token is</h3><h1>$code<h1><div>Do not share this code with anyone.</div>";

            $mail->addAddress($email);


            // echo 'Message has been sent';

            if($mail->Send()){
              header("Location: verifyforgetpassword.php");
             $mail->smtpClose();

            } else {
                echo "Error";
            }

             $mail->smtpClose();
             
                
            } else {
            $error['user'] ="No emails associated with this account";
            }
        }

       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.css">

<style>
        .card {
    width: 350px;
    padding: 10px;
    border-radius: 20px;
    background: #fff;
    border: none;
    height: auto;
    position: relative
}

.container {
    height: 100vh
}

body {
        background-image: url("../images/forgot.jpg");
        background-color: #cccccc;
        background-repeat: no-repeat;
        background-size: auto;
    }




.mobile-text {
    color: #989696b8;
    font-size: 15px
}

.form-control {
    margin-right: 12px
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #ff8880;
    outline: 0;
    box-shadow: none
}

.cursor {
    cursor: pointer
}
        </style>

    
</head>
<body>
    
    <div class="d-flex justify-content-center align-items-center container">
    <form action="" method="post">
    <div class="card py-5 px-3">
        <h5 class="m-0"><i class="fas fa-key"></i> Forgot your password</h5>
        <p>Don't you worry, we will able to log back in. This happens to all of us.</p>
        <span class="mobile-text">Please enter your email address <i class="fas fa-envelope"></i>
        <div class="text-center">

        <div class="d-flex flex-row mt-5 text-center"><input type="text" name="email" value="<?php echo $email?>"required class="form-control" autofocus="">
    <div>
        <?php echo $error['email'] ?>
        <?php echo $error['user'] ?>

    </div></div>
        <button type="submit" class="btn btn-primary mt-4 form-control" name="submit">Send email</button>
        </div>
        <div class="text-center mt-5"><span class="d-block mobile-text">Remembered the password?</span><a href="http://localhost/SRT/UserLogin/login.php"><span class="font-weight-bold text-danger cursor">Login</span><a></div>
    </div>
    </form>
</div>

    <script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>
    <script src="../fontawesome-free-5.15.4-web/js/all.js"></script>

</body>
</html>