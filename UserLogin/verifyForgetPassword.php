<?php
include('../database/userDbconfig.php');
$error= "";
$vkey="";
if(isset($_POST['verify'])){

    $vkey = $_POST['code'];
    $result = verify($vkey);
    if($result){
        header("Location:resetpassword.php");
    } else {
        $error = "Invalid Verification token. Please try again";
    }
      
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification token</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
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

        background-image: url("../images/verfor.jpg");
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
    <!-- <div class="container text-center">
        <div class="row"><div class="mt-5">
            <h1>Email Verification</h1>
            <p>Verification code has been sent to your email address. Please enter
          the 6-digit verification code and proceed.</p>
            <form action="" method="POST">
                <h4>Please enter the verification token</h4><br>
                <div class="text-center">
                <input type="text" class="form-input" name="code" value="<?php echo $vkey?>"required><br>
                </div>
                <div class="text-danger"><?php echo $error?><br>
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary mt-2" name="verify">Verify</button>

                </div>         
            </form>
        </div></div>
    </div> -->
    <div class="d-flex justify-content-center align-items-center container">
    <form action="" method="post">
    <div class="card py-5 px-3">
        <h5 class="m-0">Email Verification</h5><span class="mobile-text">Verification code has been sent to your email address. Please enter
          the 6-digit verification code and change your password.
        <div class="text-center">

        <div class="d-flex flex-row mt-5 text-center"><input type="text" name="code" value="<?php echo $vkey?>"required class="form-control" autofocus="">
    <div>
        <?php echo $error ?>
    </div></div>
        <button type="submit" class="btn btn-primary mt-4 form-control" name="verify">Verify</button>
        </div>
        <div class="text-center mt-5"><span class="d-block mobile-text">Don't receive the code?</span><a href="codeagn.php"><span class="font-weight-bold text-danger cursor">Resend</span><a></div>
    </div>
    </form>
</div>
</body>
<script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>


</html>