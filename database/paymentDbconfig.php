<?php


/*
function updateTest(){

    include('dbconn.php');                


    $sql = "UPDATE orders SET status='TEST' WHERE user_id='9'";

    // Prepare statement
    $stmt = $conn->prepare($sql);
  
    // execute the query
    $stmt->execute();
    
}

updateTest();*/

/*function updateQuantity(){


        include('dbconn.php');                

    $prod_id = 6;
    $quantity_to_update = 3;
    
}
updateQuantity();
*/
function setOrders($order_id,$prod_id,$user_id,$quantity,$value,$quantity_to_update){
    try{
        
        //echo"Detected".'<br/>';
        include('dbconn.php');                
        $stmt = $conn->prepare("INSERT INTO orderitems(orders_id,product_id,user_id,quantity,value) VALUES (:checkout,:prod_id,:user_id,:quantity,:value)");
        $stmt->bindParam(':checkout',$order_id);
        $stmt->bindParam(':prod_id',$prod_id);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->bindParam(':quantity',$quantity);
        $stmt->bindParam(':value',$value);
        $status = "UNPAID";
        $stmt->execute();


        $stmt2 = $conn->prepare("UPDATE product SET product_quantity=:quantity WHERE product_id=:prod_idd");
        $stmt2->bindParam(":prod_idd",$prod_id);
        $stmt2->bindParam(":quantity",$quantity_to_update);
        $stmt2->execute();

        /*$stmt = $conn->prepare("INSERT INTO orders (checkout_id,prod_id,user_id,quantity,value,pay_token) VALUES (:checkoutid,:prodid,:userid,:quantity,:value,:authToken)");
        $stmt->bindParam(':checkoutid',$checkout_id);
        $stmt->bindParam(':prodid',$prod_id);
        $stmt->bindParam(':userid',$user_id);        
        $stmt->bindParam(':quantity',$quantity);
        $stmt->bindParam(':value',$value);        
        $stmt->bindParam(':status',$status);
        $status = "UNPAID";
        $stmt->bindParam(':token',$pay_token);        
        $stmt->execute();*/

        return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }

}
function setOrdersGUest($order_id,$prod_id,$quantity,$value,$quantity_to_update){
    try{
        
        //echo"Detected".'<br/>';
        include('dbconn.php');                
        $stmt = $conn->prepare("INSERT INTO orderitems(orders_id,product_id,quantity,value) VALUES (:checkout,:prod_id,:quantity,:value)");
        $stmt->bindParam(':checkout',$order_id);
        $stmt->bindParam(':prod_id',$prod_id);
        $stmt->bindParam(':quantity',$quantity);
        $stmt->bindParam(':value',$value);
        $status = "UNPAID";
        $stmt->execute();

        $stmt2 = $conn->prepare("UPDATE product SET product_quantity=:quantity WHERE product_id=:prod_idd");
        $stmt2->bindParam(":prod_idd",$prod_id);
        $stmt2->bindParam(":quantity",$quantity_to_update);
        $stmt2->execute();

        /*$stmt = $conn->prepare("INSERT INTO orders (checkout_id,prod_id,user_id,quantity,value,pay_token) VALUES (:checkoutid,:prodid,:userid,:quantity,:value,:authToken)");
        $stmt->bindParam(':checkoutid',$checkout_id);
        $stmt->bindParam(':prodid',$prod_id);
        $stmt->bindParam(':userid',$user_id);        
        $stmt->bindParam(':quantity',$quantity);
        $stmt->bindParam(':value',$value);        
        $stmt->bindParam(':status',$status);
        $status = "UNPAID";
        $stmt->bindParam(':token',$pay_token);        
        $stmt->execute();*/

        return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }

}
function updCheckout($id){
    try{
        include('dbconn.php');                
        $stmt = $conn->prepare("UPDATE orders SET isPaid = 'PAID' WHERE order_id=:id");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return true;

    }  catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }

}
function setCheckoutGuest($username,$lastname,$total,$dis,$sub,$number,$email,$address){
    try{
        

        include('dbconn.php');   

        $stmt2 = $conn->prepare("INSERT INTO orders (first_Name,last_Name,total,coupon_discount,sub_total,isPaid,isDelivered,shipping_address,mobile_number,email) VALUES (:username,:lname,:total,:dis,:sub,:status,:del,:address,:number,:email)");
        $stmt2->bindParam(':username',$username);
        $stmt2->bindParam(':lname',$lastname);
        $stmt2->bindParam(':total',$total);
        $stmt2->bindParam(':dis',$dis);
        $stmt2->bindParam(':sub',$sub);
        $stmt2->bindParam(':status',$status);
        $stmt2->bindParam(':number',$number);
        $stmt2->bindParam(':email',$email);
        $del = 'Pending';
        $stmt2->bindParam(':address',$address);
        $stmt2->bindParam(':del',$del);

        $status = 'UNPAID';
        $stmt2->bindParam(':status',$status);
        $stmt2->execute();  
        $order_id = $conn->lastInsertId();     


 
        return $order_id;
    
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    
}
function setCheckout($user_id,$username,$lname,$total,$dis,$sub,$number,$email,$address){
    try{
        

        include('dbconn.php');   

        $stmt2 = $conn->prepare("INSERT INTO orders (user_id,first_Name,last_Name,total,coupon_discount,sub_total,isPaid,isDelivered,shipping_address,mobile_number,email) VALUES (:user_id,:username,:lname,:total,:dis,:sub,:status,:del,:address,:number,:email)");
        $stmt2->bindParam(':user_id',$user_id);
        $stmt2->bindParam(':username',$username);
        $stmt2->bindParam(':lname',$lname);
        $stmt2->bindParam(':total',$total);
        $stmt2->bindParam(':dis',$dis);
        $stmt2->bindParam(':sub',$sub);
        $stmt2->bindParam(':status',$status);
        $stmt2->bindParam(':number',$number);
        $stmt2->bindParam(':email',$email);
        $del = 'Pending';
        $stmt2->bindParam(':address',$address);
        $stmt2->bindParam(':del',$del);
        $status = 'UNPAID';
        $stmt2->bindParam(':status',$status);
        $stmt2->execute();  
        $order_id = $conn->lastInsertId();     


 
        return $order_id;
    
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    
}