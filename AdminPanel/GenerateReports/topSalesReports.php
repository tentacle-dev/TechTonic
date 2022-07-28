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
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
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
                        <h1 class="mt-4">Top Sales Reports </h1>
                        
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Top Sales Table 
                            </div>
                            <div class="card-body">
                                <canvas id="bar"></canvas>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                </div>
                                <div class="col-md-1">
                                    <form action="topsalesexcel.php" method="post">
                                        <button name="excel" class="btn btn-success">
                                            <i class="fas fa-file-excel"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity Sold</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');        
                                                  $stmt = $conn->prepare("SELECT I.product_id ItemId
                                                , I.product_name ItemName
                                                , I.product_price CurrentPrice
                                                , SUM(OL.quantity) TotalQuantity  
                                                FROM orderitems OL
                                                INNER JOIN (SELECT * FROM Orders WHERE isPaid='Paid') O ON OL.orders_id = O.order_id
                                                INNER JOIN product I ON OL.product_id = I.product_id
                                                GROUP BY I.product_id,I.product_price
                                                ORDER BY TotalQuantity DESC LIMIT 15
                                                ");
                                                  $stmt->execute();
                                                  while($row = $stmt->fetch()){
                                                    $id =$row['ItemId'];
                                                    $name = $row['CurrentPrice'];
                                                    $code = $row['ItemName'];
                                                    $value = $row['TotalQuantity'];
                                                  ?>
                                                  <tr>
                                                <td><?php echo $id?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $code?></td>
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
        $stmtcoupon = $conn->prepare("SELECT I.product_id ItemId
        , I.product_name ItemName
        , I.product_price CurrentPrice
        , SUM(OL.quantity) TotalQuantity  
        FROM orderitems OL
        INNER JOIN (SELECT * FROM Orders) O ON OL.orders_id = O.order_id
        INNER JOIN product I ON OL.product_id = I.product_id
        GROUP BY I.product_id,I.product_price");
        $results = $stmtcoupon->execute();
        if($results){
            while ($row = $stmtcoupon->fetch()){
                $check[] = $row['ItemName'];
                $totalamount[] = $row['TotalQuantity'];
        
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
                'rgba(255, 159, 64,1)',
                'rgba(255, 205, 86,1)',
                'rgba(75, 192, 192,1)',
                'rgba(54, 162, 235,1)',
                'rgba(153, 102, 255,1)',
                'rgba(255, 159, 64,1)',
                'rgba(255, 205, 86,1)',
                'rgba(75, 192, 192,1)',
                'rgba(54, 162, 235,1)',
                'rgba(153, 102, 255,1)',
                'rgba(201, 203, 207,1)'
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
        <script src="../Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>
