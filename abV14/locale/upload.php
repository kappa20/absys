<?php

if (isset($_POST["submit"])) {
    /* if (empty($_POST["basePlate"]) || empty($_POST["avancement"])) {
        header("Location: ../settings.php?error=empty");
        exit();
    } */
    $command = "cd oldExcel && erase *.xl*";
    $output = shell_exec($command);
    sleep(1);
    $command = "cd newExcel && move *.xl* ../oldExcel";
    $output = shell_exec($command);
    sleep(1);
    $command = "cd csv && erase *.csv";
    $output = shell_exec($command);
    sleep(1);

    $dire = dirname(__FILE__); //the place where i want to upload the file to 
    $bpsFile = $_FILES["basePlate"];


    $bpsName = $bpsFile["name"];
    $bpsTmp = $bpsFile["tmp_name"];
    $bpsType = $bpsFile["type"];
    $bpsExt = pathinfo($bpsName, PATHINFO_EXTENSION);
    $to = $dire . "\\newExcel\base." . $bpsExt;

    if ($bpsExt == "xls" || $bpsExt == "xlsx") {
        echo move_uploaded_file($bpsTmp, $to);
    } else {
        header("Location: ../settings.php?error=wrongType");
        exit();
    }

    $avantFile = $_FILES["avancement"];
    $avantName = $avantFile["name"];
    $avantTmp = $avantFile["tmp_name"];
    $avantType = $avantFile["type"];
    $avantExt = pathinfo($avantName, PATHINFO_EXTENSION);
    $to = $dire . "\\newExcel\avant." . $avantExt;
    if ($avantExt == "xls" || $avantExt == "xlsx") {
        echo move_uploaded_file($avantTmp, $to);
    } else {
        header("Location: ../settings.php?error=wrongType");
        exit();
    }
    require_once "./convert.php";
    header("location: ../includes/createInsert.php");
} else {
    header("Location: ../settings.php");
    exit();
}
