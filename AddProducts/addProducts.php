<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="addprodstyle.css">
    <style>
        .img-preview{
            width:100px;
            height:auto;
        }

    </style>

    
</head>
<body>
    <div class="d-flex justify-content-center">
        <form action="" method="post">
            <div class="row text-center">
                Hello world
            </div>
        </form>
    </div>
    <div class="container text-center">
        <!-------Encoding at form by using multipart/form data for enctype------------>
    <form action="addprodforms.php" class="" method="POST" enctype="multipart/form-data">
        <div class="row mt-5">
            <div class="col">
                <div class="image-input">
                    
                    <input type="file" id="file-upload" accept="image/*" onchange="showPreview(event);" name="thumbnail">
                    <input type="file" name="files[]" multiple>
            <div class="preview">
                    <img id="file-preview" class="img-preview">
            </div>
                </div>
            
            </div>
            <div class="col">

                <button type="submit" name="add">Add product</button>
                 <div class="form-input"> <i class="fa fa-envelope"></i> <input type="text" class="form-control" placeholder="SKU Number" name="SKU"> </div>
                
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Product name " name="name"> </div>

                <div class="form-input"> <i class="fa fa-user"></i> <input type="number" class="form-control" placeholder="Quantity" name="Quantity"> </div>

                <div class="form-input"> <i class="fas fa-mobile"></i> <input type="text" class="form-control" placeholder="Tags" name="tags"> </div>

                <div class="form-input"> <i class="fas fa-mobile"></i> <input type="text" class="form-control" placeholder="Price" name="price"> </div>
                

                <div class="form-input">
                <label for="Category">Choose the category </label>
                <select name="Category" id="Category">
                <option value="Saree">Saree</option>
                <option value="Shalwar">Shalwar</option>
                <option value="Other">Other</option>
                
                </div>

               
                
               
               


            </div>
            <div class="col">

            </div>
            <div class="col">
            
            </div>

        </div>
    </form>
    </div>
    <script src="previewImage.js"></script>
    <script src="Bootstrap/bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>

</body>
</html>