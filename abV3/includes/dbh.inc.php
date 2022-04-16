<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$serverName = "localhost";/* The sever i am connecting to */
$dbusername = "root";/* The user of the database */
$dbpwd = "";/* the password of the user */
$dbname = "absys";
$dbport = 3310;

$conn = mysqli_connect($serverName, $dbusername, $dbpwd, $dbname, $dbport);
if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}

