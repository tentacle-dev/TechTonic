<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SRT Admin</title>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                                <?php
                                                   include('../../database/adminDbconfig.php');

                                                   $sum = monthly();
                                                     
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sum  ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                          <?php
                                            
                                          ?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <?php
                                              $enquiry = enquiry();
                                                ?>
                                                New Enquiry</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $enquiry ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Customers
                                                <?php
                                                $customers = customers(); ?>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $customers ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                New orders</div>
                                                <?php
                                                   $orders = newOrders();

                                                  ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $orders ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                         Order chart 
                                    </div>
                                    <div class="card-body"><canvas id="bar"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Category chart 
                                    </div>
                                    <div class="card-body"><canvas id="pie"></canvas></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                         Monthly chart 
                                    </div>
                                    <div class="card-body"><canvas id="month"></canvas></div>
                                </div>
                            </div>
                            <?php include('../Admin/templates/logout.php');?>
                            <div class="col-xl-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Coupon chart
                                    </div>
                                    <div class="card-body"><canvas id="radar"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('../Admin/templates/footer.php') ?>
            </div>
        </div>
        <?php
         
         //database connection
         include('../../database/dbconn.php');
         //sql 
         try{
         $stmt = $conn->prepare("SELECT 
         MONTHNAME(created_at) as mname, 
         sum(sub_total) as total
         FROM orders WHERE isPaid='Paid'
         GROUP BY MONTH(created_at)");
         //execute sql
         $result = $stmt->execute();
      while ($row = $stmt->fetch()){
 
     $month[] =  $row['mname'];
 
      $total[] =  $row['total'];
 
 
  }
 }catch(PDOException $e){
     $e->getMessage();
 } 
 
 include('../../database/dbconn.php');
 $stmt4 = $conn->prepare("SELECT * FROM orders WHERE isPaid='Paid'");
 $results = $stmt4->execute();
 if($results){
     while ($row = $stmt4->fetch()){
         $id[] = $row['order_id'];
         $amount[] = $row['sub_total'];
     }
 
 } else {
     echo "Error";
 }
 
 $stmtcoupon = $conn->prepare("SELECT * FROM orders WHERE isPaid='Paid'");
 $results = $stmtcoupon->execute();
 if($results){
     while ($row = $stmtcoupon->fetch()){
         $check[] = $row['order_id'];
         $sub[] = $row['sub_total'];
         $coupon[] = $row['coupon_Discount'];
 
         $totalamount[] = $row['total'];
 
     }
 
 } else {
     echo "Error";
 }
 include('../../database/dbconn.php');
 $stmt1 = $conn->prepare("SELECT * FROM sub_category");
 $stmt1->execute();
 while($row = $stmt1->fetch()){
     $categoryname[] = $row['sub_category_name'];
     $cat = $row['sub_category_id'];
     $stmt2 = $conn->prepare("SELECT * FROM product WHERE product_subcategory = $cat");
     $stmt2->execute();
     $categorycount[] = $stmt2->RowCount();
 }
 
 ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../Admin/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script>

const dataradar = {
  labels: <?php echo json_encode($check) ?>,
  datasets: [{
    label: 'SUB TOTAL',
    data: <?php echo json_encode($sub) ?>,
    fill: true,
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgb(255, 99, 132)',
    pointBackgroundColor: 'rgb(255, 99, 132)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(255, 99, 132)'
  }, {
    label: 'TOTAL',
    data: <?php echo json_encode($totalamount) ?>,
    fill: true,
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgb(54, 162, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'
  },
  {
    label: 'Discount',
    data: <?php echo json_encode($coupon) ?>,
    fill: true,
    backgroundColor: 'rgba(170,255,0,0.8)',
    borderColor: 'rgb(255, 255, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'
  }]
};

const configradar = {
  type: 'radar',
  data: dataradar,
  options: {
    elements: {
      line: {
        borderWidth: 3
      }
    }
  },
};
const labelsbar = <?php echo json_encode($id) ?>;
  const databar = {
    labels: labelsbar,
    datasets: [{
      label: 'Orders',
      data: <?php echo json_encode($amount) ?>,
      backgroundColor: [
        'rgba(255, 99, 132,1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 99, 132,1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 99, 132,1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(201, 203, 207, 1)'
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
    type: 'bar',
    data: databar,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };
  const labelsmon = <?php echo json_encode($month) ?>;
  const datamon = {
    labels: labelsmon,
    datasets: [{
      label: 'Monthly Orders',
      data: <?php echo json_encode($total) ?>,
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

  const configmon = {
    type: 'bar',
    data: datamon,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };
  const datapie = {
  labels: <?php echo json_encode($categoryname)?>,
  datasets: [{
    label: 'My First Dataset',
    data: <?php echo json_encode($categorycount)?>,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 1, 235)',
      'rgb(1, 205, 86)',
      'rgb(255, 99, 1)',
      'rgb(54, 1, 235)',
      'rgb(255, 205, 1)',
      'rgb(1, 99, 132)',
      'rgb(54, 45, 235)',
      'rgb(255, 205, 1)',
      'rgb(11, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(25, 205, 2)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 4)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(1, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 5, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
    ],
    hoverOffset: 4
  }]
};

const configpie = {
  type: 'doughnut',
  data: datapie,
};

var month = new Chart(
    document.getElementById('month'),
    configmon
  );

var pieChart = new Chart(
    document.getElementById('pie'),
    configpie
  );

  var myChart1 = new Chart(
    document.getElementById('bar'),
    configbar
  );
  var radar = new Chart(
    document.getElementById('radar'),
    configradar
  );
  </script>

    </body>
</html>
