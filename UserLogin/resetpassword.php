<?php

require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    include('../database/userDbconfig.php');

$errors = array('cpass'=>'','password'=>'','email'=>"");
$email = $password = $cpass ='';
if(isset($_POST['resetpassword'])){

    $password = $_POST['password'];
    $cpass = $_POST['cpass'];
    $email = $_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'Email must be a valid email address';
		}

    if(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$password)){
        $errors['password']="Password must be at least 8 characters and it must contain at least one number and upper and lower case letters";
    } else if($password != $cpass){
        $errors['cpass']="Passwords don't match";

    }
    if(array_filter($errors)){
			
    }else{
        $hpass = password_hash($password,PASSWORD_BCRYPT);

        $result = resetPassword($hpass,$email);

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

            $mail->Body ="<h1>Reset Password</h1><br><h3>Your password has been successfully chenged</h3><p>If it's not you please log in<br><a href='http://localhost/SRT/UserLogin/login.php'>Not me</a></p><h4>Do not share the password with anyone for your own security</h4>";

            $mail->addAddress($email);


            // echo 'Message has been sent';

            if($mail->Send()){
                header("Location:login.php");

            } else {
                    echo "Error";
            }

            $mail->smtpClose();
        } else {
            $errors['email'] ="Unknown error occured";
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
    <title>Reset password</title>
    
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.css">
    <style>
        <?php include('style/resetpasswordStyle.php') ?>
        body {
        background-image: url("../images/reset.jpg");
        background-color: #cccccc;
        background-repeat: no-repeat;
        background-size: auto;
    }
    </style>
</head>
<body>
    
<section class="form">
          <div class="container">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6 px-5 pt-5">
                      <div class="text-center">
                        <h1 class="py-5" id="heading">S<strong>R</strong>T</h1>
                        <h5 id="white">Please set a strong password</h5>
                      </div>
<form action="" method="POST">
                          
                        <div class="form-row">
                            <div class="form-input">
                                <i class="fa fa-envelope"></i>
                                    <input type="text" class="form-control" value="<?php echo $email?>" placeholder="Email Address "name="email" required>
                        </div>
                        <div class="errormsgs">
                            <?php echo $errors['email'];?>
                        </div>
                <div class="form-input">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" placeholder="Password"  value="<?php echo $password?>"  id="password" name="password" required>
                    <input type="checkbox" onclick="myFunction()"> Show Password </div> 
                    <div class="text-light errormsgs">
                        <?php echo $errors['password'];?>
                        <?php echo $errors['cpass'];?>

                    </div>

                <div
                    class="form-input">
                    <i 
                    class="fa fa-lock"></i>
                    <input 
                    type="password" 
                    class="form-control" 
                    placeholder="Confirm Password"
                    value="<?php echo $cpass?>"
                    name="cpass"
                    required>
                </div>  



                <div class="form-row text-center">
                       <button type="submit" class="btn1" name="resetpassword">Reset</button>
            </form>
                </div>
                            
                        </div>
                         <div class="text-center">
                            <p id="" ><a href="Login.html">Login</a></p>
                         </div>
                  </div>
              </div>
          </div>
      </section>


    <script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>
    <script src="../fontawesome-free-5.15.4-web/js/all.js"></script>
    <script>

function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>