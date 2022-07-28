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
        echo $id;
        $directory = "../../AddProducts/Thumbnail/";
        $allowTypes = array('jpg','png','jpeg','gif');
         // get the image extension
         //$extension = substr($thumbnailname,strlen($thumbnailname)-4,strlen($thumbnailname));
         // allowed extensions
         $imgName = basename($_FILES['thumbnail']['name']); 
         $imgPath = $directory . $imgName;
         $imgType = pathinfo($imgPath, PATHINFO_EXTENSION); 
             if(in_array($imgType,$allowTypes)){
                 $imgNewName = uniqid("",true).'.'.$imgType;
        
         if(move_uploaded_file($_FILES["thumbnail"]["tmp_name"],"../../AddProducts/Thumbnail/".$imgNewName)){
        include('../../database/productDbconfig.php');

            if(array_filter($errors)){

            }else {
               $result = updThumbnail($id,$imgNewName);
        
            }
             } else {
                 $errors['thumbnail']="Failed to insert image";
             }
             }
    
    

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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <title>Image Update</title>

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
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value=<?php echo $id?>>
                                <input type="file" class="form-control" accept="image/*" name="thumbnail" required>
                                <div class="text-center">
                                 <button type="submit" class="btn btn-primary mt-2"name="update">Update Thumbnail</button>
                                </div>    
                            </form>                            
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
