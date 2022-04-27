<?php require_once "../includes/dbh.inc.php";
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    preg_match_all('/[A-z]+/', $name, $matches);
    if (count($matches[0]) == 0) {
        echo "";
        exit();
    } else if (count($matches[0]) == 1) {
        $x = $matches[0][0];
        $sql = "SELECT nom_st , id_st, prenom_st , heure_absence_st , nom_fil FROM stagiaire as S , filiere as F WHERE
            S.code_fil = F.code_fil AND 
            (nom_st like '$x%' OR prenom_st like '$x%') ;";
    } else if (count($matches[0]) > 1) {
        $x = $matches[0][0];
        $y = $matches[0][1];
        $sql = "SELECT nom_st ,id_st , prenom_st , heure_absence_st , nom_fil FROM stagiaire as S , filiere as F WHERE
            S.code_fil = F.code_fil AND 
            (nom_st like '$x%' AND prenom_st like '$y%') OR 
            (nom_st like '$y%' AND prenom_st like '$x%');";
    }

    $result = mysqli_query($conn, $sql);
    $hint = "<ul>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_st = intval($row["id_st"]);
            $nom = $row["nom_st"];
            $prenom = $row["prenom_st"];
            $fullName = $nom . " " . $prenom;

            $hint .= "<li onclick=\"loadDoc1('./dist/getData.php?id=20')\" >$fullName</li>";
        }
        $hint .= "</ul>";
        echo $hint;
        exit();
    } else {
        echo "No Results , Try Again !!";
        exit();
    }
}
