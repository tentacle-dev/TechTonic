<?php

include('../database/paymentDbconfig.php');
require '../StripeAPI/vendor/stripe/stripe-php/init.php';

$errors = array('name'=>'','number'=>'','email'=>'');

if(isset($_POST['checkout'])){ 



    
    $user_id = $_SESSION['user_id'];
    $username = "Peiris";
    $total = $_POST['final'];
    $amount = $total * 100;
    $prod = $_POST['name'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
			$errors['name'] = 'Name must be letters only';
		}
    $address = $_POST['address'];
    $mobilenumber =$_POST['mobile'];
    if(!preg_match('/^[0-9]{10}+$/', $mobilenumber)){
			$errors['number'] = 'Your mobile number should only be numbers and 10 characters';
		}
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'Email must be a valid email address';
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

    $checkout_id = setCheckout($user_id,$username,$total,$discount,$coupon);
    $_SESSION['checkout_id'] = $checkout_id;
    include('../database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM product");      
        $result = $stmt->execute();
       

        while($row = $stmt->fetch()){

            if(isset($_SESSION['cart']));
            foreach($_SESSION['cart'] as $key=>$value){  
            $productid = $value['product_id'];

                if($row['prod_id'] == $productid){
                         
                    $availQuantity = $row['product_quantity'];
                    $quantity = $value['product_quantity'];
                    $indPrice = $row['product_price'];
                    $totalval = (int)$quantity * (int)$indPrice;
                    $quantity_to_update = (int)$availQuantity - (int)$quantity;
                    setOrders($checkout_id,$productid,$user_id,$quantity,$totalval,$quantity_to_update);

    }
}
}


  

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
  'success_url' => 'http://localhost/srt/Cart/success.php',
  'cancel_url' => 'https://example.com/cancel',
]);
}



?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body> -->
  

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  var stripe = Stripe('pk_test_51JRLgcKAow1Nk4KwEilbLtO6UOu0E4BoxON2c5LkGlGLZspg5fY1iFf6N8bykn17xtXsiapPJsr6r10T8sN1raMX0064ch9QhI');
  var session = "<?php echo $session['id'];?>";

  stripe.redirectToCheckout({sessionId:session})
</script>

</body>
</html>




?>