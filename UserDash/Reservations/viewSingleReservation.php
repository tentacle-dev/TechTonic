<?php
    if(isset($_GET['id'])){
		
		// escape sql chars
        try{
        $id =  $_GET['id'];        
        include('../../database/reservationsDbconfig.php');
        $result = getDataById($id);
        $id = $result['id']; 
        $name = $result['name']; 
        $number = $result['Telephone_Number']; 
        $email = $result['Email_Address']; 
        $date = $result['date']; 
        $purpose = $result['purpose'];
        $status = $result['status'];
        $feedback = $result['feedback'];

        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }       
	}
    if(isset($_POST['approve'])){

        include('../../database/reservationsDbconfig.php');

        $id = $_POST['id'];   
        $feedback = $_POST['feedback'];
        approveReservation($id,$feedback);  
        $result = getDataById($id);
        $id = $result['id']; 
        $name = $result['name']; 
        $number = $result['Telephone_Number']; 
        $email = $result['Email_Address']; 
        $date = $result['date']; 
        $purpose = $result['purpose'];
        $status = $result['status']; 
        $feedback = $result['feedback'];
        }

    
    if(isset($_POST['reject'])){
        try{
        include('../../database/reservationsDbconfig.php');
        $id = $_POST['id'];
        $feedback = $_POST['feedback'];
        rejectReservation($id,$feedback);   
        include('../../database/reservationsDbconfig.php');
        $result = getDataById($id);
        $id = $result['id']; 
        $name = $result['name']; 
        $number = $result['Telephone_Number']; 
        $email = $result['Email_Address']; 
        $date = $result['date']; 
        $purpose = $result['purpose'];
        $status = $result['status'];
        $feedback = $result['feedback'];
        

        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }   
    }       
    
    


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name?></title>
    <link rel="stylesheet" href="../../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">


</head>
<body>    
    <div class="container mt-5">
   
        <div class="row">
            <div class="col">
              <p><?php echo $name?></p>  
              <p><?php echo $number?></p>  
              <p><?php echo $purpose?></p>  
            </div>
            <div class="col">
            <p><?php echo $email?></p>  
            <p><?php echo $date?></p>  
            <p><?php echo $feedback?></p>
            </div>
        </div>
        <h5><?php echo $status;?></h5>

    </div>
</body>
<script src="../../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>
</html>