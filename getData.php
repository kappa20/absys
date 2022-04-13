<?php require_once "./includes/dbh.inc.php";
    if(isset($_GET["id"])){
        $id_st = intval($_GET["id"]);
        $sql = "SELECT SUM(hour(heure_fin_abs - heure_debut_abs)) as month_abs
        FROM etat_absence WHERE id_st = 20 AND etat_justif = 'NJ'
        AND MONTH(date_abs) = 1 ;";
        for($i = 2 ; $i < 13 ; $i++){
            $sql .= "SELECT SUM(hour(heure_fin_abs - heure_debut_abs)) as month_abs
        FROM etat_absence WHERE id_st = 20 AND etat_justif = 'NJ'
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
