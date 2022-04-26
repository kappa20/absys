<?php require_once "../includes/dbh.inc.php";
if (isset($_GET["id"])) {
    $id_st = intval($_GET["id"]);
    $sql = "";
    $studentAbs = 0;
    for ($i = 1; $i < 13; $i++) {
        $sql .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))-
            (minute(heure_debut_abs) + (hour(heure_debut_abs)*60))) Div 60) as month_abs
        FROM etat_absence WHERE id_st = $id_st
        AND MONTH(date_abs) = $i AND etat_justif = 'J';";
    }


    $data_J = [];
    mysqli_multi_query($conn, $sql);
    do {
        /* store the result set in PHP */
        if ($result = mysqli_store_result($conn)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $studentAbs += intval($row['month_abs']);
                array_push($data_J, intval($row['month_abs']));
            }
        } else {
            array_push($data_J, 0);
        }
    } while (mysqli_next_result($conn));

    //

    $sql2 = "";
    for ($i = 1; $i < 13; $i++) {
        $sql2 .= "SELECT SUM(((minute(heure_fin_abs) + (hour(heure_fin_abs)*60))-
            (minute(heure_debut_abs) + (hour(heure_debut_abs)*60))) Div 60) AS month_abs
        FROM etat_absence WHERE id_st = $id_st
        AND MONTH(date_abs) = $i AND etat_justif = 'NJ';";
    }


    $data_NJ = [];
    mysqli_multi_query($conn, $sql2);
    do {

        if ($result = mysqli_store_result($conn)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $studentAbs += intval($row['month_abs']);
                array_push($data_NJ, intval($row['month_abs']));
            }
        } else {
            array_push($data_NJ, 0);
        }
    } while (mysqli_next_result($conn));
    $absTotalFil;
    $sql3 = "SELECT SUM(heure_absence_st) AS sumo,nom_fil FROM stagiaire as S,filiere as F WHERE F.code_fil = S.code_fil AND  S.code_fil = (select code_fil from stagiaire where id_st = $id_st);";
    $result = mysqli_query($conn, $sql3);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $absTotalFil = intval($row["sumo"]);
        $filiere = $row["nom_fil"];
    } else {
        echo "0 results";
    }
    $data = [$data_J, $data_NJ, [
        "filiere" => $filiere,
        "othersAbs" => $absTotalFil - $studentAbs,
        "studentAbs" => $studentAbs
    ]];

    header('Content-type: application/json');
    echo json_encode($data);
}
