<?php


if(isset($_POST['add'])){

// File upload configuration 
        include('../database/dbconn.php');


        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnailtmpname = $_FILES['thumbnail']['tmp_name'];       

        $thumbnailDestination = 'Thumbnail/'.$thumbnail;

        move_uploaded_file($thumbnailtmpname,$thumbnailDestination);


        $sku = $_POST['SKU'] ;        
        $name  = $_POST['name'] ;   
        $tags = $_POST['tags'] ;  
        $quantity = $_POST['Quantity'] ;  
        $price  = $_POST['price'] ;  
        $category  = $_POST['Category'] ;  
        

        $stmt = $conn->prepare("INSERT INTO product(product_sku,product_thumbnail,product_name,product_tags,product_quantity,product_price,product_category,product_status,created_at)
        VALUES (:sku,:thumbnail,:name,:tags,:quantity,:price,:category,:status,:created)");
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':created',$date );

        $status = 'Available';

        $date = date("Y/m/d");

        $stmt->execute();

        $prod_id = $conn->lastInsertId();

        $targetDir = "Uploads/"; 
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
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 

                    // Image db insert sql                    
                    $sql = "INSERT INTO product_images(prod_id,img_name) VALUES ('$prod_id','$fileName')";
                    $conn->exec($sql);
                    echo "Added images";
                
                    
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
        
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;          
        
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    }
    echo "New record created successfully";
}

?>
