<?php 
session_start();
include('database/dbconn.php');
if(isset($_GET['id'])){
	$id= $_GET['id'];
	
}
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

    <?php include('templates/count.php') ?>
    <!-- Start Header Area -->
    <?php include('templates/header.php') ?>
    <!-- End Header Area -->

    <!-- Start Hero Area -->
    
    
    
    
    <!-- End Hero Area -->
    <?php 
        include('templates/filter.php')
    ?>
    <!-- Start Trending Product Area -->
    <section class="trending-product section" style="margin-top: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <?php
                        include('database/dbconn.php');
                        $stmtname = $conn->prepare("SELECT * FROM main_category WHERE main_category_id = $id");
                        $stmtname->execute();
                        $name = $stmtname->fetch();

                        ?>
                        <h2><?php echo $name['main_category_name'] ?></h2>
                        <p>Know where to shop, because cash does bring joy.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                    include('database/dbconn.php');
					$stmtmain = $conn->prepare("SELECT * FROM sub_category WHERE main_category_id = $id");
					$stmtmain->execute();
					while($row = $stmtmain->fetch()){
					$sid = $row['sub_category_id'];
					$stmtfetch = $conn->prepare("SELECT * FROM product WHERE product_subcategory = $sid");
					$stmtfetch->execute();
					while($prod = $stmtfetch->fetch()){ ?>
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Start Single Product -->
							<div class="single-product">
								<div class="product-image">
									<img src="AddProducts/Thumbnail/<?php echo $prod['product_thumbnail'] ?>" alt="#">
									<div class="button">
                                        <form action="" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $prod['product_id'] ?>">
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
										<a href="viewSingleProduct.php?prod_id=<?php echo $prod['product_id'] ?>"><?php echo $prod['product_name'] ?></a>
									</h4>
									
									<div class="price">
										<span><?php echo $prod['product_price'] ?></span>
									</div>
								</div>
							</div>
							<!-- End Single Product -->
						</div>
<?php					}
							

					} ?>
                    
					<!-- <div class="col-lg-3 col-md-6 col-12">
                     Start Single Product
                    <div class="single-product">
                        <div class="product-image">
                            <img src="AddProducts/Thumbnail/<?php echo $row['product_thumbnail'] ?>" alt="#">
                            <div class="button">
                                <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <span class="category">Watches</span>
                            <h4 class="title">
                                <a href="viewProduct.php?prod_id=<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></a>
                            </h4>
                            
                            <div class="price">
                                <span><?php echo $row['product_price'] ?></span>
                            </div>
                        </div>
                    </div>
                    End Single Product
                </div> -->


			
                
                
            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    <!-- Start Call Action Area -->
    
    
   
    
		
	
    <!-- Start Banner Area -->
    
    <!-- End Banner Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

   
    

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