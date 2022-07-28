<?php

session_start();
include('database/newsletterDbconfig.php');
include('database/reservationsDbConfig.php');
$_SESSION['user_id'] = 2;



echo $_SESSION['user_id'];


$errors = array("email"=>'','name'=>'','emailres'=>'','number'=>'');
if(isset($_POST['newsletter'])){

        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = 'Email must be a valid email address';
        }

        if(array_filter($errors)){

        } else {
          $result = setnewsData($email);
          if($result){
            $errors['email'] =  "Subscribed";
        } else {
            echo "Error";
        }
        }
        
    }

    if(isset($_POST['add'])){
      $name = $_POST['name'];
		if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
			$errors['name'] = 'Name must be letters only';
		}
      $number = $_POST['mobilenumber'];
      if(!preg_match('/^[0-9]{10}+$/', $number)){
        $errors['number'] = 'Your mobile number should only be numbers and 10 characters';
      }
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['emailres'] = 'Email must be a valid email address';
      }
      $date2 = $_POST['date'];
      $date = date("Y-m-d H:i:s",strtotime($date2));
      $purpose = $_POST['purpose'];
       $result = setData($name,$id,$number,$date,$email,$purpose);  
      if($result){
          echo "<script>alert('Your reservation has been placed. You will be notified by email or by mobile')";
          header("Location:../UserDash/Reservations/viewMyReservations.php");
      } else {
          echo"Error";
      }
  
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shri raam tex</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="styles/homestyle.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">


</head>
<body>
<?php include('Navbar/userNavbar/home.php'); ?>
        <nav class="navtop">
			<div class="text-center">
				<h1>SHRI RAAM TEX</h1>				
			</div>
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-md-6">
            <div>
            <img src="Admin/AddProducts/picthumb.jpg" class="img-fluid" alt="">

            </div>
          </div>
          <div class="col-md-6">
          <?php if(isset($_SESSION['user_id'])){ ?>
            <form action="Reservation/index.php" method="post">
          <div class="form-input">

            <label for="">Name</label>       
          <div><?php echo $errors['name'] ?></div>
            <input class="form-control" type="text" name="name" placeholder="Your name"><br>
            <label for="">Mobile Number</label>
          <div><?php echo $errors['number'] ?></div>
            <input class="form-control" type="text" name="mobilenumber" placeholder="Your mobile number"><br>
            <label for="">Email</label>       
          <div><?php echo $errors['emailres'] ?></div>
            <input class="form-control" type="text" name="email" placeholder="Your email address"><br>
            <label for="">Date-Time</label>       
            <input type="datetime-local" name="date"><br>


            </div>
            <div class="form-input">
            <label for="purpose"><h5>Please state the purpose of reserving:</h5></label>
            <textarea id="purpose" name="purpose" placeholder="" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="text-center my-2">


            <button type="submit" name="add" class="text-center btn btn-primary">Check for reservation availability</button>
            </div>
            </form>
            <p class="text-center">Please note : Reservations will be confirmed via contacting your mobile and may take upto 2-3 business days to confirm.</p>
            </div>
            </div>
          </form>

       <?php }else { ?>
        <form action="Reservation/index.php" method="post">
          <div class="form-input">

            <label for="">Name</label>       
            <input class="form-control" type="text" name="name" placeholder="Your name" disabled>
            <br>
            <label for="">Mobile Number</label>
            <input class="form-control" type="text" name="mobilenumber" placeholder="Your mobile number" disabled>
            <br>
            <label for="">Email</label>       
            <input class="form-control" type="text" name="email" placeholder="Your email address" disabled>
            <br>
            <label for="">Date-Time</label>       
            <input type="datetime-local" name="date" disabled><br>


            </div>
            <div class="form-input">
            <label for="purpose"><h5>Please state the purpose of reserving:</h5></label>
            <textarea id="purpose" name="purpose" placeholder="" class="form-control" id="" cols="30" rows="5" disabled></textarea>
            </div>
            <div class="text-center my-2">


            <button type="submit"  class="text-center btn btn-primary">Check for reservation availability</button>
            </div>
            </form>
            <p class="text-center">Please note : You must login to book a reservation.</p>
            <a href="UserLogin/Login">Log in</a>
            </div>
            </div>
          </form>
       <?php }?>
        </div>
      </div>
		</nav>
    <section class="contact py-5">
  <div class="container py-5">
    <div class="row">
      <form action="" method="post">

      <div class="col-lg-9 m-auto text-center">
        <h1>Need more updates?</h1>
        <?php if(isset($_SESSION['user_id'])){?>
          <p>Drop your Email-Address below</p>
          <div><?php echo $errors['email'] ?></div>

          <input type="text"  placeholder ="-Enter your Email"name="email" value="">
          <button name ="newsletter" class="btn2">Submit</button>
        <?php } else { ?>

          <p>Please login for subscription and enter your email for subscription</p>

          <input type="text" placeholder ="-Enter your Email" name="email" value="" disabled>
          <button class="btn2" disabled>Submit</button>
     <?php   } ?>
        
      </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-11">
      <div class="row text-center">
        
        <div class="col-lg-6 py-3">
          <h5>Why choose us</h5>
          <p>In the market</p>
          <p>Understanding customer</p>
          <p>Taking actions on them</p>

        </div><div class="col-lg-6 py-3">
          <h5>Social Media</h5>
          <span><i class="fab fa-facebook"></i></span>
          <span><i class="fab fa-instagram"></i></span>
          <span><i class="fab fa-twitter"></i></span>


        </div>
      </div>
    </div>
    <hr>
    <p class="text-center text-light">Copyright All rights reserved</p>
  </div>
</section>

    <div class="container">Hello world</div>
    <div class="row">
        <div class="col-md-3">
        <div id="welcomeDiv"  style="display:none;" class="answer_list" >
        <input type="button" class="btn btn-primary d-flex" name="hide" value="Hide Chatbot" onclick="hideDiv()" />
     <button onclick="hideDiv()"><i class="fab fa-facebook"></i></button>

        
        <iframe 
        allow="microphone;"
        width="350"
        height="400"
        src="https://console.dialogflow.com/api-client/demo/embedded/e60e3f04-e6b6-4ad0-b131-623f498402d1">
        </iframe>
        
        </div>
        </div>
    </div>
    <button onclick="showDiv()"><i class="fab fa-facebook"></i></button>
<input type="button" class="btn btn-primary" name="answer" id="show" value="Show Chatbot" onclick="showDiv()" />

    

<script src="bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>

</body>
<script src="fontawesome-free-5.15.4-web/js/all.js"></script>

<script>
function showDiv() {
   document.getElementById('welcomeDiv').style.display = "block";
   document.getElementById('show').style.display = "none";
}
function hideDiv() {
   document.getElementById('welcomeDiv').style.display = "none";
   document.getElementById('show').style.display = "block";
}
</script>
</html>