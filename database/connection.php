<?php
$servername = 'localhost';
$username = 'root';
$password = '';


//connecting to database
try{
    $conn = new PDO("mysql:host=$servername;dbname=inventory1", $username, $password);
    //set the PDO error node to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(\Exception $e){
    $error_message = $e->getMessage();
}

?>

