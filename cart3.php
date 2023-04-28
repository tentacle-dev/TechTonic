<?php
session_start();


include('database/paymentDbconfig.php');
require 'StripeAPI/vendor/stripe/stripe-php/init.php';
$fname = $lname = $address = $email = $number = '';
$errors = array('fname'=>'','lname'=>'','email'=>'','number'=>'');
if(isset($_POST['checkout'])){
    $total = $_POST['final'];
    $stripe = $total * 100;
    $amount = $total * 100;
    $fname = $_POST['fname'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $fname)){
        $errors['fname'] = 'Name must be letters only';
    }
    $lname = $_POST['lname'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $lname)){
        $errors['lname'] = 'Last name must be letters only';
    }
    $address = $_POST['address'];
    
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email must be a valid email address';
    }
    $number = $_POST['number'];
    if(!preg_match('/^[0-9]{10}+$/', $number)){
        $errors['number'] = 'Your mobile number should only be numbers and 10 characters';
    }
    $coupon = $_POST['coupontotal'];
    if($coupon == ''){
      $coupon = $total;
      $amount = $coupon * 100;
      $discount = 0;
      
    } else {
      $discount = (int)$total - (int)$coupon;
      $amount = $coupon * 100;
    }

    if(array_filter($errors)){

    }else{
            
        
        if(isset($_SESSION['user_id'])){
            $user =$_SESSION['user_id'];
         $checkout_id = setCheckout($user,$fname,$lname,$total,$discount,$coupon,$number,$email,$address);


        }else {
         $checkout_id = setCheckoutGuest($fname,$lname,$total,$discount,$coupon,$number,$email,$address);

        }
    $_SESSION['checkout_id'] = $checkout_id;
    $_SESSION['email'] = $email;
    include('database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM product");      
    $result = $stmt->execute();
   

    while($row = $stmt->fetch()){

        if(isset($_SESSION['cart']));
        foreach($_SESSION['cart'] as $key=>$value){  
        $productid = $value['product_id'];

            if($row['product_id'] == $productid){
                     
                $availQuantity = $row['product_quantity'];
                $quantity = $value['product_quantity'];
                $indPrice = $row['product_price'];
                $totalval = (int)$quantity * (int)$indPrice;
                $quantity_to_update = (int)$availQuantity - (int)$quantity;

                if(isset($_SESSION['user_id'])){
                    $user =$_SESSION['user_id'];
                    $success = setOrders($checkout_id,$productid,$user,$quantity,$totalval,$quantity_to_update);
        
        
                }else {
                    $success = setOrdersGuest($checkout_id,$productid,$quantity,$totalval,$quantity_to_update);
        
                }
               

    }
}
    }
    
    
    if($success){
      
\Stripe\Stripe::setApiKey('sk_test_51JRLgcKAow1Nk4KwLXCfMtsH5VhFKiKOBTcRyD4fOse1LWUZtubh1pUmG5uXulwMzx9rPtlbZ77Eple6mAB20VxA00B1OLrkyw');

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'lkr',
      'product_data' => [
        'name' => 'SRT',
      ],
      'unit_amount' => $amount,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost/bcs-project/Cart/success.php',
  'cancel_url' => 'http://localhost/bcs-project/Cart/cancel.php',
]);
} else {
    echo "Err";
}

  
}
}
    ?>


<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  var stripe = Stripe('pk_test_51JRLgcKAow1Nk4KwEilbLtO6UOu0E4BoxON2c5LkGlGLZspg5fY1iFf6N8bykn17xtXsiapPJsr6r10T8sN1raMX0064ch9QhI');
  var session = "<?php echo $session['id'];?>";

  stripe.redirectToCheckout({sessionId:session})
</script>

<?php

if(isset($_SESSION['cart'])){
$count = count($_SESSION['cart']);
    if($count == 0){
        unset($_SESSION['cart']);
    }
     
}

if(isset($_POST['remove'])){

    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                header("Location:cart3.php");
                                    
            }
        }
    }
}

if(isset($_POST['promobtn'])){
    $promo = $_POST['promo'];
    

}

