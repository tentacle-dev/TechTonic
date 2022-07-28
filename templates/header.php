<header class="header navbar-area">
        <!-- Start Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                            <ul class="menu-top-link">
                               
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-middle">
                            <ul class="useful-links">
                                <li><a href="default.php">Home</a></li>
                                <li><a href="http://localhost/srt/about-us.php">About Us</a></li>
                                <li><a href="http://localhost/SRT/contact-us.php">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-end">
                            <?php
                            if(isset($_SESSION['user_id'])){ ?>
                                <div class="user"><a href="http://localhost/SRT/loggeduser/logout.php">Logout</a></div>
                           <?php } else { ?>
                                <div class="user"><ul class="user-login">
                                <li><a href="http://localhost/SRT/UserLogin/Login.php">Sign in</a></li>
                                <li><a href="http://localhost/SRT/UserLogin/registration.php">Sign up</a></li></ul></div>
                            <?php } ?>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Start Header Middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-7">
                        <!-- Start Header Logo -->
                        <a class="navbar-brand" href="default.php">
                            <img src="styles/assets/images/logo/SRTlogo.png" style="width:100px; height:auto;" alt="Logo">
                        </a>
                        <!-- End Header Logo -->
                    </div>
                    <div class="col-lg-5 col-md-7 d-xs-none">
                        <!-- Start Main Menu Search -->
                        <div class="main-menu-search">
                            <!-- navbar search start -->
                            <form action="search.php" method="GET">
                                <div class="navbar-search search-style-5">
                                        <div class="search-input">
                                            <input type="text" placeholder="Search" name="key">
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                                        </div>
                                </div>
                            </form>

                            <!-- navbar search Ends -->
                        </div>
                        <!-- End Main Menu Search -->
                    </div>
                    <div class="col-lg-4 col-md-2 col-5">
                        <div class="middle-right-area">
                            <div class="nav-hotline">
                                <i class="lni lni-phone"></i>
                                <h3>Hotline:
                                    <span>(011) 233 7865</span>
                                </h3>
                            </div>
                            <div class="navbar-cart">
                                <div class="wishlist">
                                    <a href="wishlist.php">
                                        <i class="lni lni-heart"></i>
                                        <span class="total-items"><?php echo $wishcount
                                        ?></span>
                                    </a>
                                </div>
                                <div class="cart-items">
                                    <a href="cart3.php" class="main-btn">
                                        <i class="lni lni-cart"></i>
                                        <span class="total-items"><?php echo $cartcount
                                        ?></span>
                                    </a>
                                    <!-- Shopping Item -->
                                    
                                    <!--/ End Shopping Item -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Middle -->
        <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                        <div class="mega-category-menu">
                            <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                            <ul class="sub-category">
                                <?php 
                                include('database/dbconn.php');
                                $stmt = $conn->prepare("SELECT * FROM main_category");
                                $stmt->execute();
                                while($row = $stmt->fetch()){
                                    $main_name = $row['main_category_name'];
                                    $main_id = $row['main_category_id']; ?>
                                        <li><a href="main-category.php?id=<?php echo $main_id ?>"><?php echo $main_name?> <i class="lni lni-chevron-right"></i></a>
                                        <?php
                                            $stmt2 = $conn->prepare("SELECT * FROM sub_category WHERE main_category_id = $main_id");
                                            $stmt2->execute();?>
                                                <ul class="inner-sub-category">


                                            <?php 
                                            while($sub = $stmt2->fetch()){
                                                $sub_name = $sub['sub_category_name'];
                                                $sub_id = $sub['sub_category_id']; ?>
                                                <li><a href="sub-category.php?id=<?php echo $sub_id ?>"><?php echo $sub_name?></a></li>
                                          <?php  } ?>
                                          </ul>


                                <?php } ?>
                            </ul>
                            
                        </div>
                        <!-- End Mega Category Menu -->
                        <!-- Start Navbar -->
                        
                        <!-- End Navbar -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Nav Social -->
                    <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    
                                    <?php 
                                    include('database/dbconn.php');
                                    $stmt = $conn->prepare("SELECT * FROM main_category");
                                    $stmt->execute();
                                    while($row = $stmt->fetch()){
                                        $main_name = $row['main_category_name'];
                                        $main_id = $row['main_category_id']; ?>

                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation"><?php echo $main_name ?></a>
                                            <?php
                                            $stmt2 = $conn->prepare("SELECT * FROM sub_category WHERE main_category_id = $main_id");
                                            $stmt2->execute();?>

                                        <ul class="sub-menu collapse" id="submenu-1-3">
                                        <?php while($sub = $stmt2->fetch()){
                                                $sub_name = $sub['sub_category_name'];
                                                $sub_id = $sub['sub_category_id']; ?>

                                            <li class="nav-item"><a href="sub-category.php?id=<?php echo $sub_id ?>"><?php echo $sub_name?></a></li>
                                            <?php } ?>
                                            

                                        </ul>
                                        <?php } ?>
                                    </li>
                                    <?php if(isset($_SESSION['user_id'])){ ?>


                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">Profile</a>
                                        <ul class="sub-menu collapse" id="submenu-1-4">
                                            <li class="nav-item"><a href="http://localhost/SRT/viewMyOrders.php">My orders</a>
                                            </li>
                                            <li class="nav-item"><a href="http://localhost/SRT/viewMyReservations.php">My reservations</a>
                                            </li>
                                            <li class="nav-item"><a href="http://localhost/SRT/viewMyEnquiries.php">My enquiry</a>
                                            </li>
                                            <li class="nav-item"><a href="http://localhost/SRT/viewMyReviews.php">My reviews</a>
                                            </li>
                                            <hr>
                                            <li class="nav-item"><a href="http://localhost/srt/profile.php">Change profile information</a>
                                            </li>
                                            <!-- <li class="nav-item"><a href="blog-grid-sidebar.html">Change Password</a>
                                            </li> -->
                                            <hr>
                                            <li class="nav-item"><a href="http://localhost/SRT/loggeduser/logout.php">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php } else { ?>
                                        <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">Log In</a>
                                        <ul class="sub-menu collapse" id="submenu-1-4">
                                            <li class="nav-item"><a href="http://localhost/SRT/UserLogin/Login.php">Sign in</a>
                                            </li>
                                            <li class="nav-item"><a href="http://localhost/SRT/UserLogin/Registration.php">Sign up</a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <?php } ?>

                                    <li class="nav-item">
                                        <a href="http://localhost/SRT/contact-us.php" aria-label="Toggle navigation">Contact Us</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                    <!-- End Nav Social -->
                </div>
            </div>
        </div>
        <!-- End Header Bottom -->
    </header>