<?php
session_start();
require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include('database/producthistoryDbConfig.php');

include('database/orderDbconfig.php');

if(isset($_SESSION['cart'])){
    $count = count($_SESSION['cart']);

    } else {
    $count = 0;
}


$id =  $_GET['prod_id'];

   

include('database/dbconn.php');


if(isset($_POST['review'])){
    include('database/reviewDbConfig.php');

    $rate = $_POST['rate'];
    $desc = $_POST['description'];
    $prod = $id;
    $user_id = $_SESSION['user_id'];

    $result = setReview($user_id,$prod,$desc,$rate);

    if($result){
            $mail = new PHPMailer();
    
            $mail->isSMTP();
    
            $mail->Host = "smtp.gmail.com";
    
            $mail->SMTPAuth = "true";
    
            $mail->SMTPSecure = "tls";
    
            $mail->Port = 587;
    
            $mail->Username = "texshriraam@gmail.com";
    
            $mail->Password = 'xmtbxtrpvwrjwadh';
    
            $mail->Subject = "New review has been placed";
    
            $mail->isHTML(true);
    
            $mail->setFrom('texshriraam@gmail.com');
    
            $mail->Body ="<h1>A new review has been placed</h1><br><p>You can view the review by clicking the link below.</p><a href='http://localhost/srt/AdminPanel/Reviews/viewReviews.php'>Click here</a></div>";
    
            $mail->addAddress('tanusheduresource@gmail.com');
    
            if($mail->Send()){
                header('Location:default.php');
            } else {
                echo "Error";
            }
    
            $mail->smtpClose();
            } else {
                echo"Error";
            }
    }
    

