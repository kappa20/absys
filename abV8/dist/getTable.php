<?php require_once "../includes/dbh.inc.php";

        $id_st = $_GET['id'];

        $sql = "";

            $sql .= "SELECT etat_justif, nom_st, prenom_st, date_abs, heure_debut_abs, heure_fin_abs from
            etat_absence as E , stagiaire as S where 
            E.id_st = S.id_st AND etat_justif = 'J' AND S.id_st = $id_st ;";
        

            $sql .= "SELECT etat_justif, nom_st, prenom_st, date_abs, heure_debut_abs, heure_fin_abs from
            etat_absence as E , stagiaire as S where 
            E.id_st = S.id_st AND etat_justif = 'NJ' AND S.id_st = $id_st ;";


       $J = [];
       $NJ = [];

        mysqli_multi_query($conn, $sql);
        do {
            /* store the result set in PHP */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {

                    if($row['etat_justif'] == 'J'){
                        array_push($J,[
                            'Etat'=> $row['etat_justif'],
                            'Nom'=> $row['nom_st'],
                            'Prenom'=> $row['prenom_st'],
                            'Date_abs'=> $row['date_abs'],
                            'Heure_debut'=> $row['heure_debut_abs'],
                            'Heure_fin'=> $row['heure_fin_abs']
                        ]);
                    }else if($row['etat_justif'] == 'NJ')
                    {
                        array_push($NJ,[
                            'Etat'=> $row['etat_justif'],
                            'Nom'=> $row['nom_st'],
                            'Prenom'=> $row['prenom_st'],
                            'Date_abs'=> $row['date_abs'],
                            'Heure_debut'=> $row['heure_debut_abs'],
                            'Heure_fin'=> $row['heure_fin_abs']
                        ]);
                    }
    
                }
            }else{
                array_push($data,'Empty');
            }
            
        } while (mysqli_next_result($conn));
         $data = [
             'J' => $J,
             'NJ' => $NJ,
         ];
        
        header('Content-type: application/json');
        echo json_encode($data);
    ?>