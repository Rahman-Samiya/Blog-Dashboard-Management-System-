<?php
$host = 'localhost';      
$user = 'root';  
$password = '';
$database = 'dbms_final_project';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
