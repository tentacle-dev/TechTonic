<?php

//include('database/dbconn.php');
//$stmt = $conn->prepare("SELECT CURDATE() + INTERVAL 3 DAY");
//$stmt->execute();
//print_r($stmt->fetch());

//session_start();
//echo $_SESSION['user_id'];
//$pw = 'srtAdmin@123';
$pw = 'Specs@123';
ECHO password_hash($pw,PASSWORD_BCRYPT);

//if(isset($_POST['submit'])){
    //$date = $_POST['date'];
    //$val = date('Y-m-d');
    //if($date < $val){
     //   echo "erro";
    //} else {
    //    echo " futire";
   // }
//}
///include('templates/cartcount.php');
//echo $count;

    


//$res = password_hash($pw,PASSWORD_BCRYPT);

//echo $res;
//unset($_SESSION['cart']);
//print_r($_SESSION['wishlist']);
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="datetime-local" name="date"/>
        <button type="submit" name="submit"></button>
    </form>
<?php

?>
</body>
</html> -->