<?php require_once "../includes/dbh.inc.php";

        $sql = "";
        $filiere = $_GET['name'];
        for($i = 1 ; $i < 13 ; $i++){
            $sql .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))- (minute(heure_debut_abs)
             + (hour(heure_debut_abs)*60))) Div 60) as Nombre_heure FROM etat_absence as E, filiere as F, 
             stagiaire as S WHERE S.id_st = E.id_st AND S.code_fil = F.code_fil AND 
             nom_fil = '$filiere' AND MONTH(date_abs) =  $i AND etat_justif = 'J';";
        }


       $data_Je = [];
        mysqli_multi_query($conn, $sql);
        do {
            /* store the result set in PHP */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data_Je,intval($row['Nombre_heure']));
                }
            }else{
                array_push($data_Je,0);
            }
            
        } while (mysqli_next_result($conn));



        $sql2 = "";
        for($i = 1 ; $i < 13 ; $i++){
            $sql2 .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))- (minute(heure_debut_abs)
             + (hour(heure_debut_abs)*60))) Div 60) as Nombre_heure FROM etat_absence as E, filiere as F, 
             stagiaire as S WHERE S.id_st = E.id_st AND S.code_fil = F.code_fil AND 
             nom_fil = '$filiere' AND MONTH(date_abs) =  $i AND etat_justif = 'NJ';";
        }


       $data_No = [];
        mysqli_multi_query($conn, $sql2);
        do {
            /* store the result set in PHP */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data_No,intval($row['Nombre_heure']));
                }
            }else{
                array_push($data_No,0);
            }
            
        } while (mysqli_next_result($conn));


        $data = [$data_Je,$data_No];
   /*      echo '<pre>';
        print_r($data[0]);
        echo '</pre>';
        echo '<pre>';
        print_r($data[1]);
        echo '</pre>'; */
        
        
        header('Content-type: application/json');
        echo json_encode($data);
    ?>
