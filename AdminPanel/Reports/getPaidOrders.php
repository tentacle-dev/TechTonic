<?php
if(isset($_GET['excel'])){
    include('../../database/dbconn.php');
    $order_from = $_GET['from'];
    $order_to = $_GET['to'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE created_at BETWEEN '$order_from' AND '$order_to' ORDER BY order_id ASC");
    $stmt->execute();
    $html='<table><tr><td>Name</td><td>City</td><td>Email</td></tr>';
    while($row = $stmt->fetch()){
        $html.='<tr><td>'.$row['order_id'].'</td><td>'.$row['total'].'</td><td>'.$row['sub_total'].'</td></tr>';
    }
    
    $html.='</table>';
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=report.xls');
    echo $html;
}





?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Order Table</h6>
                        </div>
                        <form action="" method="get">
                            <div class="row container mt-5">
                                <div class="col-md-6">
                                    <label for="">Start Date:</label><br>
                                    <input class="form-control" type="datetime-local" name="from">
                                </div>
                                <div class="col-md-6">
                                    <label for="">End Date:</label><br>
                                    <input class="form-control"type="datetime-local" name="to">
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col">
                                    <button type="submit" class="btn btn-dark mt-3">Filter</button>
                                    <button type="submit" name="excel" class="btn btn-success mt-3">Print excel</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Description</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Description</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');
                                                  if(isset($_GET['from']))        {
                                                $order_from = $_GET['from'];
                                                  $order_to = $_GET['to'];
                                                  $stmt = $conn->prepare("SELECT *
                                                   FROM orders WHERE 'created_at' BETWEEN '$order_from' AND '$order_to' AND isPaid='Paid' ORDER BY order_id ASC");
                                                  } else {
                                                    $stmt = $conn->prepare("SELECT *
                                                   FROM orders WHERE isPaid='Paid'");  
                                                  }
                                                  
                                                  $stmt->execute();
                                                  while($review = $stmt->fetch()){
                                                      $checkout_id = $review['order_id'];
                                                        $username = $review['first_Name'];
                                                        $total = $review['total'];
                                                        $coupon = $review['coupon_Discount'];
                                                        $subtotal = $review['sub_total'];
                                                        $date =$review['created_at'];
                                                  ?>
                                                  <tr>
                                                    <td><?php echo $username; ?></td>
                                                    <td><?php echo $coupon; ?></td>
                                                    <td><?php echo $subtotal; ?></td>
                                                    <td><?php echo $date; ?></td>
                                                    <td><a class="btn btn-primary" href="../invoice.php?id=<?php echo $checkout_id ?>">View</a></td>

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
        <script src="Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>