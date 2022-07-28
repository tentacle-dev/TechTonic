<?php
session_start();

include('database/paymentDbconfig.php');

if(isset($_SESSION['wishlist'])){
$wishlistcount = count($_SESSION['wishlist']);
    if($wishlistcount == 0){
        unset($_SESSION['carwishlistt']);
    }
}

if(isset($_POST['remove'])){

    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['wishlist'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['wishlist'][$key]);
                header("Location:wishlist.php");
            }
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
    <title>Shri raam tex.</title>

    <link rel="stylesheet" href="styles/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles/assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="styles/assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="styles/assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="default/css/styles.css" />
    <link rel="stylesheet" href="styles/assets/css/main.css" />
    <link rel="stylesheet" href="Cart/displaystyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="styles/assets/images/Blue_bag.svg" />

    <style>
        img{
            width:300px;
            height:200px;
            object-fit:contain;
        }
    </style>


</head>
<body>
<?php include('templates/count.php') ?>

<?php include('templates/header.php') ?>
    <!-- End Header Area -->

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Wishlist</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper mt-sm-5 bg-white">
        <div class="text-center">
        <?php if(isset($_SESSION['wishlist'])){?>

            <h1>My wishlist</h1>
            

        </div>

        

        
        <?php
        } else { ?>
            
        <h1>Your wishlist is empty</h1>

        <?php }?>
        <?php
        $wishc = count($_SESSION['wishlist']);
        if($wishc == 0){ ?>
            <h1 class="text-center text-danger">Wishlist is empty</h1>
        <?php
        } else {
        }
        ?>
        <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 border-top border-end p-sm-4 p-2">
                <div id="products-list" class="bg-light me-sm-3">
                    <?php
                     try{
                         include('database/dbconn.php');
                        $stmt = $conn->prepare("SELECT * FROM product WHERE product_quantity>0 AND product_status='Active'");      
                        $result = $stmt->execute();
                        $total=0; 
                        if(isset($_SESSION['wishlist'])){

                        while($row = $stmt->fetch()){
                            foreach($_SESSION['wishlist'] as $key=>$value){           
                                $productid =  $value['product_id'];
                                if($row['product_id'] == $productid){?>
                                <?php $productid = $row['product_id']; ?>
                                <?php $productname = $row['product_name'];?>
                                <?php $desc = $row['product_description'];?>
                                <?php $productprice = $row['product_price'];?>                                
                                <?php $productquantity = $row['product_quantity']?>
                                <?php $productimage = $row['product_thumbnail'] ?>
                                <div class="row product bg-white shadow-sm m-sm-4 m-2">
                        <div class="col px-sm-3 px-2 pt-3 d-flex justify-content-center"> 
                        <form action="" method="post">

                            <img src="AddProducts/Thumbnail/<?php echo $productimage ?>" alt="" class="product-img"> </div>
                        <div class="col px-sm-3 px-2 pt-3">
                            <div class="d-flex flex-column justify-content-between">
                                 <a href="viewSingleProduct.php?prod_id=<?php echo $productid ?>" class="text-decoration-none"><?php echo $productname ?></a>
                                <div class="d-flex">
                                    <div class="d-flex flex-column w-50">
                                        <div class="font-weight-bold">Price:</div>
                                        <br>
                                    </div>
                                    
                                    <div class="d-flex flex-column w-50">
                                    <?php echo "<input type='hidden' class='iprice' value='$productprice'>"?>

                                        <div class="text-muted"><?php echo $productprice ?>
                                        </div>
                                            <div class="d-flex align-items-center">
                                            <?php echo "<input type='hidden' name='idcart' value='$productid'>"?>
                                            
                                                <br>
                                            </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column w-50">
                                        <div class="font-weight-bold">Description:</div>
                                        <br>
                                    </div>
                                    
                                    <div class="d-flex flex-column w-50">
                                    <?php echo "<input type='hidden' class='iprice' value='$productprice'>"?>

                                        <div class="text-muted"><?php echo $desc ?>
                                        </div>
                                            <div class="d-flex align-items-center">
                                            <?php echo "<input type='hidden' name='idcart' value='$productid'>"?>
                                            
                                                <br>
                                            </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column w-50">
                                        <div class="font-weight-bold">Tags:</div>
                                        <br>
                                    </div>
                                    
                                    <div class="d-flex flex-column w-50">
                                    <?php echo "<input type='hidden' class='iprice' value='$productprice'>"?>

                                        <div class="text-muted">
                                        <?php foreach(explode(',',$row['product_tags']) as $tags){ ?>
                                        <li><a href="search.php?key=<?php echo htmlspecialchars($tags) ?>"><?php echo htmlspecialchars($tags) ?></a></li>
                                    <?php } ?>
                                        </div>
                                            <div class="d-flex align-items-center">
                                            <?php echo "<input type='hidden' name='idcart' value='$productid'>"?>
                                            
                                                <br>
                                            </div>
                                    </div>
                                </div>
                                
                                
                                </div>
                        </div>
                        </form>

                        <div class="d-flex justify-content-end">
                        
                        <form
                    action="wishlist.php?action=remove&id=<?php echo $row['product_id']; ?>" 
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
                            <a href="default.php">Check for products</a>
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
        </div>
        </div>
    </div>
                </div>
                </div>
</body>
<script src="Bootstrap/bootstrap-5.0.1/dist/js/bootstrap.bundle.js"></script>
<script src="fontawesome-free-5.15.4-web/js/all.js"></script>
<script src="../styles/assets/js/bootstrap.min.js"></script>
    <script src="../styles/assets/js/tiny-slider.js"></script>
    <script src="../styles/assets/js/glightbox.min.js"></script>
    <script src="../styles/assets/js/main.js"></script>

</html>