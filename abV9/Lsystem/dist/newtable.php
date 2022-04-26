<?php   require_once "../includes/dbh.inc.php";
?>
<?php   require_once "../includes/function.inc.php";
?>
<?php 
    $id = $_GET['id'];
    justifTable($conn,$id); 
?>