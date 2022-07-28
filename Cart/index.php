<?php
    
session_start();


if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'],'product_id');
        if(in_array($_POST['product_id'],$item_array_id)){
            echo '<script>alert("Product has already been added")</script>';    
        } else {
            $count = count($_SESSION['cart']);
            if(empty($_POST['product_quantity'])){
                $quantity = 1;
            } else {
            $quantity = $_POST['product_quantity'];
            
            }
            $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>$quantity);
            $_SESSION['cart'][$count] = $item_array;  
            print_r($_SESSION['cart']);
        }
    } else {
        $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>1);
        $_SESSION['cart'][0] = $item_array;
print_r($item_array);

    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../styles/indexstyle.css">

    
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">

</head>
<body>
    <a href="cart.php">Cart</a>
    <a href="../UserDash/userDashboard.php">Dashboard</a>
    <a href="../home.php">Home</a>


    <div class="row">
    <?php
        try{
            include('../database/productDbconfig.php');
            getProducts();

        } catch(PDOException $e) {
            echo  "Error".$e->getMessage();
        }
    ?>
    </div>

<script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>

</body>
</html>