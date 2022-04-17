<?php require_once "../includes/dbh.inc.php";

        $sql = "";
        for($i = 1 ; $i < 13 ; $i++){
            $sql .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))- (minute(heure_debut_abs) + (hour(heure_debut_abs)*60))) Div 60) as Nombre_heure FROM etat_absence as E, filiere as F, stagiaire as S WHERE S.id_st = E.id_st AND S.code_fil = F.code_fil AND nom_fil = 'DEV102' AND MONTH(date_abs) =  $i;";
        }


       $data = [];
        mysqli_multi_query($conn, $sql);
        do {
            /* store the result set in PHP */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data,intval($row['Nombre_heure']));
                }
            }else{
                array_push($data,0);
            }
            
        } while (mysqli_next_result($conn));
        
        header('Content-type: application/json');
        echo json_encode($data);
    ?>
