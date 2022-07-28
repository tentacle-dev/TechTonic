<?php 
if(isset($_POST['hide'])){
    include('../../database/reviewDbconfig.php');
    $reviewID = $_POST['reviewID'];

    $result = hideReview($reviewID);
    if($result){
        header('Location:viewReviews.php');
    } else {
        echo 'Error';
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
        <title>SRT Admin</title>
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
                        <h1 class="mt-4">View new reviews </h1>
                        
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                View new reviews 
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Product</th>
                                            <th>Description</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User</th>
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
                                                  $stmt = $conn->prepare("SELECT *
                                                  FROM review
                                                 INNER JOIN user ON user.user_id = review.user_id
                                                 INNER JOIN product ON product.product_id = review.product_id WHERE status=''");
                                                  $stmt->execute();
                                                  while($review = $stmt->fetch()){
                                                      $reviewID = $review['id'];
                                                        $username = $review['username'];
                                                        $productname = $review['product_name'];
                                                        $description = $review['description'];
                                                        $date = $review['created_at'];
                                                        $rating =$review['rating'];
                                                  ?>
                                                  <tr>
                                                    <td><?php echo $username; ?></td>
                                                    <td><?php echo $productname; ?></td>
                                                    <td><?php echo $description; ?></td>
                                                    <td><?php echo $rating; ?></td>
                                                    <td><form action="" method="post">
                                                        <input type="hidden" name="reviewID" value=<?php echo $reviewID ?>>
                                                        <button type="submit" name="hide" class="btn btn-danger">Hide</button>
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
