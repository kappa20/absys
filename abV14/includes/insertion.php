<?php
require_once "dbh.inc.php";
/*               ------------------------------APPENDE EXCEK FILES-----------------------------                 */
if (($open = fopen("../locale/csv/base.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($open, 5000, ",")) !== FALSE) {
        $array[] = $data;
    }
    fclose($open);
}
if (($open = fopen("../locale/csv/avant.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($open, 5000, ",")) !== FALSE) {
        $array_p[] = $data;
    }
    fclose($open);
}

/*                                            --------->>>>---------                                           */


/*--------------------------------------------------------------------------------------------------------------*/
/*            ----------------------------------FILIERES TABLE------------------------------------              */

$filiere = [];
foreach ($array as $e) {
    if (!in_array(
        [
            "code_fil" => $e[4],
            "nom_fil" => $e[5],
        ],
        $filiere
    ) && preg_match('/EL HANK/', $e[2])) {
        array_push($filiere, [
            "code_fil" => $e[4],
            "nom_fil" => $e[5],
        ]);
    }
}
$sql = "INSERT INTO filiere(code_fil,nom_fil) VALUES (?,?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "statement Problem";
    exit();
}
/* stmt failed = >  */
mysqli_stmt_bind_param($stmt, "ss", $code_fil, $nom_fil);
foreach ($filiere as $fil) {
    $code_fil = $fil['code_fil'];
    $nom_fil = $fil['nom_fil'];
    mysqli_stmt_execute($stmt);
}
/*--------------------------------------------------------------------------------------------------------------*/
/*            ----------------------------------GROUPES TABLE------------------------------------              */
$groupe = [];
foreach ($array as $e) {
    if (!in_array(
        [
            "nom_gp" => $e[7],
            "code_fil" => $e[4],
        ],
        $groupe
    ) && preg_match('/EL HANK/', $e[2])) {
        array_push($groupe, [
            "nom_gp" => $e[7],
            "code_fil" => $e[4],
        ]);
    }
}
$sql = "INSERT INTO groupe(nom_gp,code_fil) VALUES (?,?)";
$stmt = mysqli_stmt_init($conn);
/* stmt failed = >  */
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "statement Problem";
    exit();
}
mysqli_stmt_bind_param($stmt, "ss", $nom_gp, $code_fil);
foreach ($groupe as $fil) {
    $nom_gp = $fil['nom_gp'];
    $code_fil = $fil['code_fil'];
    if (preg_match('/\w/', $nom_gp) && preg_match('/\w/', $code_fil)) {
        mysqli_stmt_execute($stmt);
    }
}
/* --------------------------------------------------------------------------------------------------------------*/
/*             ----------------------------------STAGIAIRES TABLE------------------------------------           */
$sql = "INSERT INTO stagiaire(id_st,nom_st,prenom_st,nom_gp,numero_parents) VALUES (?,?,?,?,?)";
$stagiaire = [];
$mtr = [];
foreach ($array as $e) {
    if (!in_array($e[9], $mtr) && preg_match('/EL HANK/', $e[2]) && preg_match('/oui/', strtolower($e[10]))) {
        array_push($stagiaire, [
            "Matricule" => $e[9],
            "Nom" => $e[15],
            "Prenom" => $e[16],
            "Groupe" => $e[7],
            "Numero_parents" => $e[22],
        ]);
        array_push($mtr, $e[9]);
    }
}
$stmt = mysqli_stmt_init($conn);
/* stmt failed = >  */
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "statement Problem";
    exit();
}
mysqli_stmt_bind_param($stmt, "sssss", $Mat, $Nom, $Prenom, $nom_gp, $Num);
ini_set('max_execution_time', 0);
foreach ($stagiaire as $st) {
    $Mat = $st['Matricule'];
    $Nom = $st['Nom'];
    $Prenom = $st['Prenom'];
    $nom_gp = $st['Groupe'];
    $Num = $st['Numero_parents'];

    if (preg_match('/\w/', $nom_gp)) {
        mysqli_stmt_execute($stmt);
    }
}
/* --------------------------------------------------------------------------------------------------------------*/
/*             ----------------------------------FORMATEURS TABLE------------------------------------           */
$sql = "INSERT INTO teachers(id_tch,nom_tch) VALUES (?,?)";

$Formateur = [];
$id_fm = [];
foreach ($array_p as $e) {
    array_push($Formateur, [
        "id_tch" => $e[19],
        "nom_tch" => $e[20],
    ]);
}
$stmt = mysqli_stmt_init($conn);
/* stmt failed = >  */
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "statement Problem";
    exit();
}
mysqli_stmt_bind_param($stmt, "ss", $id_tch, $nom_tch);
foreach ($Formateur as $fm) {
    $id_tch = $fm['id_tch'];
    $nom_tch = $fm['nom_tch'];
    if ($fm['id_tch'] === "Mle Affecté Présentiel Actif" || in_array($id_tch, $id_fm) || $fm['id_tch'] == "") {
        continue;
    }
    array_push($id_fm, $id_tch);
    mysqli_stmt_execute($stmt);
}
/* --------------------------------------------------------------------------------------------------------------*/
/*             ----------------------------------FORMTEURS/GROUPES------------------------------------           */
$sql = "INSERT INTO reltf(nom_gp,id_tch) VALUES (?,?)";
$relation = [];
$id_rel = [];
foreach ($array_p as $e) {
    array_push($relation, [
        "nom_gp" => $e[8],
        "id_tch" => $e[19],
    ]);
}
$stmt = mysqli_stmt_init($conn);
/* stmt failed = >  */
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "statement Problem";
    exit();
}
mysqli_stmt_bind_param($stmt, "ss", $nom_gp, $id_tch);
foreach ($relation as $rel) {
    $nom_gp = $rel['nom_gp'];
    $id_tch = $rel['id_tch'];
    if ($rel['id_tch'] === "Mle Affecté Présentiel Actif" || in_array([$id_tch, $nom_gp], $id_rel) || $rel['id_tch'] == "") {
        continue;
    }
    array_push($id_rel, [$id_tch, $nom_gp]);
    mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);
/*------------------------------------------------Succecc--------------------------------------------------------*/
echo "<script>alert('Success');</script>";
