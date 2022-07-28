<?php

$host = 'localhost';
$db = 'finalprojectdb';
$user = 'root';
$pass = '';


$dsn = "mysql:host=$host;dbname=$db;";

try{
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    throw new PDOException($e->getMessage());
}

?>