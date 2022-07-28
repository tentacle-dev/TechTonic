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
    <link rel="stylesheet" href="cart.css">


</head>
<body>
    <div class="text-center">
        <a href="index.php">Home</a>
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
            <div class="col-lg-7 col-md-6 border-top border-end p-sm-4 p-2">
               
               <div id="products-list" class="bg-light me-sm-3">
                    <div class="row product bg-white shadow-sm m-sm-4 m-2">
                        <div class="col px-sm-3 px-2 pt-3 d-flex justify-content-center"> <img src="../AddProducts/Thumbnail/<?php echo $row['product_thumbnail']?>" alt="" class="product-img"> </div>
                        <div class="col px-sm-3 px-2 pt-3">
                            <div class="d-flex flex-column justify-content-between"> <a href="#" class="text-decoration-none"><?php echo $productname ?></a>
                            <h6>Hurry only <?php echo $productquantity; ?> pieces left!!!</h6>
                                <div class="d-flex">
                                    <div class="d-flex flex-column w-50">
                                        <div class="font-weight-bold">Price:</div>
                                        <div class="font-weight-bold">Change:</div>
                                        <div class="font-weight-bold">Quantity:</div>
                                        <div class="font-weight-bold">Total:</div>
                                    </div>
                                    <div class="d-flex flex-column w-50">
                                    <?php echo "<input type='hidden' class='iprice' value='$productprice'>"?>
                                        <div class="text-muted">
                                            <?php echo $productprice ?>
                                        </div>
                                        
                                        <form action="" method="post">
                                         <div><?php echo "<input type='number' class='iquantity bg-light number' name='Mod_quantity' value='$currentquantity' onchange='this.form.submit();' min='1' max='$productquantity'>" ?>
                                        </div>
                                         <div>
                                             <h6 class="cquantity bg-light number">0</h6>
                                        </div>
                                        <?php echo "<input type='hidden' name='idcart' value='$productid'>"?>

                                        <div>
                                        <h6 class="itotal">0</h6>

                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="btn btn-dark delete border-0"> <span class="fas fa-trash-alt"></span> </div>
                        </div>
                    </div>
                </div>
                    
                  
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


</html>
