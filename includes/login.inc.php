<?php
if (isset($_POST["submit"])) {
    $emcin = $_POST["emcin"];
    $pwd = $_POST["pwd"];
    require_once "dbh.inc.php";
    require_once "function.inc.php";
    if(emptyLoginInput($pwd,$emcin) !==false){
        header("location: ../login.php?error=emptyInput");
        exit();
    }
    loginUser($conn,$emcin,$pwd);
} 
else {
    header("location: ../login.php");
    exit();
}