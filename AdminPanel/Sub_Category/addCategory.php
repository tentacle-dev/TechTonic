
<?php 
$errors = array('name'=>'','desc'=>'','status'=>'');
if(isset($_POST['add'])){
    include('../../database/categoryDbconfig.php');
    $categoryname = $_POST['name'];
    $mainid = $_POST['main_category'];
    $result = setSubCategory($categoryname,$mainid);
    if($result){
      header("Location:viewCategory.php");
    } else {
      $errors['status'] ='Error when adding';
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
        <style>
            .form-input {
                position: relative;
                margin-bottom: 10px;
                margin-top: 10px
            }

            .form-input i {
                position: absolute;
                font-size: 18px;
                top: 15px;
                left: 10px
            }

            .form-control {
                height: 50px;
                background-color: #1c1e21;
                color:#fff;
                text-indent: 24px;
                font-size: 15px
            }

            .form-control:focus {
                box-shadow: none;
                border-color: #4f63e7;
            }

            .form-check-label {
                margin-top: 2px;
                font-size: 14px
            }
        </style>
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
                        <h1 class="mt-4">Add Category</h1>
                        
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Category 
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 text-center" >
                                        <form action="" method="post">
                                            <label for=""></label>
                                            <input type="text" class="form-control" name='name'>
                                            <label for="categories" class="form-label">Categories</label>
                                            <?php   
                                            
                                                try{
                                        
                                                include_once('../../database/dbconn.php');
                                                $stmt = $conn->prepare("SELECT * FROM main_category");
                                                $results = $stmt->execute();
                                                
                                                
                                        
                                                } catch(PDOException $e) {
                                                echo $e->getMessage();
                                                return false;
                                                }
                                            ?>
                                            <select class="form-control" id="categories" name="main_category" >
                                            <?php 
                                            while($row = $stmt->fetch()){
                                                $id =$row['main_category_id'];
                                                $name = $row['main_category_name'];
                                                ?>  
                                        
                                            <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                            <?php } ?>
                                            
                                        </select><br>
                                        <button type="submit" class="btn btn-dark" name="add">Add</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6"></div>
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