<?php
session_start();

$id =  $_GET['id'];
include_once('../database/dbconn.php');


if(isset($_POST['review'])){
    include('../database/reviewDbConfig.php');

    $rate = $_POST['rate'];
    $desc = $_POST['description'];
    $prod = $id;
    $user_id = 4;

    setReview($user_id,$prod,$desc,$rate);
    
}

if(isset($_GET['id'])){
		
		// escape sql chars
        try{
        $id =  $_GET['id'];
        echo $id;

        $stmt = $conn->prepare("SELECT * FROM product WHERE prod_id = :id");      
        $stmt->bindParam(":id",$id);
        $result = $stmt->execute();
        $stmt2 = $conn->prepare("SELECT * FROM product_images WHERE prod_id=:prod_id");
        $stmt2->bindParam("prod_id",$id);
        $stmt2->execute();

        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }       
		

}
if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'],'product_id');
        if(in_array($_POST['product_id'],$item_array_id)){
            echo '<script>alert("Product has already been added")</script>';    
        } else {
            $count = count($_SESSION['cart']);
            if(empty($_POST['product_quantity'])){
                $quantity = 1;
            } else {
             $quantity = $_POST['product_quantity'];
            $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>$quantity);
            $_SESSION['cart'][$count] = $item_array;  
            print_r($_SESSION['cart']) ;
            }
        }
    } else {
        $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>1);
        $_SESSION['cart'][0] = $item_array;
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.css">
    <script src="../fontawesome-free-5.15.4-web/js/all.js"></script>
<link rel="stylesheet" href="test.css">
<link rel="stylesheet" href="../styles/ratingstyle.css">

    
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="row">
            <div class="col-md-6 my-2">
                <?php


                    $id =  $_GET['id'];

                    include_once('../database/dbconn.php');
                    $stmt = $conn->prepare("SELECT * FROM product WHERE prod_id = :id");      
                    $stmt->bindParam(":id",$id);
                    $result = $stmt->execute();
                ?>
            <?php while($row = $stmt->fetch()){ ?>
                    <?php $imgpath = $row['product_thumbnail'];?>

                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image mt-5"> <img src="../AddProducts/Thumbnail/<?php echo $imgpath;?>" id="main_product_image" class="img-thumbnail" width="350"> </div>
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <?php
                                $stmt2 = $conn->prepare("SELECT * FROM product_images WHERE prod_id=:prod_id ");
                                $stmt2->bindParam("prod_id",$id);
                                $stmt2->execute();
                                while($result = $stmt2->fetch()){
                                    $imgother = $result['img_name']
                                
                            ?>
                            <li><img onclick="changeImage(this)" src="../AddProducts/Uploads/<?php echo $imgother;?>" width="70"></li>
                            
                                <?php }?>
                                <li><img onclick="changeImage(this)" src="../AddProducts/Thumbnail/<?php echo $imgpath;?>" width="70"></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 shadow my-2">
                <div class="p-3 right-side text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3></h3>
                        
                        <button type="submit" class="btn btn-danger"><i class="fas fa-heart"></i>
                        </button>
                        
                    </div>
                    <div class="mt-2 content text-center">
                        <h4><?php echo $row['product_name'] ?></h4>
                    </div>
                    <h3><?php echo $row['product_price'] ?>.00 LKR</h3>
                    
                    
                       </div>
                       <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nam eum ipsam adipisci natus sunt, earum cum sit quas libero sint dolorem dolores autem, inventore asperiores voluptatibus labore ipsum nobis.</h6>
                       <?php    $prodid =  $row['prod_id']; ?>
                       
                            

                    
                    <div class="text-center">

                    <form action="" method="post">
                    <input type="hidden" name="product_id" value ="<?php $row['prod_id']?>">
                    <input type='hidden' class='quantity' name='product_quantity' value="1">
                    <div class="buttons mt-5 mb-2 gap-3"><button class="btn btn-dark" name="add">Add to Cart</button> </div>
                    </div>
                    </form>

                    <?php }?>
            <div >
            <form action="" method="post">
                 <textarea placeholder="Have an enquiry on this product please share it with us..." class="form-control" name="enquiry" id="" cols="30" rows="3"></textarea>
                 <div class="text-center mt-2">
                 <button class="btn btn-dark" type="submit" name="enquiry">
                    Send an enquiry
                 </button>
                 </div>
            </form>
            </div>

            </div>
        </div>
    </div>
    <div class="container card">
        <div class="text-center">
    <h1>Reviews</h1>

        </div>
    <div class="container">
        <hr>
        
            <?php
            $id = $_GET['id'];
                $stmt4 = $conn->prepare("SELECT * FROM review INNER JOIN user  ON review.user_id =user.user_id  WHERE product_id = $id");
                $stmt4->execute();
                while($review = $stmt4->fetch()){ ?>
          <div class="row">

                <div class="col-md-2"><?php  echo $review['username'];?></div>
                
                <div class="col-md-8">
                <?php echo $review['description'] ?>
                </div>
                <div class="col-md-2">
                <?php echo $review['created_at']; ?>
                </div>
                <hr>
        </div>
             <?php   }

            ?>

        <hr>
<?php
    $userid = 10;
    $stmt6 = $conn->prepare("SELECT * FROM orders WHERE user_id = $userid");
    $stmt6->execute();
    $count = $stmt6->RowCount();
    if($count>0){ ?>
        <form action="" method="post">
           <div class="row mt-3">
               <div class="col-md-2">

               </div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="description" id="" cols="30" rows="3"></textarea>
                    </div>
                <div class="col-md-2">
                    
                </div>
            </div>
        <div class="row text-center">
            <div class="col-md-3 ">
            <div class="rate">
            <input type="radio" id="star5" name="rate" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" />
            <label for="star1" title="text">1 star</label>
                </div>
        </div>
            
            <div class="col-md-7">

            </div>
            <div class="col-md-2 text-center">
            <button type="submit" class="btn btn-dark mb-2"name="review">Add</button>

            </div>
        </div>
                </div>
           </div>
</form>
   <?php }

?>
</div>
<div class="container card">
    <h1 class="text-center">Related Products</h1>
</div>
<div class="container card">
    <h1 class="text-center">Recently Sold</h1>
</div>
<div class="container card">
    <h1 class="text-center">Latest Products</h1>
</div>
    
</div>
                    
                </div>

</body>
<script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>

<script>
    function changeImage(element) {

var main_prodcut_image = document.getElementById('main_product_image');
main_prodcut_image.src = element.src;


}
</script>
</html>