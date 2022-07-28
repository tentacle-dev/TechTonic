<?php

include("../../database/dbconn.php");

?>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <style>
            :root {
        --bs-blue: #0d6efd;
        --bs-indigo: #6610f2;
        --bs-purple: #6f42c1;
        --bs-pink: #d63384;
        --bs-red: #dc3545;
        --bs-orange: #fd7e14;
        --bs-yellow: #ffc107;
        --bs-green: #198754;
        --bs-teal: #20c997;
        --bs-cyan: #0dcaf0;
        --bs-white: #fff;
        --bs-gray: #6c757d;
        --bs-gray-dark: #343a40;
        --bs-primary: #0d6efd;
        --bs-secondary: #6c757d;
        --bs-success: #198754;
        --bs-info: #0dcaf0;
        --bs-warning: #ffc107;
        --bs-danger: #dc3545;
        --bs-light: #f8f9fa;
        --bs-dark: #212529;
        --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0))
    }
    .body{
        font-family:system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }
    </style>
    <body class="sb-nav-fixed">
         <?php include('../Admin/templates/navbar.php') ?>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
              <?php include('../Admin/templates/sidebar.php') ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Customer Wise Sales Reports</h1>
                        
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Customer Wise Sales Reports 
                            </div>
                            <div class="card-body">
                                <canvas id="bar"></canvas>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                </div>
                                <div class="col-md-1">
                                    <form action="customerexcel.php" method="post">
                                        <button name="excel" class="btn btn-success">
                                            <i class="fas fa-file-excel"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body ">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Value</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');        
                                                  $stmt = $conn->prepare("SELECT I.user_id UserId
                                                , I.username Name
                                                ,I.user_emailaddress email
                                                , SUM(OL.value) TotalValue  
                                                FROM orderitems OL
                                                INNER JOIN (SELECT * FROM Orders WHERE isPaid='Paid') O ON OL.orders_id = O.order_id
                                                INNER JOIN user I ON OL.user_id = I.user_id
                                                GROUP BY I.user_id
                                                ");
                                                  $stmt->execute();
                                                  while($row = $stmt->fetch()){
                                                    $id =$row['UserId'];
                                                    $name = $row['Name'];
                                                    $email = $row['email'];
                                                    $value = $row['TotalValue'];

                                                  ?>
                                                  <tr>
                                                <td><?php echo $id?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $email?></td>
                                                <td><?php echo $value?></td>

                                            
                                        </form></td>
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
                <?php
                include('../Admin/templates/footer.php');
                ?>
            </div>
        </div>
 <?php
 include('../../database/dbconn.php');
 $stmtcoupon = $conn->prepare("SELECT I.user_id UserId
 ,SUM(OL.value) TotalValue  
 FROM orderitems OL
 INNER JOIN (SELECT * FROM Orders) O ON OL.orders_id = O.order_id
 INNER JOIN user I ON OL.user_id = I.user_id
 GROUP BY I.user_id");
 $results = $stmtcoupon->execute();
 if($results){
     while ($row = $stmtcoupon->fetch()){
         $check[] = $row['UserId'];
         $totalamount[] = $row['TotalValue'];
 
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
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
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