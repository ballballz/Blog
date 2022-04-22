<?php

$server="localhost";
$username="root";
$password="";
$dbname="blog_project";

try{
    $dbconnect = new PDO("mysql:host=$server;dbname=$dbname;",$username,$password);
    $dbconnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Error" . $e->getMessage();
}
?>