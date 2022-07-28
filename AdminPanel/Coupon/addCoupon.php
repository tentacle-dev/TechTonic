
<?php 
include('../../database/promoDbconfig.php');

$errors = array("value"=>'');

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $code = $_POST['code'];
    $value = $_POST['value'];
    if(!preg_match('/^[0-9]+$/', $value)){
        $errors['value'] = 'Value must only be numbers';
    } elseif($value > 100 && $value < 0 ) {
        $errors['value'] = 'Invalid Value number';
    }
    $slogan = $_POST['slogan'];
    if(array_filter($errors)){

    } else {
        $result = setPromo($name,$code,$value,$slogan);
        if($result){
        } else {
        }
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
        <title>Coupon - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />

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
                        <h1 class="mt-4">Add Coupon</h1>
                        
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Coupon 
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6">
                                    <label for="">Coupon name</label>       
                                        <input class="form-control" type="text" name="name" placeholder="Coupon name" required><br>
                                        <label for="">Coupon code</label>
                                        <input class="form-control" type="text" name="code" placeholder="Coupon code" required><br>
                                        <label for="">Coupon Slogan</label>
                                        <textarea class="form-control" name="slogan" id="" cols="30" rows="3"></textarea><br>
                                        <label for="">Promo percentage to be waived from the final bill</label>
                                        <input class="form-control" type="text" name="value" placeholder="Coupon percentage" required><br>    
                                        <div class="text-center my-2">
                                        <div class="text-danger">
                                            <?php echo $errors['value'] ?>
                                        </div>
                                        <button type="submit" class="text-center btn btn-primary" name="add">Add coupon</button>
                                    
                                    </div>
                                    <div class="col-md-3">
                                        
                                    </div>
                                      


                                    </div>
                                </div>

                                
                                    

                            </form>
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