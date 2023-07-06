<?php
$host = 'localhost';  
$user = 'root';  
$pass = ''; 
$dbname='stockform'; 
$mysqli = new mysqli($host, $user, $pass, $dbname);
//$conn = mysqli_connect($host, $user, $pass);  
if(! $mysqli )  
{  
  die('Could not connect: ' . mysqli_error());  
} 
?>