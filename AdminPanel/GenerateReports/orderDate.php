<?php
if(isset($_GET['from'])){
    $order_from = $_GET['from'];
    $order_to = $_GET['to'];
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
                        <div class="card-body">
                                <canvas id="bar"></canvas>
                        </div>
                        <form action="" method="GET">
                            <div class="row container mt-5">
                                    <div class="col-md-6">
                                        <label for="">Start Date:</label><br>
                                        <input class="form-control" type="datetime-local" name="from" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">End Date:</label><br>
                                        <input class="form-control"type="datetime-local" name="to" required>
                                    </div>
                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    <button type="submit" name="" class="btn btn-success mt-3">Filter</button>
                                </div>
                            </div>
                        </form>
                            
                            <form action="exceldate.php" method="post">
                                <div class="row">
                                        <div class="col-md-11"></div>
                                        <div class="col-md-1">
                                            <input type="hidden" name="from" value="<?php echo $order_from?>">
                                            <input type="hidden" name="to" value="<?php echo $order_to?>">
                                            <button name="date" class="btn btn-success">
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </div>
                                </div>
                            </form>

                        <div class="card-body">
                            
                            <div class="table-responsive">
                            <table class="table table-bordered table-dark" id="datatablesSimple" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');
                                                  if(isset($_GET['from'])){
                                                    $order_from = $_GET['from'];
                                                    $order_to = $_GET['to'];
                                                    $stmt = $conn->prepare("SELECT *
                                                    FROM orders WHERE created_at BETWEEN '$order_from' AND '$order_to' AND isPaid='Paid' ORDER BY order_id ASC");
                                                  } else {
                                                    $stmt = $conn->prepare("SELECT *
                                                   FROM orders WHERE isPaid='Paid'");  
                                                  }
                                                  
                                                  $stmt->execute();
                                                  while($order = $stmt->fetch()){
                                                      $checkout_id = $order['order_id'];
                                                        $username = $order['first_Name'];
                                                        $email = $order['email'];
                                                        $subtotal = $order['sub_total'];
                                                        $date =$order['created_at'];
                                                  ?>
                                                  <tr>
                                                    <td><?php echo $username; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $subtotal; ?></td>
                                                    <td><?php echo $date; ?></td>
                                                    <td><a class="btn btn-primary" href="../Orders/viewSingleOrder.php?id=<?php echo $checkout_id ?>"><i class="fas fa-eye"></i></a></td>

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
        if(isset($_GET['from'])){
            $order_from = $_GET['from'];
            $order_to = $_GET['to'];
            $stmt2 = $conn->prepare("SELECT *
            FROM orders WHERE created_at BETWEEN '$order_from' AND '$order_to' AND isPaid='Paid' ORDER BY order_id ASC");
          } else {
            $stmt2 = $conn->prepare("SELECT *
           FROM orders WHERE isPaid='Paid'");  
          }
          
          $chart = $stmt2->execute();
        if($chart){
            while ($row = $stmt2->fetch()){
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
                'rgba(255, 159, 64, 2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 159, 64)',
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
            type: 'pie',
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
        <script src="Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>