if(isset($_POST['Mod_quantity'])){
    foreach ($_SESSION['cart'] as $key => $value){
        if($value["product_id"] == $_POST['idcart']){
            $_SESSION['cart'][$key]['product_quantity'] = $_POST['Mod_quantity'];           
                             
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
    <title>TechTonic</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="styles/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles/assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="styles/assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="styles/assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="default/css/styles.css" />
    <link rel="stylesheet" href="styles/assets/css/main.css" />
    <link rel="stylesheet" href="styles/displaystyle.css">


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
    <div class="wrapper mt-sm-5 bg-white">

        <div class="text-center">
        <?php if(isset($_SESSION['cart'])){?>

            <h1>My Cart</h1>
            

        </div>

        

        <div class="progresses py-4">
            <ul class="d-flex align-items-center justify-content-between">
                <li id="step-1" class="blue"></li>
                <li id="step-2"></li>
            </ul>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <?php
        } else {?>
        <h1>Cart is empty</h1>

        <?php }?>
        <div class="row">
            <div class="col-lg-7 col-md-6 border-top border-end p-sm-4 p-2">
                <div id="products-list" class="bg-light me-sm-3">
                    <?php
                     try{
                         include('database/dbconn.php');
                        $stmt = $conn->prepare("SELECT * FROM product WHERE product_quantity > 0 AND product_status='Active'");      
                        $result = $stmt->execute();
                        $total=0; 
                        if(isset($_SESSION['cart'])){

                        while($row = $stmt->fetch()){
                            foreach($_SESSION['cart'] as $key=>$value){           
                                $productid =  $value['product_id'];
                                $currentquantity = $value['product_quantity'];
                                if($row['product_id'] == $productid){?>
                                <?php $productid = $row['product_id']; ?>
                                <?php $productname = $row['product_name'];?>
                                <?php $productprice = $row['product_price'];?>                                
                                <?php $productquantity = $row['product_quantity']?>
                                <?php $productimage = $row['product_thumbnail'] ?>
                                <div class="row product bg-white shadow-sm m-sm-4 m-2">
                        <div class="col px-sm-3 px-2 pt-3 d-flex justify-content-center"> 
                        <form action="" method="post">

                            <img src="AddProducts/Thumbnail/<?php echo $productimage ?>" alt="" class="product-img"> </div>
                        <div class="col px-sm-3 px-2 pt-3">
                            <div class="d-flex flex-column justify-content-between"> <a href="#" class="text-decoration-none"><?php echo $productname ?></a>
                                <div class="d-flex">
                                    <div class="d-flex flex-column w-50">
                                        <div class="font-weight-bold">Price:</div>
                                        <div class="font-weight-bold">Number:</div><br>
                                    </div>
                                    <div class="d-flex flex-column w-50">
                                    <?php echo "<input type='hidden' class='iprice' value='$productprice'>"?>

                                        <div class="text-muted"><?php echo $productprice ?>
                                        </div>
                                            <div class="d-flex align-items-center">
                                            <?php echo "<input type='hidden' name='idcart' value='$productid'>"?>
                                            
                                                <?php echo "<input type='number' class='iquantity bg-light number' name='Mod_quantity' value='$currentquantity' onchange='this.form.submit();' min='1' max='$productquantity'>" ?><br>
                                            </div>
                                    </div>
                                </div>
                                <div class="d-flex">

                                <div class="d-flex flex-column w-50">
                                    <div class="font-weight-bold">Quantity :</div>
                                    <div class="font-weight-bold">Value :</div>
                                </div>

                                <div class="d-flex flex-column w-50">
                                    <div>
                                        <h6 class="cquantity bg-light number">10</h6></div>
                                        <div>
                                        <h6 class="itotal">0</h6>
                                    </div>
                                </div>
                                    

                            </div>
                                </div>
                        </div>
                        </form>

                        <div class="d-flex justify-content-end">
                        
                        <form
                    action="cart3.php?action=remove&id=<?php echo $row['product_id']; ?>" 
                    method="post" 
                    class="cart-items"
                    ><button type="submit" class="btn btn-dark delete border-0" name="remove"><span class="fas fa-trash-alt"></span></button>
                        </div>
                    </div>
                                </form>

                            <?php }
                            }

                    } ?>
                    <?php } else { ?>
                        <div class="d-flex justify-content-center">
                            <a href="index.php">Check for products</a>
                        </div>
                        <?php

                    }
                     ?>
                        

                    <?php
                    
                    }catch(PDOException $e) {
                        echo  "Error".$e->getMessage();
                    } 
                    ?>    
                    
                </div>
            </div>
            <div class="col-lg-5 col-md-6 border-top border-start p-sm-4 p-2">
                <div id="billing">
                    <?php
                    if(isset($_SESSION['cart'])){?>

                    
                    <form action="" method="post">
                        <div class="form-group d-flex flex-fill">
                             <input type="text" placeholder="Promo code" class="flex-grow-1 bg-light" name="promo">
                    <button type="submit" name="promobtn" class="btn btn-dark">Redeem</button></div>
                    <?php
                    if(isset($_POST['promobtn'])){
                        $code = $_POST['promo'];
                        include('database/promoDbconfig.php');
                        $results = getPromoValue($code);
                        if($results){?>
                        <div class="text-center">
                            <h6>Percentage is</h6>
                            <h6 id="percentage"><?php echo $results;?></h6>
                        </div>
                            
                        <?php } else { ?>
                            <div class="text-center">
                              <h6>No promo available</h6>
                            </div>

                           <?php
                        }
                    }
                    
                    
                    ?>
                    </form>
                    <form action="" method="post">
                    
                        <input type="hidden" id="myField" class="text-center" name="final" >
                        <input type="hidden" id="test" class="text-center" name="coupontotal" >
                    
                    <div class="d-flex align-items-center flex-fill my-1 mt-4" id="discount">
                        <div class="bg-dark text-white w-50 border-0">Amount</div>
                        <div class="amount text-center w-50 border" id="paytotal"></div>
                    </div><small>

                    Check below if promo is applied
                    </small>

                    <div class="d-flex align-items-center flex-fill my-1 mt-4" id="discount">
                        <div class="bg-dark text-white w-50 border-0">Discounts</div>
                        <div class="amount text-center w-50 border" id="rate" ></div>

                    </div><small>

                    Only if promo code is valid
                    </small>

                    <div class="d-flex align-items-center flex-fill my-1 mt-4" id="total">
                        <div class="bg-dark text-white w-50 border-0">Amount Payable</div>

                        <div class="amount text-center w-50 border" id="amount"></div>

                    </div><small>

                    Price after deduction
                    </small><br><br>
                    <div class="text-center text-primary">
                    Delivery details
                    </div>
                    <hr>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name" name="fname" value="<?php echo $fname;?>" required>
                        <label for="floatingInput">First Name</label>
                        <div class="text-danger"><?php echo $errors['fname'];?></div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name" name="lname" value="<?php echo $lname;?>"  required>
                        <label for="floatingInput">Last Name</label>
                        <div class="text-danger"><?php echo $errors['lname'];?></div>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $email;?>" name="email" required>
                        <label for="floatingInput">Email address</label>
                        <div class="text-danger"><?php echo $errors['email'];?></div>

                        
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingInput1" placeholder="0777032505" name="number" value="<?php echo $number;?>" required>
                        <label for="floatingInput1">Telephone Number</label>
                        <div class="text-danger"><?php echo $errors['number'];?></div>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingInput1" placeholder="0777032505" name="address" value="<?php echo $address;?>" required>
                        <label for="floatingInput1">Address</label>
                    </div>
                    <div class="d-flex justify-content-between text-center mt-4" id="btns">
                        <button type="submit" class="btn btn-primary me-2" name="checkout">Checkout</button>
                        <a href="index.php" class="btn btn-default ms-2" >View products</a>
                        <!-- <div class="btn btn-default ms-2">View products</div> -->
                        <?php 
                    }?>
                    


                    </div>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
                </div>
                </div>
</body>
<script src="Bootstrap/bootstrap-5.0.1/dist/js/bootstrap.bundle.js"></script>
<script src="fontawesome-free-5.15.4-web/js/all.js"></script>
<script>

var gt=0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var cquantity = document.getElementsByClassName('cquantity');

    var itotal = document.getElementsByClassName('itotal');
    var gtotal = document.getElementById('gtotal');
    var paytotal = document.getElementById('paytotal');
    var percentage = document.getElementById('percentage');
    var amount = document.getElementById('amount');
    var rate = document.getElementById('rate');


    function subTotal(){

        gt=0;
        for(i=0;i<iprice.length;i++)
        {
            itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
            gt = gt + (iprice[i].value) * (iquantity[i].value);
            cquantity[i].innerText = iquantity[i].value;
        } 
        paytotal.innerText = gt;

        //value to textbox        
        document.getElementById('myField').value = gt;
        st = gt;
        if(rate == false){
            amount.innerText = st;

        }else {
            distotal = st*(percentage.innerText)/100;
            rate.innerText = distotal;      
            st = st - distotal; 
            amount.innerText = st;
        }
         
        //st = (gt*(100-percentage.innerText)/100);
        //value to textbox        
        document.getElementById('test').value = st;
    
    }

    subTotal();
</script>
<script src="styles/assets/js/bootstrap.min.js"></script>
    <script src="styles/assets/js/tiny-slider.js"></script>
    <script src="styles/assets/js/glightbox.min.js"></script>
    <script src="styles/assets/js/main.js"></script>

</html>