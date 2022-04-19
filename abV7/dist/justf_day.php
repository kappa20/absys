<?php
    require_once "../includes/dbh.inc.php";
    require_once "../includes/function.inc.php";
?>


    <?php
        addjustif($conn,array($_GET['ida'])); 
        update_houre($conn,$_GET['ids']);
        echo $_GET['ida'];
    ?>
    