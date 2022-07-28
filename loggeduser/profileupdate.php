<?php

include('../database/userDbconfig.php');

if(isset($_POST['profile'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $mobile =$_POST['number'];
    $add = $_POST['address'];
    $upd = $_POST['upd'];
    $result = updateProfile($id,$name,$lname,$upd,$mobile,$add);

}
?>