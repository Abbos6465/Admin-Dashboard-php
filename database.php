<?php
$serverName="localhost";
$userName="root";
$password="root";
$database="admin_dashboard"; 

try{
    $pdo = new PDO("mysql:host=$serverName;dbname=$database",$userName,$password); 
    $pdo -> setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<h1>Connected successfully</h1>";
}
catch(PDOException $e){
  echo "<h1>Connected failed:</h1>" . $e->getMessage();
}
?>