<?php
session_start();

if(isset($_POST['remove'])){

    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo '<script>alert("Product has been removed")</script>';                    
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
//include('purchase.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">


</head>
<body>
    <div class="text-center">
        <a href="index.php">Home</a>
    </div>
<div class="col-md-10 offset-md-1 border-rounded mt-5 bg-white h-25 text-center">
   
            <div class="pt-4 text-center">
                <h6>Price details</h6>
                <hr>
                <div class="row price-details">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Have a coupon?</label>
                        <input type="text" name="promo" id="">
                        <button type="submit" class="btn btn-danger" name="promobtn">Check Availability</button><br>
                    </div>
                    <?php
                    if(isset($_POST['promobtn'])){
                        $code = $_POST['promo'];
                        include('../database/promoDbconfig.php');
                        $results = getPromoValue($code);
                        if($results){?>
                        <h6 id="percentage"><?php echo $results;?></h6>
                            
                        <?php } else {
                            echo "No promo available";
                        }
                    }
                    
                    
                    ?><br>
                </form>

                    <div class="col-md-6">
                        <?php
                        if(isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo"<h6>Price($count items)<h6>";
                        } else {
                            echo"<h6>Price (0 items)<h6>";
                        }
                        ?>                        
                        <hr>
                        <h6>Total Amount</h6>
                        <h6>Discounts (if any)</h6>
                        <hr>
                        <h6>Amount Payable(after discounts)</h6>

                            <!-- <input type="hidden" name="total" value="<?php echo $total;?>"> -->
                        
                        
                    </div>
                    <div class="col-md-6"> 
                        <h6>Check for coupons (if any)</h6>    
                        <hr>
                        <h6 id="paytotal">0</h6>
                        <h6 id="rate">0</h6>
                        <hr>
                        <h6 id="amount">0</h6>                                    
                    </div>
                </div>
            </div>
    <form action="purchase.php" method="POST" class=""> 

                    <div class="mb-3">
                        <input type="hidden" id="myField" class="text-center" name="final" >
                        <input type="hidden" id="test" class="text-center" name="coupontotal" >
                    </div>
                        <div class="mb-3">          
                            <label for="Name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" id="Name" required>
                        </div> 
                        <div class="mb-3">          
                            <label for="Number" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" name ="mobile" id="Number" required>
                        </div>
                        <div class="mb-3">          
                            <label for="address" class="form-label">Shipping Address</label>
                            <input type="text" name="address" class="form-control" id="address" required>
                        </div>                       

            <button type="submit" name="checkout" class="btn btn-outline-success" ><i class="fab fa-cc-stripe"></i> Checkout</button>

            </form>
        </div>
<div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border-rounded my-5 bg-light">
                <h1>MY CART</h1>
            </div>
            <div class="col-md-7">

<div class="">
      <?php

    try{
        include('../database/dbconn.php');

        $stmt = $conn->prepare("SELECT * FROM product");      
        $result = $stmt->execute();

        $total=0; 

        while($row = $stmt->fetch()){

            if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key=>$value){           
                $productid =  $value['product_id'];
                $currentquantity = $value['product_quantity'];

                if($row['prod_id'] == $productid){?>
                    
                   <?php $productid = $row['prod_id']; ?>
                   <?php $productname = $row['product_name'];?>
                   <?php $productprice = $row['product_price'];?>                                
                   <?php $productquantity = $row['product_quantity']?>

                   <!-- <?php echo "<p><input name='product_name[]' type='text' value='$productname'" ?> -->
                   <!-- <?php $total = $total + (int)$row['product_price'];?> -->


                   
                   <div
                   class="border rounded">
           <div class="row bg-white">
               <div class="col-md-3 pl-0">
                   <img 
                   src="../AddProducts/Thumbnail/<?php echo $row['product_thumbnail']?>" alt="Image1" 
                   class="img-fluid">
               </div>
               <div class="col-md-6">
               <!-- <input type="hidden" name="productname[]" value="$productname"> -->
                   <h6 class="pt-2"><?php echo $productname;?></h6>                                
                   <h6 class="pt-2"><?php echo $productprice;?></h6>                   

                   <?php echo "<p><input type='hidden' class='iprice' value='$productprice'>"?>
                   <form action="" method="post">
                   <?php echo "<input type='number' class='iquantity' name='Mod_quantity' value='$currentquantity' onchange='this.form.submit();' min='1' max='$productquantity'>" ?>
                   <?php echo "<input type='hidden' name='idcart' value='$productid'>"?>
                   </form>
                   <form
                    action="cart.php?action=remove&id=<?php echo $row['prod_id']; ?>" 
                    method="post" 
                    class="cart-items"
                    >

                   <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                   <h5>Sub Total</h5>                                
                   <h6 class="itotal">0</h6>
                   
               </div>
           </div>
       </div>                    
               </form>

               <?php }
            }

      } else {?>
          <p>Cart is empty</p>
      <?php }
    }
    }catch(PDOException $e) {
        echo  "Error".$e->getMessage();
    } 
    ?>    
            </div>
</div>
        </div>
    </div>

</body>
<script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>
<script>

    var gt=0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
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


</html>
