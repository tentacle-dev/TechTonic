<?php



$errors = array('name'=>'','desc'=>'','status'=>'');
 if(isset($_GET['id'])){
		
    // escape sql chars
    try{
    $id =  $_GET['id'];        

    include_once('../../database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM sub_category WHERE sub_category_id= $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['sub_category_id']; 
    $name = $result['sub_category_name']; 
    $status = $result['sub_category_status'];

    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }       

}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $main = $_POST['category'];

    include('../../database/categoryDbconfig.php');
    $result = updSubCategory($id,$name,$main);
    if($result){
        header("Location:viewCategory.php");

    } else {

    }
}

if(isset($_POST['disable'])){
    $id = $_POST['id'];
    include('../../database/categoryDbconfig.php');

    $result = delSubCategory($id);

    if($result){
       header("Location:viewCategory.php");

    } else {

    }
}
if(isset($_POST['active'])){
    $id = $_POST['id'];
    include('../../database/categoryDbconfig.php');

    $result = actSubCategory($id);

    if($result){
       header("Location:viewCategory.php");

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
                        <h1 class="mt-4">View Category</h1>
                        
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category <?php echo $name ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                <p>Category Details :</p>
                                <p class="text-danger"><?php echo $errors['status'];?></p>

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">


                                </div>
                            </div>
                            <div>

                            </div>
                            <form action="" class="form-group" method="post">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" value=<?php echo $name ?>><br><br>
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
                                        <select class="form-select form-control" id="categories" name="category" >
                                        <?php 
                                        while($row = $stmt->fetch()){
                                            $main_id =$row['main_category_id'];
                                            $name = $row['main_category_name'];
                                            ?>  
                                    
                                        <option value="<?php echo $main_id;?>"><?php echo $name;?></option>
                                        <?php } ?>
                                        
                                    </select>
                                    <input type="hidden" name="id" value=<?php echo $id ?>>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div><br>
                                <div class="text-center">

                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                    <?php if($status == 'Active'){ ?>
                                        <button type="submit" name="disable" class="btn btn-danger">Disable</button>
                                    <?php
                                    } else { ?>
                                        <button type="submit" name="active" class="btn btn-success">Enable</button>
                                    <?php
                                    }
                                    ?>
                                    
                                    
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
