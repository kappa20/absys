<?php


 require_once "../includes/dbh.inc.php";

$sql = "";
$groupe = $_GET['name'];
for ($i = 1; $i < 13; $i++) {
    $sql .= "SELECT SUM(timestampdiff(hour,heure_debut_abs,heure_fin_abs)) as Nombre_heure FROM etat_absence as E, 
    stagiaire as S WHERE S.id_st = E.id_st AND 
    nom_gp = '$groupe' AND MONTH(date_abs) =  $i AND etat_justif = 'J';";
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
    $sql2 .= "SELECT SUM(timestampdiff(hour,heure_debut_abs,heure_fin_abs)) as Nombre_heure FROM etat_absence as E, 
    stagiaire as S WHERE S.id_st = E.id_st AND 
    nom_gp = '$groupe' AND MONTH(date_abs) =  $i AND etat_justif = 'NJ';";
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

$sql3 = "SELECT S.id_st,S.nom_st,S.prenom_st,SUM(timestampdiff(hour,heure_debut_abs,heure_fin_abs)) AS hours from etat_absence as E,
stagiaire as S where nom_gp = '$groupe'and etat_justif = 'NJ' and S.id_st = E.id_st group by S.id_st order by hours desc";

$result = mysqli_query($conn,$sql3);
$tab=[];
while($row = mysqli_fetch_assoc($result)){
    array_push($tab,[
        $row["id_st"],
        $row["nom_st"],
        $row["prenom_st"],
        (int)$row["hours"]
    ]);
}

$data = [$data_Je, $data_No, $groupe,$tab];

header('Content-type: application/json');
echo json_encode($data);
