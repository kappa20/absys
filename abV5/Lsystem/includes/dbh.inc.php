<?php

    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbname = "absys";
    $dbport = 3310;
    

 $conn = mysqli_connect($servername, $dbUsername, $password, $dbname, $dbport);
 
 if(!$conn){
     die("Conection faild :/ ".mysqli_connect_error());
 }