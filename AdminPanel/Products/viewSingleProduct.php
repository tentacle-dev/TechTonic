<?php

$errors = array('name'=>'','price'=>'','quantity'=>'');
 if(isset($_GET['id'])){
		
    // escape sql chars
    try{
    $id =  $_GET['id'];        

    include_once('../../database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id= $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['product_id']; 
    $name = $result['product_name']; 
    $sku = $result['product_sku']; 
    $tags=$result['product_tags'];
    $price = $result['product_price'];
    $status = $result['product_status'];
    $quantity = $result['product_quantity'];
    $thumbnail = $result['product_thumbnail'];



    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }       

}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $tags = $_POST['tags'];
    $category =$_POST['category'];


    $price = $_POST['price'];
    if(!preg_match('/^[0-9]+$/', $price)){
        $errors['price'] = 'Price must only be numbers';
    }
    $quantity = $_POST['quantity'];
    if(!preg_match('/^[0-9]+$/', $quantity)){
        $errors['quantity'] = 'Quantity must only be numbers';
    }

    include('../../database/productDbconfig.php');
    if(array_filter($errors)){

    }else {
       $result = updProduct($id,$name,$sku,$quantity,$price,$tags,$category);

    }

    if($result){
        
    } else {

    }
}

if(isset($_POST['disable'])){

    $id = $_POST['id'];
    include('../../database/productDbconfig.php');


    $result = disable($id);

    if($result){
        
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id= $id");      
    $result = $stmt->execute();
    $result = $stmt->fetch();
    $id = $result['product_id']; 
    $name = $result['product_name']; 
    $sku = $result['product_sku']; 
    $tags=$result['product_tags'];
    $price = $result['product_price'];
    $status = $result['product_status'];
    $quantity = $result['product_quantity'];
    $thumbnail = $result['product_thumbnail'];
    } else {

    }
}
if(isset($_POST['enable'])){
   

    $id = $_POST['id'];
    include('../../database/productDbconfig.php');
    $result = Active($id);

    if($result){
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_id= $id");      
        $result = $stmt->execute();
        $result = $stmt->fetch();
        $id = $result['product_id']; 
        $name = $result['product_name']; 
        $sku = $result['product_sku']; 
        $tags=$result['product_tags'];
        $price = $result['product_price'];
        $status = $result['product_status'];
        $quantity = $result['product_quantity'];
        $thumbnail = $result['product_thumbnail'];  
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
        <title>Single Product</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <style>
        img{
            width:800px;
            height:400px;
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
                    <h1 class="h3 mb-2 text-gray-800">Product <?php echo $name?></h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product is <?php echo $status ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                <p>Product Details :</p>

                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                                    <div class="status" style="background-color:#fff;">
                                         Status :<?php echo $status?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p><?php echo $price?></p>
                                <div class="text-center">
                                    
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        SKU number:
                                        <input type="text" class="form-control" name="sku" value="<?php echo $sku?>" required><br>
                                        Name: 
                                        <input type="text" class="form-control" name="name" value="<?php echo $name?>" required><br>
                                        Price: 
                                        <input type="number" class="form-control" name="price" value=<?php echo $price; ?>><br>
                                        <div class="text-danger" required>
                                            <?php echo $errors['price'] ?></div>
                                        Quantity: 
                                        <input type="number" class="form-control" name="quantity" value=<?php echo $quantity; ?> required><br>
                                        Category: 
                                        <?php   
                                            try{
                                    
                                            include_once('../../database/dbconn.php');
                                            $stmt = $conn->prepare("SELECT * FROM Sub_category INNER JOIN main_category ON sub_category.main_category_id = main_category.main_category_id");
                                            $results = $stmt->execute();
                                    
                                            } catch(PDOException $e) {
                                            echo $e->getMessage();
                                            return false;
                                            }
                                        ?>
                                        <select class="form-select form-control" id="categories" name="category" >
                                        <?php 
                                        while($row = $stmt->fetch()){
                                            $subid =$row['sub_category_id'];
                                            $subname = $row['sub_category_name'];
                                            $mainname = $row['main_category_name'];
                                            ?>  
                                    
                                        <option value="<?php echo $subid;?>"><?php echo $subname;?>-<?php echo $mainname ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                        Product tags: 
                                        <input type="text" class="form-control" name="tags" value=<?php echo $tags; ?> required><br>
                                        <div class="text-danger"><?php echo $errors['quantity'] ?></div>
                                    <button class="btn btn-warning" name="enable"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-danger" name="disable"><i class="fas fa-window-close"></i></button>
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>

                                    </div>
                                    

                                    <div class="col-md-9">
                                      <img src="../../AddProducts/Thumbnail/<?php echo $thumbnail?>" alt="">
                                    </div>
                                </div>

                                
                                
                                <div class="text-center">
                                   
                                    <input type="hidden" name="id" value=<?php echo $id ?>>
                                    
                                    <a href="updateImage.php?id=<?php echo $id?>" class="btn btn-warning">Update thumbnail</a>

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
