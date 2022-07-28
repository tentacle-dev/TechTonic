<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SRT Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />

    </head>
    <body class="sb-nav-fixed">
         <?php include('../Admin/templates/navbar.php') ?>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
              <?php include('../Admin/templates/sidebar.php') ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">View all Enquiry</h1>
                        
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                View all Enquiry 
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Enquiry</th>
                                            <th>Response</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Enquiry</th>
                                            <th>Response</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');        
                                                  $stmt = $conn->prepare("SELECT * FROM product_enquiry");
                                                  $stmt->execute();
                                                  while($review = $stmt->fetch()){
                                                        $user_id = $review['user_id'];
                                                        $enquiry = $review['enquiry'];
                                                        $response = $review['response'];
                                                        $date = $review['created_at'];
                                                        $closed = $review['isClosed'];
                                                        $enquiryid =$review['id'];
                                                  ?>
                                                  <tr>
                                                    <td><?php echo $user_id; ?></td>
                                                    <td><?php echo $enquiry; ?></td>
                                                    <td><?php echo $response; ?></td>
                                                    <td><?php echo $date; ?></td>
                                                    <?php
                                                        if($closed == 'Yes'){
                                                            ?>
                                                            <td></td>
                                                            <?php
                                                        } else { ?>
                                                           <td><a class="btn btn-primary"href="viewSingleEnquiry.php?id=<?php echo $enquiryid ?>">View</a></td>
                                                   <?php     }

                                                    ?>
                                                    

                                                  </tr>
                                                  <?php
                                                  }
                                                  }catch(PDOException $e){
                                                      $e->getMessage();
                                                  }
                                            ?>                                       
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>
