<?php
if(isset($_POST['disable'])){

    $id = $_POST['id'];
    include('../../database/productDbconfig.php');


    $result = disable($id);

    if($result){

    } else {

    }
}
if(isset($_POST['enable'])){

    $id = $_POST['id'];
    include('../../database/productDbconfig.php');
    $result = Active($id);

    if($result){
    } else {

    }
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
        <title>View All Products</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <style>
        img{
            width:100px;
            height:100px;
            object-fit:contain;
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
                    <h1 class="h3 mb-2 text-gray-800 mt-5">View All Products</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View All Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                    <?php
                                            
                                            try{
                                                  include('../../database/dbconn.php');        
                                                  $stmt = $conn->prepare("SELECT *
                                                  FROM product WHERE product_price BETWEEN '13500' AND '25000';");
                                                  $stmt->execute();
                                                  while($prod = $stmt->fetch()){
                                                        $productid = $prod['product_id'];
                                                        $thumbnail = $prod['product_thumbnail'];
                                                        $name = $prod['product_name'];
                                                        $price = $prod['product_price'];
                                                        $quantity = $prod['product_quantity'];
                                                        $date = $prod['created_at'];
                                                        $status =$prod['product_status'];
                                                  ?>
                                                  <tr>
                                                    <td><a href="viewSingleProduct.php?id=<?php echo $productid ?>"><img style="width:100px" src="../../AddProducts/Thumbnail/<?php echo $thumbnail; ?>"></a></td>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $price; ?></td>
                                                    <td><?php echo $quantity; ?></td>
                                                    <td><?php echo $date; ?></td>
                                                    <td><?php echo $status; ?></td>

                                                    <td><form action="" method="post">
                                                        <input type="hidden" name="id" value=<?php echo $productid ?>>
                                                        <button type="submit" name="disable" class="btn btn-danger"><i class="fas fa-window-close"></i></button>
                                                        <button type="submit" name="enable" class="btn btn-warning"><i class="fas fa-check"></i></button>
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
