<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <title>All orders</title>


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
                    <h1 class="h3 mb-2 text-gray-800">Orders</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold bg.dark text-primary">All Orders</h6>
                        </div>
                        <div class="card-body"><canvas id="bar"></canvas></div>

                            <div class="row mt-1">
                                <div class="col-md-11">
                                </div>
                                
                                <div class="col-md-1">
                                    <form action="allOrdersexcel.php" method="post">
                                        <button name="excel" class="btn btn-success">
                                            <i class="fas fa-file-excel"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');        
                                                  $stmt = $conn->prepare("SELECT *
                                             FROM orders WHERE isPaid='Paid' ORDER BY created_at DESC");
                                                  $stmt->execute();
                                                  while($prod = $stmt->fetch()){
                                                        $order_id = $prod['order_id'];
                                                        $username = $prod['first_Name'];
                                                        $email = $prod['email'];
                                                        $number = $prod['mobile_number'];
                                                        $address = $prod['shipping_address'];
                                                        $total = $prod['total'];
                                                        $coupon = $prod['coupon_Discount'];
                                                        $subtotal = $prod['sub_total'];
                                                        $date =$prod['created_at'];
                                                        $status =$prod['isDelivered'];
                                                  ?>
                                                  <tr>
                                                    <td><?php echo $username; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $number; ?></td>
                                                    <td><?php echo $address; ?></td>
                                                    <td><?php echo $total; ?></td>
                                                   
                                                    
                                                    <td><a class="btn btn-primary" href="viewSingleOrder.php?id=<?php echo $order_id ?>"><i class="fas fa-eye"></i></a></td>
                                                

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
        <?php
        include('../../database/dbconn.php');
        $stmtcoupon = $conn->prepare("SELECT *
        FROM orders WHERE isPaid='Paid' AND isDelivered='Delivered'");
        $results = $stmtcoupon->execute();
        if($results){
            while ($row = $stmtcoupon->fetch()){
                $check[] = $row['order_id'];
                $totalamount[] = $row['sub_total'];
        
            }
        
        } else {
            echo "Error";
        }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script>
            const labelsbar = <?php echo json_encode($check) ?>;
        const databar = {
            labels: labelsbar,
            datasets: [{
            label: 'My First Dataset',
            data: <?php echo json_encode($totalamount) ?>,
            backgroundColor: [
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(201, 203, 207, 1)'
            ],
            borderColor: [
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
            }]
        };

        const configbar = {
            type: 'line',
            data: databar,
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            },
        };
        var myChart1 = new Chart(
            document.getElementById('bar'),
            configbar
        );
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>
