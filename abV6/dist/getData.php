<?php require_once "./includes/dbh.inc.php";
    if(isset($_GET["id"])){
        $id_st = intval($_GET["id"]);
        $sql = "";
        for($i = 1 ; $i < 13 ; $i++){
            $sql .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))-
            (minute(heure_debut_abs) + (hour(heure_debut_abs)*60))) Div 60) as month_abs
        FROM etat_absence WHERE id_st = 20
        AND MONTH(date_abs) = $i ;";
        }


       $data = [];
        mysqli_multi_query($conn, $sql);
        do {
            /* store the result set in PHP */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data,intval($row['month_abs']));
                }
            }else{
                array_push($data,0);
            }
            
        } while (mysqli_next_result($conn));
        
        header('Content-type: application/json');
        echo json_encode($data);
    }
    ?>