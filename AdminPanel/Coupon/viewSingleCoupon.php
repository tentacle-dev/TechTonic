<?php 

$errors = array("code"=>'',"value"=>'',"name"=>'',"status"=>'');

if(isset($_GET['id'])){
		
    // escape sql chars
    try{
    $id =  $_GET['id'];        

    include_once('../../database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM coupon WHERE coupon_id = $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['coupon_id']; 
    $name = $result['coupon_name']; 
    $code = $result['coupon_code'];
    $value = $result['coupon_value'];
    $status = $result['status'];
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }       
}
if(isset($_POST['update'])){
    include('../../database/promoDbconfig.php');

    $id = $_POST['id'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $value = $_POST['value'];
    if(!preg_match('/^[0-9]+$/', $value)){
        $errors['value'] = 'Value must only be numbers';
    } elseif($value > 100 && $value < 0 ) {
        $errors['value'] = 'Invalide Value number';
    }
    
    if(array_filter($errors)){

    } else {
        $result = updPromo($id,$name,$code,$value);
    }

    if($result){ 
        $errors['status'] = 'Updated Successfully';

    } else {
        $errors['status'] = 'Unsuccessful';
    }
}
if(isset($_POST['delete'])){
    try{
    include('../../database/promoDbconfig.php');
    $id = $_POST['id'];
    $result = delPromo($id);   
    if($result){ 
        $errors['status'] = 'Updated Successfully';

    } else {
        $errors['status'] = 'Unsuccessful';
    }
    $stmt = $conn->prepare("SELECT * FROM coupon WHERE coupon_id = $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['coupon_id']; 
    $name = $result['coupon_name']; 
    $code = $result['coupon_code'];
    $value = $result['coupon_value'];
    $status = $result['status'];
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }          
} 

if(isset($_POST['activate'])){
    try{
    include('../../database/promoDbconfig.php');
    $id = $_POST['id'];
    $result = actPromo($id);
    if($result){ 
        $errors['status'] = 'Updated Successfully';

    } else {
        $errors['status'] = 'Unsuccessful';
    }
    $stmt = $conn->prepare("SELECT * FROM coupon WHERE coupon_id = $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['coupon_id']; 
    $name = $result['coupon_name']; 
    $code = $result['coupon_code'];
    $value = $result['coupon_value'];
    $status = $result['status'];
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
        <link href="../Admin/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />

        <title>View coupon</title>

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
                        <h1 class="h3 mb-2 text-gray-800">Coupon</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Coupon <?php echo $name ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                <p>Coupon Details :</p>

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                            

                            <div>
                            <div class="text-center">
                                <div class="status">
                                Status :<?php echo $status?>
                                </div>
                            </div>



                            </div>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                    <input type="text" class="form-control" name="name" value="<?php echo $name?>" ><br>
                                    <div class="text-danger"><?php echo $errors['name'] ?></div>
                                    <input type="text" class="form-control" name="code" value="<?php echo $code?>"><br>
                                    <div class="text-danger"><?php echo $errors['code'] ?></div>
                                    <input type="text" class="form-control" name="value" value="<?php echo $value?>"><br>
                                    <div class="text-danger"><?php echo $errors['value'] ?></div>
                                    
                                    </div>
                                    <div class="col-md-6">
                                      

                                      <div class="col-md-3">

                                      </div>
                                    </div>
                                </div>

                                <textarea name="response" class="form-control" id="" cols="30" rows="2" placeholder="Change Description"></textarea required><br>
                                <div class="text-center">
                                    <input type="hidden" name="id" value=<?php echo $id ?>>
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                    <button type="submit" name="activate" class="btn btn-success">Active</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Disable</button>

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