if(isset($_GET['prod_id'])){
		
		// escape sql chars
        try{
            

        $id =  $_GET['prod_id'];

        $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = :id");      
        $stmt->bindParam(":id",$id);
        $result = $stmt->execute();
        $stmt2 = $conn->prepare("SELECT * FROM product_images WHERE product_id=:prod_id");
        $stmt2->bindParam("prod_id",$id);
        $stmt2->execute();

        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }       
		

}
if(isset($_POST['enquiry'])){
include_once('database/enquiryDbconfig.php');

  $prod_id = $_POST['product_id'] ;
  $user_id = $_SESSION['user_id'];
  $enquiry = $_POST['question'];

  $result = addEnquiry($user_id,$prod_id,$enquiry);
  if($result){
    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->Host = "smtp.gmail.com";

    $mail->SMTPAuth = "true";

    $mail->SMTPSecure = "tls";

    $mail->Port = 587;

    $mail->Username = "texshriraam@gmail.com";

    $mail->Password = 'shriraamtex';

    $mail->Subject = "New enquiry has been placed";

    $mail->isHTML(true);

    $mail->setFrom('texshriraam@gmail.com');

    $mail->Body ="<h1>A new enquiry has been placed</h1><br><p>You can view the enquiry by clicking the link below.</p><a href='http://localhost/srt/AdminPanel/Enquiry/viewNewEnquiry.php'>Click here</a></div>";

    $mail->addAddress('tanusheduresource@gmail.com');

    if($mail->Send()){
        header('Location:default.php');
    } else {
        echo "Error";
    }

    $mail->smtpClose();
    } else {
        echo"Error";
    }
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

if(isset($_POST['wish'])){
    
    if(isset($_SESSION['wishlist'])){
            $item_array_idwishlist = array_column($_SESSION['wishlist'],'product_id');
            if(in_array($_POST['product_id'],$item_array_idwishlist)){
                echo '<script>alert("Product has already been added")</script>';    
            } else {
                $count = count($_SESSION['wishlist']);
                
                $item_arraywishlist = array('product_id'=>$_POST['product_id']);
                $_SESSION['wishlist'][$count] = $item_arraywishlist;  
                
            }
        } else {
            $item_arraywishlist = array('product_id'=>$_POST['product_id']);
            $_SESSION['wishlist'][0] = $item_arraywishlist;
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
    <link rel="stylesheet" href="styles/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles/assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="styles/assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="styles/assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="styles/assets/css/main.css" />
    <link rel="stylesheet" href="styles/ratingstyle.css" />
    <link rel="stylesheet" href="styles/scrollbar.css" />
    <style>
        
        .product-images .main-img img{
            object-fit: cover;
            width: 100%;
            height: 450px;
        }
        .product-image img{
            object-fit: cover;
            width: 100%;
            height: 250px;
        }
        .cookie-consent {
        position: fixed;
        bottom: 8px;
        left: 550px;
        width: 260px;
        padding-top: 7px;
        height: 83px;
        color: #fff;
        line-height: 20px;
        padding-left: 10px;
        padding-right: 10px;
        font-size: 14px;
        background: #292929;
        z-index: 120;
        cursor: pointer;
        border-radius: 3px
        }

        .allow-button {
            height: 20px;
            width: 104px;
            color: #fff;
            font-size: 12px;
            line-height: 10px;
            border-radius: 3px;
            border: 1px solid green;
            background-color: green
        }
        .icon{
            position:fixed;
            left:0;
            bottom:0;
            margin-left:20px;
            background: rgb(245,205,233);
            z-index:999;
            border-radius:50%;
        }
        .content{
            position:fixed;
            left:0;
            bottom:0;
            margin-left:20px;
            z-index:999;
        }
    </style>


</head>

<body >
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

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

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Single Product</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="default.php"><i class="lni lni-home"></i> Home</a></li>
                        <li>Single Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <div class="row">
        <div class="col-md-10">

        </div>
        
    </div>
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = :id");      
                                    $stmt->bindParam(":id",$id);
                                    $result = $stmt->execute();
                                    ?>
                                    <?php while($prod = $stmt->fetch()){ ?>

                                    <img style="height:400px width:auto" src="AddProducts/Thumbnail/<?php echo $prod['product_thumbnail'] ?>" id="current" alt="#">
                                </div>
                                <div class="images">
                                    <?php    $stmt2 = $conn->prepare("SELECT * FROM product_images WHERE product_id=:prod_id");
                                    $stmt2->bindParam("prod_id",$id);
                                    $stmt2->execute();?>
                                    <?php while($img = $stmt2->fetch()){ ?>
                                        <img src="AddProducts/Uploads/<?php echo $img['image_name'] ?>" class="img" alt="#">
                                        
                              <?php      } ?>
                              <img src="AddProducts/Thumbnail/<?php echo $prod['product_thumbnail'] ?>" class="img" alt="#">
                                    
                                    
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title"><?php echo $prod['product_name'] ?></h2>
                            
                            <h3 class="price"><?php echo $prod['product_price'] ?> LKR</h3>
                            <p class="info-text"><ul>
                                <?php foreach(explode(',',$prod['product_tags']) as $tags){ ?>
                                    <li><a href="search.php?key=<?php echo htmlspecialchars($tags) ?>"><?php echo htmlspecialchars($tags) ?></a></li>
                                 <?php } ?>
                            </ul></p>

                            
                            <form action="" method="post">
                            <div class="bottom-content">
                                <div class="row align-items-end">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="button cart-button">
                                            <input type="hidden" name="product_id" value=<?php echo $prod['product_id'] ?>>
                                            <input type="hidden" name="product_quantity" value='1'>
                                            <?php
                                            $valquantity = $prod['product_quantity'];
                                            if($valquantity < 1){ ?>
                                                <div class="text-danger">Sorry, this product is out of stock</div>
                                            <?php
                                            } elseif($valquantity < 5) {  ?>
                                                <div class="text-danger">Hurry only <?php echo $valquantity ?> left</div>
                                                <button type="submit" name="add" class="btn" style="width: 100%;">Add to Cart</button> 
                                            <?php
                                            
                                            } else {  ?>
                                            <button type="submit" name="add" class="btn" style="width: 100%;">Add to Cart</button> 
                                        <?php
                                        }


                                            ?>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="wish-button">
                                            <button class="btn" name="wish"><i class="lni lni-heart"></i> To Wishlist</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <?php if(isset($_SESSION['user_id'])){  ?>
                            <form id="contactForm" action="" method="post">
                                <div class="form-group">
                                <input type="hidden" name="product_id" value=<?php echo $prod['product_id'] ?>>
                                    <p>Have an enquiry</p>
                                <label for="">Please let us know. We are happy to answer</label>
                                <textarea name="question" id="" cols="30" rows="1" class="form-control" required></textarea><br>
                                <div class="text-center">
                                <button type="submit" name="enquiry" class="btn btn-dark">Place an Enquiry</button>
                                </div>
                               
                            </div>
                            </form>
                            <?php
                            } else { ?>
                            <p>Have any enquiry?</p>
                            <a href="Userlogin/login.php">Login Now</a>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="info-body custom-responsive-margin">
                                <h4>Details</h4>
                                <p><?php echo $prod['product_description'] ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="info-body">
                                <h4>Tags</h4>
                                <ul class="normal-list">
                                    <li><span><?php echo $prod['product_tags'] ?></li>
                                    
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?><br>
        <?php
            $stmt3 = $conn->prepare("SELECT * FROM review as rev INNER JOIN user as us ON us.user_id=rev.user_id WHERE product_id=:prod_id");
            $stmt3->bindParam("prod_id",$id);
            $stmt3->execute();
            $revCount =  $stmt3->RowCount();
            if($revCount > 0 ){ ?>

            <div class="container text-center text-primary">
                <h3><span class="text-primary">Review</span></h3>
            </div>
            <div class="container review" id="review">
            
            
            <?php
            while($review = $stmt3->fetch()){


            ?>
            <div class="product-details-info">
                <div class="single-block">
                    <hr>
                    <div class="row">
                        <div class="col-md-2"><?php echo $review['username'] ?></div>
                        <div class="col-md-8"></div>
                        <div class="col-md-2"><?php echo $review['reviewed_at'] ?></div>
                    </div>
                    <hr>
                    <div class="row text-center">
                       <div class="col-md-1"><?php echo $review['rating'] ?>/5</div>
                       <div class="col-md-10 text-primary"><?php echo $review['description'] ?></div>
                       <div class="col-md-1"></div>
                    </div>
            </div>
            </div>
            <?php } ?>
            <?php } ?>

        </div>
        <?php 
        if(isset($_SESSION['user_id'])){
        $isreview = isReview($_SESSION['user_id'],$_GET['prod_id']);
        if($isreview){ ?>
            <div class="container">
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="text-center">
                            <h4>Leave a review</h4>
                        </div>
                        
                        <div class="col-md-12">
                        <form action="" method="post">
                            <div class="row mt-3">
                                <div class="col-md-2">

                                </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="description" id="" cols="30" rows="3" required></textarea>
                                        </div>
                                    <div class="col-md-2">
                                        
                                    </div>
                                </div>
                            <div class="row text-center">
                                <div class="col-md-3 ">
                                <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                                    </div>
                            </div>
                                
                                <div class="col-md-7">

                                </div>
                                <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-dark mb-2"name="review">Add</button>

                                </div>
                            </div>
                                    </div>
                            </div>
                    </form>
                        </div>
                </div>
            </div>
        </div>
       <?php }
        }

        ?>
        </div>
        
            <?php
            $stmtenq = $conn->prepare("SELECT * FROM product_enquiry WHERE product_id=:prod_id AND isClosed='Yes'");
            $stmtenq->bindParam("prod_id",$id);
            $stmtenq->execute();
            $enqcount = $stmtenq->RowCount();
            if($enqcount > 0) {?>
            <div class="container review" id="enq">
                <div class="text-center">
                    <h3>Enquiries</h3>
                </div>
            <?php
            
            while($review = $stmtenq->fetch()){


            ?>

            <div class="product-details-info">
                <div class="single-block">
                    <hr>
                    <div class="row text-center">
                       <div class="col-md-2"><?php echo $review['created_at'] ?></div>
                       <div class="col-md-8"><?php echo $review['enquiry'] ?></div>
                       <div class="col-md-2"></div>
                    </div>
                    <div class="row text-center">
                       <div class="col-md-2"></div>
                       <div class="col-md-8 text-primary"><?php echo $review['response'] ?></div>
                       <div class="col-md-2"></div>
                    </div>
                    <hr>
            </div>
            </div>
            <?php }
            } ?>
        </div>
        

    </section>
    <!-- End Item Details -->

    <!-- Review Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-name">Your Name</label>
                                <input class="form-control" type="text" id="review-name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-email">Your Email</label>
                                <input class="form-control" type="email" id="review-email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-subject">Subject</label>
                                <input class="form-control" type="text" id="review-subject" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-rating">Rating</label>
                                <select class="form-control" id="review-rating">
                                    <option>5 Stars</option>
                                    <option>4 Stars</option>
                                    <option>3 Stars</option>
                                    <option>2 Stars</option>
                                    <option>1 Star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">Review</label>
                        <textarea class="form-control" id="review-message" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer button">
                    <button type="button" class="btn">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Review Modal -->
    <section class="trending-product section" style="margin-top: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Recently Added</h2>
                        <p>Know where to shop, because cash does bring joy.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                    include('database/dbconn.php');
                    $stmt = $conn->prepare("SELECT * FROM product ORDER BY created_at DESC LIMIT 4");
                    $stmt->execute();
                    while($row = $stmt->fetch()){

                ?>
                <div class="col-lg-3 col-md-6 col-12">
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
    </section>
    <!-- Start Footer Area -->
    
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
    <script type="text/javascript">
        const current = document.getElementById("current");
        const opacity = 0.6;
        const imgs = document.querySelectorAll(".img");
        imgs.forEach(img => {
            img.addEventListener("click", (e) => {
                //reset opacity
                imgs.forEach(img => {
                    img.style.opacity = 1;
                });
                current.src = e.target.src;
                //adding class 
                //current.classList.add("fade-in");
                //opacity
                e.target.style.opacity = opacity;
            });
        });
    </script>
        <script>
                class Slider {
                constructor (rangeElement, valueElement, options) {
                    this.rangeElement = rangeElement
                    this.valueElement = valueElement
                    this.options = options

                    // Attach a listener to "change" event
                    this.rangeElement.addEventListener('input', this.updateSlider.bind(this))
                }

                // Initialize the slider
                init() {
                    this.rangeElement.setAttribute('min', options.min)
                    this.rangeElement.setAttribute('max', options.max)
                    this.rangeElement.value = options.cur

                    this.updateSlider()
                }

                // Format the money
                asMoney(value) {
                    return 'LKR ' + parseFloat(value)
                    .toLocaleString('en-US', { maximumFractionDigits: 2 })
                }

                generateBackground(rangeElement) {   
                    if (this.rangeElement.value === this.options.min) {
                    return
                    }

                    let percentage =  (this.rangeElement.value - this.options.min) / (this.options.max - this.options.min) * 100
                    return 'background: linear-gradient(to right, #50299c, #7a00ff ' + percentage + '%, #d3edff ' + percentage + '%, #dee1e2 100%)'
                }

                updateSlider (newValue) {
                    this.valueElement.innerHTML = this.asMoney(this.rangeElement.value)
                    this.rangeElement.style = this.generateBackground(this.rangeElement.value)
                }
                }

                let rangeElement = document.querySelector('.range [type="range"]')
                let valueElement = document.querySelector('.range .range__value span') 

                let options = {
                min: 20,
                max: 75000,
                cur: 20
                }

                if (rangeElement) {
                let slider = new Slider(rangeElement, valueElement, options)

                slider.init()
                }
</script>
</body>

</html>