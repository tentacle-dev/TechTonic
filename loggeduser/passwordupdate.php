<?php

include('../database/userDbconfig.php');

if(isset($_POST['password'])){
    $id = $_POST['id'];
    if($_POST['pass'] === $_POST['cpass']){
        $pass = $_POST['pass'];
        $pw = password_hash($pass,PASSWORD_BCRYPT);
        updatePassword($id,$pw);
        echo $id;
        echo $pass;
        echo $pw;

    } else {
        echo"<script>alert('Passwords dont match')</script>";
    }


}
?>