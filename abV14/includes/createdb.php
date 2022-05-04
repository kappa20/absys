<?php
$servername = "localhost";
$dbUsername = "root";
$password = "root";
$dbname = "";
$dbport = 3306;


$conn = new mysqli($servername, $dbUsername, $password);
$command = file_get_contents("../sql/absenceCreate.sql");
/* $conn->query("CREATE DATABASE absys"); */

if($conn->multi_query($command) != True){
    echo "Error: ".$conn->error;
}
$conn->close();

