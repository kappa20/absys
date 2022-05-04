<?php
    require_once "../includes/dbh.inc.php";

        $nom = $_GET['nom_fil'];
        $sql = "SELECT nom_gp from groupe as g , filiere as F where F.code_fil = G.code_fil and F.code_fil = (select code_fil from filiere where nom_fil = '$nom');";
        
        $result = mysqli_query($conn, $sql);
        $list = [];
        while($row = mysqli_fetch_assoc($result)){
            array_push($list,$row['nom_gp']);
        }
        echo json_encode($list);

?>