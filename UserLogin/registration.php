<?php
include('../database/userDbconfig.php');


require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    $email = $username = $number = $address = '';
	$errors = array('email' => '', 'username' => '','number' => '','address' => '','password'=>'','exist'=>'');

	if(isset($_POST['register'])){
        
		
		// check email
		
		$email = $_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'Email must be a valid email address';
		}
		// check username
		$username = $_POST['username'];
		if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
			$errors['username'] = 'Username must be letters only';
		}
        

        $address = $_POST['address'];
        if(!preg_match('/[A-Za-z0-9\-\\,.]+/', $address)){
			$errors['address'] = 'Address must be valid';
		}
        $number = $_POST['number'];
        if(!preg_match('/^[0-9]{10}+$/', $number)){
			$errors['number'] = 'Your mobile number should only be numbers and 10 characters';
		}
        $password = $_POST['password'];
        $cpass = $_POST['cpass'];
        if(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$password)){
            $errors['password']="Password must be at least 8 characters and it must contain at least one number and upper and lower case letters";
        } else if($password != $cpass){
            $errors['password']="Passwords don't match";

        }
        

        $updates = $_POST['email_updates'];
       $rand = random_int(100000, 999999);

        $exist = isExist($email);
        if($exist){
            $errors['exist']='A user under the same e-mail address exists.Please try to login in';
        } else {
            if(array_filter($errors)){
			
            }else{
            $password = password_hash($password,PASSWORD_BCRYPT);
            $user_id = setUserData($username,$email,$updates,$number,$address,$password,$rand);
        
        

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
        }
        }

		
	}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="stylereg.css">
    <style>
        <?php include('style/registrationStyle.php') ?>
    </style>

    <title>Register</title>
  </head>
  <body>
      <section class="form">
          <div class="container">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6 px-5 pt-5">
                      <div class="text-center">
                        <h1 class="py-5" id="heading">S<strong>R</strong>T</h1>
                        <h5 id="white">Register for exclusives</h5>
                      </div>
                    <form action="" method="POST">
                          
                          <div class="form-row">
                            <div class="text-danger">
                                <?php echo $errors['exist'];?>
                            </div>

                            <div class="form-input"> <i class="fa fa-envelope"></i> <input type="text" class="form-control" placeholder="Email Address "name="email" value="<?php echo $email ?>" required> </div>
                            <div class="errormsgs">
                                <?php echo $errors['email'];?>
                            </div>
               
                
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="User name" name="username" required value="<?php echo $username ?>"> </div>
                <div class="text-danger errormsgs">
                    <?php echo $errors['username'];?>
                </div>

                <div class="form-input"> <i class="fas fa-mobile"></i> <input type="text" class="form-control" placeholder="Mobile Number" required name="number" value="<?php echo $number ?>"> </div>
                <div class="text-danger errormsgs"  >
                    <?php echo $errors['number'];?>
                </div>

                <div class="form-input"> <i class="fas fa-map-marker"></i><textarea name="address" class="form-control" placeholder="Address" id="" cols="30" rows="10" name="address" value="<?php echo $address?>" required></textarea> </div>
                <div class="text-danger errormsgs">
                    <?php echo $errors['address'];?>
                </div>

                <div class="form-input"> <i class="fas fa-lock"></i> <input type="password" class="form-control" placeholder="Password" id="password" name="password" required><input type="checkbox" onclick="myFunction()"> Show Password </div> 
                <div class="text-light errormsgs">
                    <?php echo $errors['password'];?>
                </div>

                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Confirm Password" required name="cpass"> </div>  

                <div class="form-check">
                <h6 class="mt-3">Would you like to receive email updates</h6>

                <input type="radio" name="email_updates" checked="checked" value="Yes">
                <label for="">Yes</label>

                <input type="radio" name="email_updates" value="No">
                <label for="">No</label><br>

                <div class="form-row text-center">
                       <button type="submit" class="btn1" name="register">Register</button>
</form>
                </div>
                </div>
                            
                        </div>
                         <div class="text-center">
                            <a id="" href="http://localhost/SRT/UserLogin/forgotPassword.php">Forgot Password</a>
                            <p id="" >Dont't have an account?<a href="http://localhost/SRT/UserLogin/login.php">Login</a></p>
                         </div>
                  </div><div class="col-md-3" id="welcome">
                      <h1>Welcome</h1>
                  </div>
              </div>
          </div>
      </section>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
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
</html>