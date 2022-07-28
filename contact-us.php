<!DOCTYPE html>
<html class="no-js" lang="zxx">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <title>Shri raam tex.</title>
      <meta name="description" content="" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="shortcut icon" type="image/x-icon" href="styles/assets/images/favicon.svg" />
      <!-- ========================= CSS here ========================= -->
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
      <section class="page-section" id="contact">
         <div class="container">
            <div class="text-center">
               <h2 class="section-heading text-uppercase text-primary">Contact Us</h2>
               <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <h1 class="text-white text-center">Contact us we are ready to help to you anytime</h1>
               </div>
               <div class="col-md-6">
                  <form id="contactForm" action="" method="POST" >
                     <div class="row align-items-stretch mb-5">
                        <div class="form-group">
                           <!-- Email address input-->
                           <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" disabled value="shriraamtex@gmail.com" />
                           <div class="text-danger">
                              <!-- <?php echo $errors['emailres'] ?> -->
                           </div>
                        </div>
                        <div class="form-group">
                           <!-- Phone number input-->
                           <input class="form-control" id="phone" name="number" type="tel" placeholder="Your Phone *" disabled value="011 233 7865" />
                           <div class="text-danger">
                              <!-- <?php echo $errors['number'] ?> -->
                           </div>
                        </div>
                     </div>
                     <div class="text-center">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
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