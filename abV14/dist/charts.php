<?php
     require_once "../includes/dbh.inc.php";
    //Trie par nombres total d'heures
    $sqlT = "SELECT nom_fil ,sum(hour(TIMEDIFF(heure_fin_abs,heure_debut_abs))) as heures from filiere as F , etat_absence as E , stagiaire as S
    where S.code_fil = F.code_fil and E.id_st = S.id_st group by nom_fil order by heures desc;";

    //Trie par l'etat justife
    $sqlE = "SELECT nom_fil ,sum(hour(TIMEDIFF(heure_fin_abs,heure_debut_abs))) as heures from filiere as F , etat_absence as E , stagiaire as S
    where S.code_fil = F.code_fil and E.id_st = S.id_st and etat_justif = 'NJ'  group by nom_fil order by heures desc;";

    if($_GET['name']=="Trié Totale"){
        $reslt_fil = mysqli_query($conn,$sqlT);
        $filieres = [];
    }
    if($_GET['name']=="Trié non justifiés"){
        $reslt_fil = mysqli_query($conn,$sqlE);
        $filieres = [];
    }
    

    while($row = mysqli_fetch_assoc($reslt_fil)){
        array_push($filieres,$row['nom_fil']);
    }

    $data = [];
    foreach( $filieres as $e){
        $sql = "";
        for ($i = 1; $i < 13; $i++) {
            $sql .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))- (minute(heure_debut_abs)
                     + (hour(heure_debut_abs)*60))) Div 60) as Nombre_heure FROM etat_absence as E, filiere as F, 
                     stagiaire as S WHERE S.id_st = E.id_st AND S.code_fil = F.code_fil AND 
                     nom_fil = '$e' AND MONTH(date_abs) =  $i AND etat_justif = 'J';";
        }
        
        
        $data_Je = [];
        mysqli_multi_query($conn, $sql);
        do {
            /* store the result set in PHP */
            if($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data_Je, intval($row['Nombre_heure']));
                }
            } else {
                array_push($data_Je, 0);
            }
        } while (mysqli_next_result($conn));
        
        
        
        $sql2 = "";
        for ($i = 1; $i < 13; $i++) {
            $sql2 .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))- (minute(heure_debut_abs)
                     + (hour(heure_debut_abs)*60))) Div 60) as Nombre_heure FROM etat_absence as E, filiere as F, 
                     stagiaire as S WHERE S.id_st = E.id_st AND S.code_fil = F.code_fil AND 
                     nom_fil = '$e' AND MONTH(date_abs) =  $i AND etat_justif = 'NJ';";
        }
        
        
        $data_No = [];
        mysqli_multi_query($conn, $sql2);
        do {
            /* store the result set in PHP */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data_No, intval($row['Nombre_heure']));
                }
            } else {
                array_push($data_No, 0);
            }
        } while (mysqli_next_result($conn));

        $fil = [$data_Je, $data_No];
        $data += [
            $e => $fil
        ];
    }

    header('Content-type: application/json');
    echo json_encode($data);
