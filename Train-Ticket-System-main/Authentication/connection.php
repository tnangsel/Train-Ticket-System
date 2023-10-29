<?php

//Database connection credentials 
$host = "localhost:3306";
$username = "root";
$password = "";
$db_name = "db_tts";
  

$dbConnect = mysqli_connect($host, $username, $password, $db_name);
       
if(mysqli_connect_error()){
    die("Database Connection Failed.");
}

?>   