<?php 
session_start();


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
            
            }
            $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>$quantity);
            $_SESSION['cart'][$count] = $item_array;  
            print_r($_SESSION['cart']);
        }
    } else {
        $item_array = array('product_id'=>$_POST['product_id'],'product_quantity'=>1);
        $_SESSION['cart'][0] = $item_array;
        print_r($item_array);

    }
}



	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
        try{
        $id =  $_GET['id'];
        echo $id;

        include_once('database/dbconn.php');
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

    if(isset($_POST['review'])){
        $user = $_SESSION['user_id'];
        $prod = $_GET['id'];
        $desc = $_POST['desc'];
        $rating = $_POST['rating'];

        setReview($user_id,$prod,$desc,$rate);

    }

?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
<link rel="stylesheet" href="../styles/ratingstyle.css">

<title>Single Product <?php ?></title>
</head>
<html>




	<div class="container center">

            <?php while($row = $stmt->fetch()){ ?>

                <form action="" method="post">
                    <?php $imgpath = $row['product_thumbnail'];?>
                <div class="row">
                    <div class="col-md-5">
                    <img class="img-fluid" src="../AddProducts/Thumbnail/<?php echo $imgpath;?>" alt="">
                    </div>
                    <div class="col-md-7">
                    <h5><?php echo $row['prod_id'];?></h5>
                

                <input type="text" name="product_id" value ="<?php $row['product_id']?>">
                <input type="hidden" name="product_quantity" value ="1">

                <?php   $productname =$row['product_name'];?>
                <h5><?php echo $productname;?></h5>
                
                    </div>
                </div>
                <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                </form>
                <div class="row">
                <?php while($imgs = $stmt2->fetch()){?>
                    <?php $imgpath = $imgs['img_name']; ?>

                    
                    
                        <div class="col-md-1">
                        <img class="img-fluid" src="../AddProducts/UploadsTest/<?php echo $imgpath;?>" alt="...">
                    </div>
                       
                <?php }?>
                </div>


              <?php  }?>
              <form action="" method="post">


              <?php
                    if(isset($_SESSION['user_id'])){?>
                        <textarea class="form-control" name="desc" id="" cols="30" rows="3"></textarea>
                        <div class="rate text-center">
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
                        <div class="text-center">
                        <button type="submit" class="btn btn-warning my-3" name="review">Review<i class="fas fa-shopping-cart"></i></button>
                        </div>
                    <?php }
                    ?>	
              </form>

	</div>
   
    
    
<script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>

</html>