<?php
$sku = $name = $quantity = $tags= $desc = $price='';
$errors = array('name'=>'','price'=>'','errorUploadType'=>'','errorUpload'=>'','statusMsg'=>'','thumbnail'=>'','quantity'=>'');
     
     if(isset($_POST['submit'])){
         // File upload configuration 
                     $sku = $_POST['SKU'] ;        
                     $name  = $_POST['name'] ;   
                     if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
                         $errors['name'] = 'Name must be letters only';
                     }
                     $desc = $_POST['desc'];
                     $tags = $_POST['tags'];  
                     $subcategory = $_POST['category'];
                     $quantity = $_POST['Quantity'] ;  
                     $price  = $_POST['price'];
                     if(!preg_match('/^[0-9]+$/', $price)){
                         $errors['price'] = 'Price must only be numbers';
                     }
                     if(!preg_match('/^[0-9]+$/', $quantity)){
                         $errors['quantity'] = 'Quantity must only be numbers';
                     }
                     $category_id  = $_POST['category'] ;
     
         include('../../database/dbconn.php');
     
     
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
                 
     
     
         $allowTypes = array('jpg','png','jpeg','gif');
         //$allowed_extensions = array(".jpg","jpeg",".png",".gif");
         // Validation for allowed extensions .in_array() function searches an array for a specific value.
        // if(!in_array($extension,$allowed_extensions))
        // {
        // $errors['thumbnail'] ="Invalid type. Please select valid image types";
        // }
        // else
         //{
         //rename the image file
         //$imgnewname = md5($thumbnailname).$extension;
         // Code for move image into directory
         if(move_uploaded_file($_FILES["thumbnail"]["tmp_name"],"../../AddProducts/Thumbnail/".$imgNewName)){
             if(array_filter($errors)){
     
             }else {
                 $stmt =$conn->prepare("INSERT INTO product(product_sku,product_thumbnail,product_name,product_description,product_tags,product_quantity,product_price,product_status,product_subcategory) VALUES(:sku,:thumbnail,:name,:desc,:tags,:quantity,:price,:status,:subcategory)");
                 $stmt->bindParam(':sku', $sku);
                 $stmt->bindParam(':thumbnail', $imgNewName);
                 $stmt->bindParam(':name', $name);
                 $stmt->bindParam(':desc', $desc);
                 $stmt->bindParam(':tags', $tags);
                 $stmt->bindParam(':quantity', $quantity);
                 $stmt->bindParam(':price', $price);
                 $status = 'Active';
                 $stmt->bindParam(':status', $status);
                 $stmt->bindParam(':subcategory', $subcategory);

                 $prod = $stmt->execute();
                 $prod_id = $conn->lastInsertId();
                 if($prod){
                    $targetDir = "../../AddProducts/Uploads/"; 
                    $allowTypes = array('jpg','png','jpeg','gif'); 
                 
                    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
                    $fileNames = array_filter($_FILES['files']['name']); 
                    if(!empty($fileNames)){ 
                        foreach($_FILES['files']['name'] as $key=>$val){ 
                            // File upload path 
                            $fileName = basename($_FILES['files']['name'][$key]); 
                            $targetFilePath = $targetDir . $fileName; 
                            
                            // Check whether file type is valid 
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                            if(in_array($fileType, $allowTypes)){ 
                                // Upload file to server 
                                $filenewName = uniqid("",true).'.'.$fileType;
                                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key],"../../AddProducts/Uploads/".$filenewName)){ 
                                    // Image db insert sql 
                                    $insertValuesSQL .=  "('".$filenewName."', '$prod_id'),";; 
                                }else{ 
                                    //error uploading image
                                $errors['errorUpload'] = "Error uploading image";
            
                                    //$errorUpload .= $_FILES['files']['name'][$key].' | '; 
                                } 
                            }else{ 
                                //invalid type
                                $errors['errorUploadType'] = "File type is invalid";
                                //$errorUploadType .= $_FILES['files']['name'][$key].' | '; 
                            } 
                        } 
                        
                        // Error message 
                        /*$errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; */
            
                        
                        if(!empty($insertValuesSQL)){ 
                            if(array_filter($errors)){
                                $stmt2 = $conn->prepare("UPDATE product SET product_status = 'ERR' WHERE product_id = $prod_id");
                                $stmt2->execute();
                            } else {
                                $insertValuesSQL = trim($insertValuesSQL, ','); 
                                // Insert image file name into database 
                                $stmt1 = $conn->prepare("INSERT INTO product_images(image_name,product_id) VALUES $insertValuesSQL"); 
                                $result = $stmt1->execute();
                                    if($result){ 
                                        header("Location:viewActiveProducts.php");
                                    }else{ 
                                        $errors['statusMsg'] = "Sorry, there was an error uploading your file."; 
                                    } 
                                  }
                                }else{ 
                                    $errors['statusMsg'] = "Upload failed! ".$errorMsg; 
                                } 
                            }else{ 
                                $errors['statusMsg'] = 'Please select a file to upload.'; 
                            } 
                        }
                        else
                        {
                        echo "<script>alert('Data not inserted');</script>";
                        }
                }
             }
             } else {
                 $errors['thumbnail']="Failed to insert image";
             }
             }
                 
         // Query for insertion data into database
              
     
         
         
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
        <title>Add Products</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Add Product</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                        </div>
                        <div class="card-body">
                        <div class="container">
        <h1 class="text-center">Add Products</h1>
