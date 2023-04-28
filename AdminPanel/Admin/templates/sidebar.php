<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Maindashboard/dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Orders & Products</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Orders/newOrders.php">New orders</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Orders/allOrders.php">All orders</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Products/addProducts.php">Add products</a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        View products
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Products/viewActiveProducts.php">Active products</a>
                                            <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Products/viewAllProducts.php">All products</a>
                                            <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Products/productReport.php">Reports</a>
                                        </nav>
                                    </div>
                                    
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Other</div>
                            <!-- users -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseuser" aria-expanded="false" aria-controls="collapseuser">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseuser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/User/newsletter.php">Newsletters</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseuser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/User/viewUsers.php">Users</a>
                                </nav>
                            </div>
                            <!-- users -->
                            <!-- coupon -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsecoupons" aria-expanded="false" aria-controls="collapsecoupons">
                                <div class="sb-nav-link-icon"><i class="fas fa-gift"></i></div>
                                Coupon
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsecoupons" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Coupon/addCoupon.php">Add Coupons</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Coupon/viewCoupon.php">View coupons</a>
                                </nav>
                            </div>
                            <!-- coupon -->
                            <!-- category -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Category
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategory" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionCategory">
                                
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseMain" aria-expanded="false" aria-controls="pagesCollapseMain">
                                        Main Category
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseMain" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Main_Category/addCategory.php"> Add</a>
                                            <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Main_Category/viewCategory.php">View </a>
                                            
                                        </nav>
                                    </div>
                                   
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseSub" aria-expanded="false" aria-controls="pagesCollapseSub">
                                        Sub Category
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseSub" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Sub_Category/addCategory.php"> Add</a>
                                            <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Sub_Category/viewCategory.php">View </a>
                                            
                                        </nav>
                                    </div>
                                    
                                </nav>
                            </div>
                            <!-- category -->
                            <!-- Reservations -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReservation" aria-expanded="false" aria-controls="collapseReservation">
                                <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
                                Reservations
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseReservation" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Reservation/viewNewReservations.php">View new reservations</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Reservation/viewAllReservations.php">View all reservations</a>
                                </nav>
                            </div>
                            <!-- Reservations -->
                            <!-- enquiry -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseenquiry" aria-expanded="false" aria-controls="collapseenquiry">
                                <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
                                Enquiry
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseenquiry" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Enquiry/viewNewEnquiry.php">View new enquiry</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Enquiry/viewAllEnquiry.php">View all enquiry</a>
                                </nav>
                            </div>
                            <!-- enquiry -->
                            <!-- reviews -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsereviews" aria-expanded="false" aria-controls="collapsereviews">
                                <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                                Reviews
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsereviews" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Reviews/viewReviews.php">View reviews</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Reviews/viewAllReviews.php">View all reviews</a>
                                </nav>
                            </div>
                            <!-- reviews -->

                            <!-- reports -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseReports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Orders/newOrders.php">Paid orders</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/GenerateReports/orderDate.php">Order by date</a>                                   
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/Orders/allOrders.php">Delivered orders</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/GenerateReports/CustomerWiseSalesReports.php">Customer wise</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/GenerateReports/itemWiseReport.php">Product Sales</a>
                                    <a class="nav-link" href="http://localhost/bcs-project/AdminPanel/GenerateReports/topSalesReports.php">Top Selling</a>
                                    
                                    <a class="nav-link" href="http://localhost/srt/AdminPanel/Products/productReport.php">Product Stock</a>

                                </nav>
                            </div>
                            <!-- Reports -->

                            
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                       
                    </div>
                </nav>