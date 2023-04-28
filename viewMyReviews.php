<?php 

session_start();

if(isset($_SESSION['cart'])){
    $count=  count($_SESSION['cart']);
} else {
    $count = 0;
}
if(isset($_POST['hide'])){
    include('database/reviewDbconfig.php');
    $rev = $_POST['reviewID'];
    $result = delReview($rev);
    if($result){

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

    

    <!-- Start Trending Product Area -->
    <section class="trending-product section" style="margin-top: 12px;">
        <?php
        include('database/dbconn.php');
        $userid = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * FROM review AS rev INNER JOIN product AS product ON rev.product_id = product.product_id WHERE rev.user_id = $userid AND status='HIDDEN'" );
        $stmt->execute();
        $revcount = $stmt->RowCount();
        if($revcount > 0 ){

        while($row = $stmt->fetch()){
            $date = $row['reviewed_at'];
            $productname = $row['product_name'];
            $prodid = $row['id'];

            ?>
                   <div class="container">
                   <div class="single-product mt-3">
                        <div class="product-image">
                            
                        </div>
                        <div class="product-info">
                            <div class="row">
                                <div class="col-md-10">
                                    <span class="category">Your review on <?php echo $productname ?> on <?php echo $date ?></span>
                                </div>
                                <div class="col-md-2">
                                    <form action="" method="post">
                                        <input type="hidden" name="reviewID" value="<?php echo $prodid ?>">
                                        <button type="submit" name="hide" class="btn btn-danger">Delete review</button>

                                    </form>
                                </div>
                            </div>
                            
                            <h4 class="title">
                                <div class="row price">
                                        <div>
                                            <?php echo $row['description'] ?>
                                        </div>
                                </div>
                                
                                <div class="row price">
                                            <span>You rated : <?php echo $row['rating'] ?> / 5</span>
                                </div>
                            </h4>
                            
                            <div class="price">
                                <a href="viewSingleProduct.php?prod_id=<?php echo $row['product_id'] ?>">View Product</a>
                            </div>
                        </div>
                    </div>
                   </div>

    <?php
    }
} else { ?>
    <div class="container">
        <h1 class="text-center text-primary">You have not reviewed on any product</h1>
    </div>
    <?php
}
    ?>

    </section>
    <!-- End Trending Product Area -->
                    
    <!-- Start Call Action Area -->
    
    <!-- End Call Action Area -->

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
                        <span>On every order</span>
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

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer-logo">
                                <a href="index.html">
                                    <img src="assets/images/logo/white-logo.svg" alt="#">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="footer-newsletter">
                                <h4 class="title">
                                    Subscribe to our Newsletter
                                    <span>Get all the latest information, Sales and Offers.</span>
                                </h4>
                                <div class="newsletter-form-head">
                                    <form action="" method="POST" class="newsletter-form">
                                        <input name="emailnews" placeholder="Email address here..." type="email">
                                        <div class="button">
                                            <button class="btn" name="newsletter">Subscribe<span class="dir-part"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>Get In Touch With Us</h3>
                                <p class="phone">Phone: +1 (900) 33 169 7720</p>
                                <ul>
                                    <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer our-app">
                                <h3>Our Mobile App</h3>
                                <ul class="app-btn">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-apple"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">App Store</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-play-store"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">Google Play</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Information</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Downloads</a></li>
                                    <li><a href="javascript:void(0)">Sitemap</a></li>
                                    <li><a href="javascript:void(0)">FAQs Page</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Shop Departments</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                                    <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                                    <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                                    <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                                    <li><a href="javascript:void(0)">Headphones</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-12">
                            <div class="payment-gateway">
                                <span>We Accept:</span>
                                <img src="assets/images/footer/credit-cards-footer.png" alt="#">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright">
                                <p>Designed and Developed by<a href="https://graygrids.com/" rel="nofollow"
                                        target="_blank">GrayGrids</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="socila">
                                <li>
                                    <span>Follow Us On:</span>
                                </li>
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
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
    
    
</body>

</html>