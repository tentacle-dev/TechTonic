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
                $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>$quantity);
                $_SESSION['cart'][$count] = $item_array;  
                print_r($_SESSION['cart']) ;
                }
            }
        } else {
            $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>1);
            $_SESSION['cart'][0] = $item_array;
        }
}

?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Shri raam tex.</title>

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
    <style>
        .product-image img{
            object-fit: cover;
            width: 100%;
            height: 250px;
        }
    </style>


</head>

<body>
    <?php include('templates/count.php') ?>
    <?php include('templates/header.php') ?>
 
    <?php 
        include('templates/filter.php')
        ?>
		
	<div class="container mt-4">
        <div class="row mt-5 text-center">
            
        
               <div class="row">
               <?php 
                    include('database/dbconn.php');
                    if(isset($_GET['key'])){
                      $search = $_GET['key'];
                    $stmt = $conn->prepare("SELECT * FROM product WHERE product_tags LIKE '%$search%'");
                    } else {
                    $stmt = $conn->prepare("SELECT * FROM product");
                    }
                   $stmt->execute();

                    while($row = $stmt->fetch()){

                ?>
                <div class="col-lg-3 col-md-6">
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="AddProducts/Thumbnail/<?php echo $row['product_thumbnail'] ?>" alt="#">
                            <div class="button">
                                        <form action="" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                            <input type="hidden" name="product_quantity" value="1">

                                            <button type="submit" name="add" class="btn">
                                            <i class="lni lni-cart"></i> Add to cart
                                            </button>
                                        </form>
										<!-- <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a> -->
									</div>
                        </div>
                        <div class="product-info">
                            <h4 class="title">
                                <a href="viewSingleProduct.php?prod_id=<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></a>
                            </h4>
                            
                            <div class="price">
                                <span><?php echo $row['product_price'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                </div>
                <?php
                    }

                ?>
                   
               </div> 
        </div>
    </div>
    <script src="styles/assets/js/bootstrap.min.js"></script>
    <script src="styles/assets/js/tiny-slider.js"></script>
    <script src="styles/assets/js/glightbox.min.js"></script>
    <script src="styles/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>