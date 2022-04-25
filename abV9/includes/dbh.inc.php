<?php

    $servername = "localhost";
    $dbUsername = "root";
    $password = "root";
    $dbname = "absys";
    $dbport = 3306;
    

 $conn = mysqli_connect($servername, $dbUsername, $password, $dbname, $dbport);
 
 if(!$conn){
    die("Conection faild :/ ".mysqli_connect_error());
 }