<form action="" method="post" enctype="multipart/form-data">
        <div class="row">
    <div class="col-md-6">

        <label for="file-upload">Add thumbnail</label><br>
        <input type="file" id="file-upload" class="form-control" accept="image/*" onchange="showPreview(event);" name="thumbnail" required><br><br>
        <p class="other">Other Images</p>
        <input type="file"  name="files[]" multiple class="form-control" accept="image/*"><br><br>
        <div>
        <div class="text-danger"><?php echo $errors['errorUploadType'] ?></div>
         <div class="text-danger"><?php echo $errors['errorUpload'] ?></div>
         <div class="text-danger"><?php echo $errors['statusMsg'] ?></div>

            <label for="">SKU Number</label>
                <div class="form-input"> <i class="fa fa-envelope"></i> <input type="text" class="form-control" placeholder="SKU Number" name="SKU" required value="<?php echo $sku ?>"> </div>
                <label for="">Name</label>
                
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Product name" name="name" value="<?php echo $name ?>" required> </div>
                <label for="">Description</label>
                
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Product Description " name="desc" value="<?php echo $desc ?>" required> </div>
                <label for="">Quantity</label>

                <div class="form-input"> <i class="fa fa-user"></i> <input type="number" class="form-control" placeholder="Quantity" min="0" name="Quantity" required value="<?php echo $quantity ?>"> </div>
                <label for="">Tags</label>
                <div class="form-input"> <i class="fas fa-mobile"></i> <input type="text" class="form-control" placeholder="Tags" name="tags" required value="<?php echo $tags ?>"> </div>

                <label for="categories" class="form-label">Sub Categories</label>
                <?php   
                   
                    try{
            
                    include_once('../../database/dbconn.php');
                    $stmt = $conn->prepare("SELECT * FROM Sub_category");
                    $results = $stmt->execute();
                    
                    
            
                    } catch(PDOException $e) {
                    echo $e->getMessage();
                    return false;
                    }
                 ?>
                 <select class="form-select form-control" id="categories" name="category" >
                 <?php 
                while($row = $stmt->fetch()){
                    $id =$row['sub_category_id'];
                    $name = $row['sub_category_name'];
                    ?>  
              
                <option value="<?php echo $id;?>"><?php echo $name;?></option>
                <?php } ?>
                
              </select>

                
                <label for="">Price</label>

                <div class="form-input"> <i class="fas fa-mobile"></i> <input type="text" class="form-control" placeholder="Price" name="price" value="<?php echo $price ?>" required> </div>
                <div class="text-danger">
                   <?php echo $errors['price']; ?>
                </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="preview">
                    <img id="file-preview" class="img-fluid rounded ">
            </div>
        </div>
            <div class="text-center"><br>
                <button type="submit" class="btn btn-primary border border-dark rounded-3" name="submit">Add</button>
            </div>
        </div>

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
        <script src="previewImage.js"></script>
        <script src="../Admin/js/datatables-simple-demo.js"></script>
    </body>
</html>
