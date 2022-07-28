<?php

session_start();
$id = $_SESSION['user_id'];
echo $id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View my reservations</title>
    <link rel="stylesheet" href="../../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">

</head>
<body>
    <?php
       try{

        include_once('../../database/dbconn.php');
        $stmt = $conn->prepare("SELECT * FROM reservation WHERE user_id = $id");
        $stmt->execute();
        
        

        } catch(PDOException $e) {
        echo $e.getMessage();
        return false;
        }
?>
<div class="container">
    <div class="row">
        
    </div>

</div>
<div class="container">
<table class="table table-sm">
<thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Telephone_Number</th>
      <th scope="col">Email Address</th>
      <th scope="col">Purpose</th>
      <th scope="col">Feedback</th>
      <th scope="col">Status</th>

    </tr>
  </thead>
  <tbody>
    <tr class="table-active">
    <?php 
        while($row = $stmt->fetch()){
            $idr =$row['id'];
            $name = $row['name'];
            $tel = $row['Telephone_Number'];
            $email = $row['Email_Address'];
            $purpose = $row['purpose'];
           $feedback = $row['feedback'];
            $status = $row['status'];?>
            <td><?php echo $name?></td>
            <td><?php echo $tel?></td>
            <td><?php echo $email?></td>
            <td><?php echo $purpose?></td>
            <td><?php echo $feedback?></td>

            <td><?php echo $status?></td>
      <td><form action="" method="POST"> 
          <a href="viewSingleReservation.php?id=<?php echo $idr?>">View</a>         
          
          
      </form></td>
      </tr>
      <?php } ?>
    
</table>
</div>



</body>
<script src="../../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>
</html>