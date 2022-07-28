<?php

include_once('../../database/enquiryDbconfig.php');

 if(isset($_GET['id'])){
		
    // escape sql chars
    try{
    $id =  $_GET['id'];        

    include_once('../../database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM product_enquiry AS enq INNER JOIN product as prod ON enq.product_id= prod.product_id WHERE id= $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['id']; 
    $enquiry = $result['enquiry']; 
    $response = $result['response'];
    $status = $result['isClosed'];
    $date = $result['created_at'];
    $productname = $result['product_name'];

    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }       
}else {
    header("Location:viewEnquiry.php");
}


$errors = array('response' =>'','status'=>'');
if(isset($_POST['submit'])){
    if(empty($_POST['response'])){
        $errors['response'] = 'You need to write a response before closing this enquiry';
        echo $errors['response'];
    } else {
        $response = $_POST['response'];
    }

    $id = $_POST['id'];
    if(array_filter($errors)){
			
    }else{
    $result = updEnquiry($id,$response);
    if($result){
        header("Location:viewNewEnquiry.php");
    }
    
}
if($result){
$errors['status']='Enquiry has been closed';
}else {
$errors['status']='An error has occured';
}
}

if(isset($_POST['select'])){
    
    $ans = $_POST['ans'];
   
    $result = updEnquiry($id,$ans);
    

if($result){
$errors['status']='Enquiry has been closed';
}else {
$errors['status']='An error has occured';
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
                    <h1 class="h3 mb-2 text-gray-800">Product Enquiry</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Enquiry for <?php echo $productname ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                <p>Enquiry Details :</p>
                                <p class="text-danger"><?php echo $errors['status'];?></p>

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                            <p><?php echo $date?></p>

                                </div>
                            </div>
                            <div>
                            <p><?php echo $enquiry?> ?</p>

                            </div>
                            <form action="" method="post">
                                <input type="text" name="response" placeholder="Add your response to this enquiry" class="form-control" required><br>
                                <div class="text-center">
                                    <input type="hidden" name="id" value=<?php echo $id ?>>
                                    <button type="submit" name="submit" class="btn btn-primary">Add response</button>
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
        <script src="../Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>
