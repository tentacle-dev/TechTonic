<?php

session_start();
include('database/userDbconfig.php');
$errors = array("password" =>"","status"=>"");
if(isset($_POST['reset'])){
    $currentpwd = $_POST['current'];
    
    $valid = checkpwd($currentpwd);
    if($valid){
        $password = $_POST['password'];
        $cpass = $_POST['cpass'];
        if(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$password)){
            $errors['password']="Password must be at least 8 characters and it must contain at least one number and upper and lower case letters";
        } else if($password != $cpass){
            $errors['password']="Passwords don't match";
        }
        if(array_filter($errors)){

        }else {
            $cpass = password_hash($password,PASSWORD_BCRYPT);

            updPassword($cpass);
        }
    }else {
        $errors['status'] = "Sorry! Seems like your current password you entered is wrong!!!";
    }
    
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>TechTonic</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="styles/assets/images/Blue_bag.svg" />

    <!-- ========================= CSS here ========================= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="styles/assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="styles/assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="default/css/styles.css" />
    <link rel="stylesheet" href="styles/assets/css/main.css" />


</head>

<body>


    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div> -->
    <!-- /End Preloader -->

        
    <!-- Start Header Area -->
    <?php include('templates/count.php') ?>
    <?php include('templates/header.php') ?>
    <!-- End Header Area -->

    <!-- Start Hero Area -->


    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
            <div class="single-product text-center">

                <form action="" method="post">
                    
                    <label for="">Current Password:</label>
                    <input class="form-control" type="text" name="current" required>
                
                    <label for="">New Password</label>
                    <input class="form-control" type="text" name="pass" required>
                    <label for="">Confirm New Password </label>
                    <input class="form-control" type="text" name="cpass" required>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning" name="reset">Reset Password</button>
                    </div>



            </form>
            <?php echo $errors['password'] ?>
            <?php echo $errors['status'] ?>

            </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
</div>

    <!-- End Hero Area -->

    <!-- Start Trending Product Area -->

    <!-- End Trending Product Area -->

    <!-- Start Call Action Area -->

    <!-- End Call Action Area -->

		<section>
        <?php

        while($row = $stmt->fetch()){

                $name = $row['First_Name'];
                $lname = $row['Last_Name'];
                $user_mobile = $row['user_mobilenumber'];
                $address =$row['user_address'];
                $upd =$row['user_emailupdates'];
                $id = $row['user_id'];


                ?>
            <div class="container">
            <form action="" method="post">
            <label for="">Name</label>
                                        <input class="form-control" type="text" name="name" value='<?php echo $name?>'>
                                        <label for="">Last name</label>
                                        <input class="form-control" type="text" name="lname" value='<?php echo $lname?>'>
                                        <label for="">Email Updates</label>
                                        <input class="form-control" type="text" name="upd" value='<?php echo $upd?>'>
                                        <label for=""> Mobile Number</label>
                                        <input class="form-control" type="text" name="number" value='<?php echo $user_mobile?>'>
                                        <label for="">Address</label>
                                        <input class="form-control" type="text" name="address" value='<?php echo $address?>'>
                                        <input type="hidden" name="id" value='<?php echo $id?>'>
                                        <div class="text-center">
                                            <button type="submit" name="profile">Update</button>
                                        </div>
                <label for="">Username</label>
                <input type="text">
                <?php } ?>
            </form>
            </div>
        </section>

    <!-- Start Banner Area -->
    <section class="banner section">
        <div class="container">
            <div class="row text-center">

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="single-banner custom-responsive-margin">

                        <div class="content">
                        <form action="" method="post">
                                    <?php while($row = $stmt->fetch()){

                                        $name = $row['First_Name'];
                                        $lname = $row['Last_Name'];
                                        $user_mobile = $row['user_mobilenumber'];
                                        $address =$row['user_address'];
                                        $upd =$row['user_emailupdates'];
                                        $id = $row['user_id'];


                                        ?>
                                        <h1>Hello<?php echo $name?>!</h1>
                                        <label for="">Name</label>
                                        <input class="form-control" type="text" name="name" value='<?php echo $name?>'>
                                        <label for="">Last name</label>
                                        <input class="form-control" type="text" name="lname" value='<?php echo $lname?>'>
                                        <label for="">Email Updates</label>
                                        <input class="form-control" type="text" name="upd" value='<?php echo $upd?>'>
                                        <label for=""> Mobile Number</label>
                                        <input class="form-control" type="text" name="number" value='<?php echo $user_mobile?>'>
                                        <label for="">Address</label>
                                        <input class="form-control" type="text" name="address" value='<?php echo $address?>'>
                                        <input type="hidden" name="id" value='<?php echo $id?>'>
                                        <div class="text-center">
                                            <button type="submit" name="profile">Update</button>
                                        </div>


                                <?php  } ?>

                                </form>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->


    <!-- End Shipping Info -->

    <!-- Start Footer Area -->

    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="styles/assets/js/bootstrap.min.js"></script>
    <script src="styles/assets/js/tiny-slider.js"></script>
    <script src="styles/assets/js/glightbox.min.js"></script>
    <script src="styles/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>