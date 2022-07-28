<?php 
include('../../database/reservationsDbconfig.php');


$errors = array("code"=>'',"value"=>'',"name"=>'',"status"=>'');

if(isset($_GET['id'])){
		
    // escape sql chars
    try{
    $id =  $_GET['id'];        
    $result = getDataById($id);
    $id = $result['id']; 
    $name = $result['name']; 
    $number = $result['Telephone_Number']; 
    $email = $result['Email_Address']; 
    $date = $result['date']; 
    $purpose = $result['purpose'];
    $status = $result['status'];
    $feedback = $result['feedback'];

    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }       
}
if(isset($_POST['approve'])){


    $id = $_POST['resid'];   
    $feedback = $_POST['response'];

    approveReservation($id,$feedback);  
    $result = getDataById($id);
    $id = $result['id']; 
    $name = $result['name']; 
    $number = $result['Telephone_Number']; 
    $email = $result['Email_Address']; 
    $date = $result['date']; 
    $purpose = $result['purpose'];
    $status = $result['status']; 
    $feedback = $result['feedback'];
    }


if(isset($_POST['reject'])){
    
    try{
    $id = $_POST['resid'];
    $feedback = $_POST['response'];
    
    rejectReservation($id,$feedback);   
   $result = getDataById($id);
    $id = $result['id']; 
    $name = $result['name']; 
    $number = $result['Telephone_Number']; 
    $email = $result['Email_Address']; 
    $date = $result['date']; 
    $purpose = $result['purpose'];
    $status = $result['status'];
    $feedback = $result['feedback'];
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
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
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
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
                    <h1 class="h3 mb-2 text-gray-800">Reservation Request</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Reservation Request from <?php echo $name ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                <p>Reservation Details :</p>

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                                <p>From:<?php echo $name?></p>  

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                                <p><?php echo $number?></p>  

                                </div>
                            </div><div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                                <p> <?php echo $email?></p>  

                                </div>
                            </div>
                            
                            <p> Purpose:</p>
                            <p><?php echo $purpose?></p>  on
                            <p><?php echo $date?></p>  

                            </div>
                            <div class="col">
                                <div>
                            <div class="text-center">
                                <div class="status">
                                Status :<?php echo $status?>
                                </div>
                            </div>



                            </div>
                            <form action="" method="post">
                               
                                <input type="text" name="response" class="form-control" placeholder="Add your feedback"required>
                                
                                <div class="text-center">
                                    <input type="hidden" name="resid" value=<?php echo $id ?>>
                                    <button type="submit" name="approve" class="btn btn-danger"><i class="fas fa-check"></i></button>
                                    <button type="submit" name="reject" class="btn btn-success"><i class="fas fa-window-close"></i></button>

                            <form action="">
                                
                            </form>
                            </div>

                        </div>
                    </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>
