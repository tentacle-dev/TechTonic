<?php 

session_start();
require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('database/reservationsDbConfig.php');
include('database/newsletterDbConfig.php');
$error['news'] = '';
if(isset($_POST['newsletter'])){
    $newsletter = $_POST['emailnews'];
    $exist = newsletterexist($newsletter);
    if($exist){
        $error['news'] = "This email has been subscribed already";
    } else {
        $result = setnewsData($newsletter);
    if($result){
        $mail = new PHPMailer();

        $mail->isSMTP();

        $mail->Host = "smtp.gmail.com";

        $mail->SMTPAuth = "true";

        $mail->SMTPSecure = "tls";

        $mail->Port = 587;

        $mail->Username = "texshriraam@gmail.com";

        $mail->Password = 'xmtbxtrpvwrjwadh';

        $mail->Subject = "Subscription-Welcome Mail";

        $mail->isHTML(true);

        $mail->setFrom('texshriraam@gmail.com');

        $mail->Body ="<h1>Email Notification from Shri raam tex</h1><br><p>Thank you for subscribing to our newsletter</p><a href='http://localhost/bcs-project/UserDash/unsubscribe.php?email=$newsletter'>Unsubscribe</a></div>";

        $mail->addAddress($newsletter);

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
    
}

$errors = array('name'=>'','number'=>'','emailres'=>'','date'=>'');
if(isset($_POST['reserve'])){
    $name = $_POST['name'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
          $errors['name'] = 'Name must be letters only';
      }
    $number = $_POST['number'];
    if(!preg_match('/^[0-9]{10}+$/', $number)){
      $errors['number'] = 'Your mobile number should only be numbers and 10 characters';
    }
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['emailres'] = 'Email must be a valid email address';
    }
    $id = $_SESSION['user_id'];
    $date2 = $_POST['date'];
    $val = date('Y-m-d');

    if($date2 < $val){
        $errors['date'] = 'Please choose a future date';
    }else {
        $date = date("Y-m-d H:i:s",strtotime($date2));
    }
    $purpose = $_POST['purpose'];
    if(array_filter($errors)){
    }else {
   $result = setData($name,$id,$number,$date,$email,$purpose);  
   if($result){
        $mail = new PHPMailer();

        $mail->isSMTP();

        $mail->Host = "smtp.gmail.com";

        $mail->SMTPAuth = "true";

        $mail->SMTPSecure = "tls";

        $mail->Port = 587;

        $mail->Username = "texshriraam@gmail.com";

        $mail->Password = "xmtbxtrpvwrjwadh";

        $mail->Subject = "New Reservation has been placed";

        $mail->isHTML(true);

        $mail->setFrom('texshriraam@gmail.com');

        $mail->Body ="<h1>A new reservation has been placed</h1><br><p>You can view the reservation by clicking the link below.</p><a href='http://localhost/bcs-project/AdminPanel/Reservation/viewNewReservations.php'>Click here</a></div>";

        $mail->addAddress($email);

        if($mail->Send()){
            header('Location:index.php');
        } else {
            echo "Error";
        }

        $mail->smtpClose();
        } else {
            echo"Error";
        }
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
      <link rel="stylesheet" href="default/css/styles.css" />
      <link rel="stylesheet" href="styles/assets/css/main.css" />
      <style>
         .product-image img{
         object-fit: cover;
         width: 100%;
         height: 250px;
         }
         .hero-area img{
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
         width: 50px;
         height: 50px;
         line-height: 50px;
         background: #0167F3;
         display: -webkit-box;
         display: -ms-flexbox;
         display: flex;
         -webkit-box-pack: center;
         -ms-flex-pack: center;
         justify-content: center;
         -webkit-box-align: center;
         -ms-flex-align: center;
         align-items: center;
         font-size: 16px;
         color: #fff !important;
         position: fixed;
         bottom: 30px;
         left: 30px;
         z-index: 9;
         cursor: pointer;
         -webkit-transition: all .3s ease-out 0s;
         transition: all .3s ease-out 0s;
         border: 2px solid blue;
         border-radius: 25px;
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
   <body>
      <!-- <div class="cookie-consent" id="cookies"> <span>This site uses cookies to enhance user experience.</span>
         <div class="mt-2 d-flex align-items-center justify-content-center g-2"> <button class="allow-button mr-1" onclick="hideCookies()">Allow cookies</button></div>
         </div> -->
      <div class="container chatbot">
         <div class="d-flex align-items-start flex-column-reverse">
            <div class="p-2 icon" id="showbtn" onclick="showChatbot()">
               <i class="lni lni-comments-alt"></i>
            </div>
            <div class="p-2 content" style="display:none" id="content">
               <div class="row">
                  <div class="col-md-11"></div>
                  <div class="col-md-1" onclick="hideChatbot()"><i class="lni lni-close"></i></div>
               </div>

               <iframe 
                  allow="microphone;"
                  height="400"
                  src="https://console.dialogflow.com/api-client/demo/embedded/e60e3f04-e6b6-4ad0-b131-623f498402d1">
               </iframe>

            </div>
         </div>
      </div>
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
      <?php include('templates/count.php')?>
      <?php include('templates/header.php') ?>
      <!-- End Header Area -->
      <!-- Start Hero Area -->
      <header class="masthead">
         <div class="">
            <div class="masthead-subheading header-text">Future-proof your life</div>
            <div class="masthead-heading text-uppercase text-primary header-text">Innovative Tech at <span class="text-danger">Unbeatable Prices </span>
            </div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#portfolio">Show Me More</a>
         </div>
      </header>
      <section class="hero-area">
         <div class="container">
            <div class="row">
               <div class="col-lg-7 col-12 custom-padding-right">
                  <div class="slider-head">
                     <!-- Start Hero Slider -->
                     <div class="hero-slider">
                        <!-- Start Single Slider -->
                        <?php
                           include('database/dbconn.php');
                           $stmt2prod =$conn->prepare("SELECT * FROM product WHERE product_status='Active'  LIMIT 40");
                           $stmt2prod->execute();
                           while($prod2 =$stmt2prod->fetch()){
                           
                           
                           ?>
                        <div class="single-slider"
                           style="background-image: url(AddProducts/Thumbnail/<?php echo $prod2['product_thumbnail'] ?>);">
                           <div class="content">
                              <h2>
                                 <?php echo $prod2['product_name'] ?>
                              </h2>
                              <h3><span>Now Only</span><?php echo $prod2['product_price'] ?></h3>
                              <div class="button">
                                 <a href="viewSingleProduct.php?prod_id=<?php echo $prod2['product_id'] ?>" class="btn">Shop Now</a>
                              </div>
                           </div>
                        </div>
                        <?php
                           }
                           ?>
                        <!-- End Single Slider -->
                     </div>
                     <!-- End Hero Slider -->
                  </div>
               </div>
               <div class="col-lg-5 col-12">
                  <div class="row">
                     <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                        <!-- Start Small Banner -->
                        <div class="hero-small-banner "
                           style="background-color: #92a8d1;">
                           <div class="">
                              <h3 class="manrope mb-2 text-center">About Us</h3>
                              <h5 class="text-primary manrope">
                              The ecommerce site welcomes customers and is run by a team of tech enthusiasts who aim to provide the latest gadgets at affordable prices. The mission is to make technology accessible to everyone, with a range of products available to suit different needs and budgets. The site is a one-stop destination for all tech needs, including phones, computers, and electronic parts.
                              </h5>
                           </div>
                        </div>
                        <div class="hero-small-banner" style='background-color:#939399'>
                        </div>
                        <!-- End Small Banner -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Hero Area -->
      <!-- Start Trending Product Area -->
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
                  $stmt = $conn->prepare("SELECT * FROM product WHERE product_status='Active' ORDER BY created_at DESC LIMIT 16 ");
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
      <!-- End Trending Product Area -->
      <!-- Start Call Action Area -->
      <section class="page-section bg-light" id="portfolio">
         <div class="container">
            <div class="text-center">
               <h2 class="section-heading text-uppercase">Our top selling products</h2>
            </div>
            <div class="row">
               <div class="col-lg-6 col-sm-6 mb-4">
                  <!-- Portfolio item 1-->
                  <div class="portfolio-item">
                     <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                           <div class="portfolio-hover-content"><i class="lni lni-frame-expand"></i></div>
                        </div>
                        <img  width='400px' height='300px' src="AddProducts/Thumbnail/6446884ead3985.70160516.webp" alt="..." />
                     </a>
                     <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Mobile Phones</div>
                        <div class="portfolio-caption-subheading text-muted">The originality which suits every ocassion</div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-sm-6 mb-4">
                  <!-- Portfolio item 2-->
                  <div class="portfolio-item">
                     <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                        <div class="portfolio-hover">
                           <div class="portfolio-hover-content"><i class="lni lni-frame-expand"></i></div>
                        </div>
                        <img class="" width='400px' height='300px' src="AddProducts/Thumbnail/64468a21c71f86.11689251.jpg" alt="..." />
                     </a>
                     <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Laptops</div>
                        <div class="portfolio-caption-subheading text-muted">Work with the elegance</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="page-section" id="contact">
         <div class="container">
            <div class="text-center">
               <h2 class="section-heading text-uppercase">Place Reservation</h2>
               <h3 class="section-subheading text-muted">Reserve a time so that you will be welcomed individually.</h3>
            </div>
            <?php
               if(isset($_SESSION['user_id'])){ ?>
            <form id="contactForm" action="" method="POST" >
               <div class="row align-items-stretch mb-5">
                  <div class="col-md-6">
                     <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required />
                        <div class="text-danger">
                           <?php echo $errors['name'] ?>
                        </div>
                     </div>
                     <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required />
                        <div class="text-danger">
                           <?php echo $errors['emailres'] ?>
                        </div>
                     </div>
                     <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" name="number" type="number" placeholder="Your Phone *" required/>
                        <div class="text-danger">
                           <?php echo $errors['number'] ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <!-- Name input-->
                        <textarea name="purpose" class="form-control" id="" cols="30" rows="5" placeholder="Please state your reason for physical inspection. Your request will only be accpeted if it's valid..." required></textarea>
                     </div>
                     <div class="form-group mb-md-0">
                        <!-- Date input-->
                        <input class="form-control" name="date" id="datetime-local" type="datetime-local" required/>
                        <?php echo $errors['date'] ?>
                     </div>
                  </div>
               </div>
               <div class="text-center">
                  <button type="submit" name="reserve" class="btn btn-primary">Reserve</button>
               </div>
            </form>
            <?php
               } else { ?>
            <form id="contactForm" action="" method="POST" >
               <div class="row align-items-stretch mb-5">
                  <div class="col-md-6">
                     <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required disabled />
                        <div class="text-danger">
                           <?php echo $errors['name'] ?>
                        </div>
                     </div>
                     <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required disabled/>
                        <div class="text-danger">
                           <?php echo $errors['emailres'] ?>
                        </div>
                     </div>
                     <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" name="number" type="number" placeholder="Your Phone *" required disabled/>
                        <div class="text-danger">
                           <?php echo $errors['number'] ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <!-- Name input-->
                        <textarea name="purpose" class="form-control" id="" cols="30" rows="5" placeholder="Please state your reason for physical inspection. Your request will only be accpeted if it's valid..." required disabled></textarea>
                     </div>
                     <div class="form-group mb-md-0">
                        <!-- Date input-->
                        <input class="form-control" name="date" id="datetime-local" type="datetime-local" disabled/>
                        <div class="text-danger">
                           <?php echo $errors['date'] ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="text-center">
                  <a href="Userlogin/login.php" class="btn btn-primary">Please Login to reserve</a>
               </div>
            </form>
            <?php
               }
               ?>
         </div>
      </section>
      <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="close-modal" data-bs-dismiss="modal"><i class="lni lni-close"></i></div>
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-lg-8">
                        <div class="modal-body">
                           <!-- Project details-->
                           <h2 class="text-uppercase">Sarees</h2>
                           <img class="img-fluid d-block mx-auto" src="images/woman-5829241_1280.jpg" style="width:300px;" alt="..." />
                           <p>A sari (sometimes also saree or shari)[note 1] is a garment typically worn by women from South Asia that consists of an unstitched drape varying from 4.5 to 9 metres (15 to 30 feet) in length and 600 to 1,200 millimetres (24 to 47 inches) in width that is typically wrapped around the waist, with one end draped over the shoulder, partly baring the midriff. It is traditionally worn in the countries of India, Pakistan, Bangladesh, Sri Lanka, and Nepal. There are various styles of sari manufacture and draping. The most common one is the Nivi style. The sari is worn with a fitted bodice commonly called a choli (ravike or kuppasa in southern India, and cholo in Nepal) and a petticoat called ghagra, parkar, or ul-pavadai. In the modern Indian subcontinent, the sari is considered a cultural icon.</p>
                           <a href="main-category.php?id=3" class="btn btn-primary btn-xl text-uppercase">View more</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Portfolio item 2 modal popup-->
      <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="close-modal" data-bs-dismiss="modal"><i class="lni lni-close"></i></div>
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-lg-8">
                        <div class="modal-body">
                           <!-- Project details-->
                           <h2 class="text-uppercase">Salwars</h2>
                           <img class="img-fluid d-block mx-auto" src="images/model-4255849_1920.jpg" style="width:300px;" alt="..." />
                           <p>Shalwars are trousers which are atypically wide at the waist but which narrow to a cuffed bottom. They are held up by a drawstring or elastic belt, which causes them to become pleated around the waist. The trousers can be wide and baggy, or they can be cut quite narrow, on the bias. Shalwars have been traditionally worn in a wide region which includes Eastern Europe, West Asia, Central Asia, and South Asia. The kameez is a long shirt or tunic. The side seams are left open below the waist-line (the opening known as the chaak[note 1]), which gives the wearer greater freedom of movement. The kameez is usually cut straight and flat; older kameez use traditional cuts; modern kameez are more likely to have European-inspired set-in sleeves. The kameez may have a European-style collar, a Mandarin collar, or it may be collarless; in the latter case, its design as a women's garment is similar to a kurta. The combination garment is sometimes called salwar kurta, salwar suit, or Punjabi suit.</p>
                           <a href="main-category.php?id=4" class="btn btn-primary btn-xl text-uppercase">View more</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
                     <div class="col-lg-12 col-md-8 col-12">
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
                           <div class="text-danger"><?php echo $error['news'] ?></div>
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
                     <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-contact">
                           <h3>Get In Touch With Us</h3>
                           <p class="phone">Phone:  (0112) 233 7865</p>
                           <ul>
                              <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                              <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                           </ul>
                           <p class="mail">
                              <a href="mailto:shriraamtex@gmail.com">shriraamtex@gmail.com</a>
                           </p>
                        </div>
                        <!-- End Single Widget -->
                     </div>
                     <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-link">
                           <h3>Information</h3>
                           <ul>
                              <li><a href="http://localhost/SRT/about-us.php">About Us</a></li>
                              <li><a href="http://localhost/SRT/contact-us.php">Contact Us</a></li>
                           </ul>
                        </div>
                        <!-- End Single Widget -->
                     </div>
                     <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-link">
                           <h3>Shop Departments</h3>
                           <ul>
                              <li><a href="http://localhost/bcs-project/main-category.php?id=1">Desktops</a></li>
                              <li><a href="http://localhost/bcs-project/main-category.php?id=2">Laptops</a></li>
                              <li><a href="http://localhost/bcs-project/sub-category.php?id=7">Dell Desktops</a></li>
                              <li><a href="http://localhost/bcs-project/sub-category.php?id=17">Acer</a></li>
                              <li><a href="http://localhost/bcs-project/sub-category.php?id=5">HP</a></li>
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
                     </div>
                     <div class="col-lg-4 col-12">
                        <div class="copyright">
                           <p>SHRI RAAM TEX</p>
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
      <script src="styles/assets/js/main.js"></script>
      <script type="text/javascript">
         //========= Hero Slider 
         tns({
             container: '.hero-slider',
             slideBy: 'page',
             autoplay: true,
             autoplayButtonOutput: false,
             mouseDrag: true,
             gutter: 0,
             items: 1,
             nav: false,
             controls: true,
             controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
         });
         
         //======== Brand Slider
         tns({
             container: '.brands-logo-carousel',
             autoplay: true,
             autoplayButtonOutput: false,
             mouseDrag: true,
             gutter: 15,
             nav: false,
             controls: false,
             responsive: {
                 0: {
                     items: 1,
                 },
                 540: {
                     items: 3,
                 },
                 768: {
                     items: 5,
                 },
                 992: {
                     items: 6,
                 }
             }
         });
      </script>
      <script>
         function hideCookies(){
         document.getElementById('cookies').style.display = "none";
         }
         
         function showIcon(){
         document.getElementById('showbtn').style.display = "block";
         }
         function showChatbot() {
         document.getElementById('content').style.display = "block";
         document.getElementById('showbtn').style.display = "none";
         }
         function hideChatbot() {
         document.getElementById('content').style.display = "none";
         document.getElementById('showbtn').style.display = "block";
         }
      </script>
   </body>
</html>