<?php 
    
session_start();
include('../database/userDbconfig.php');

$error = '';

if(isset($_POST['login'])){
    $username = $_POST['email'];
    $password = $_POST['password'];
    $user = userLogin($username,$password);
    if($user){
        $isUser = isUSER($username);
        if($isUser){
            header("Location: ../index.php");
        } else{
            header("Location: ../AdminPanel/MainDashboard/dashboard.php");
        }
        } else {
            $error = 'Invalid Username or Password';
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
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="shortcut icon" type="image/x-icon" href="../styles/assets/images/Blue_bag.svg" />

    <style>
        <?php include('style/loginStyle.php'); ?>
    </style>

    <title>Login</title>
  </head>
  <body>
      <section class="form my-4 mx-5" id="back">
          <div class="container">
              <div class="row no-gutters">
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-6 px-5 pt-5">
                      <h1 class="py-5" id="heading">S<strong>R</strong>T</h1>
                      <h5 id="white">Sign in to your account</h5>
                      <form action="" method="post">
                          <div class="form-row">
                              <div class="col-md-7">
                                  <input type="email" placeholder="Email-Address" name="email" value="" class="form-control" required>
                              </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-7">
                                <input type="Password" placeholder="Password" name="password" class="form-control" placeholder="******************" value="" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-7 mt-3 mb-5">
                                <div class="errormsgs">
                                    <?php echo $error;?>
                                </div>
                                   <button type="submit" class="btn1" name="login">Login</button>
                                </div>
                            </div>
                            
                        </div>
                      </form>
                         <a id="white" href="http://localhost/bcs-project/UserLogin/forgotPassword.php">Forgot Password</a>
                            <p id="white" id="white">Dont't have an account?<a href="http://localhost/bcs-project/UserLogin/registration.php">Register</a></p>
                  </div><div class="col-md-3" id="welcome">
                  </div>
              </div>
          </div>
      </section>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

