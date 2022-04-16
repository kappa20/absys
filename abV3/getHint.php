<?php require_once "./includes/dbh.inc.php";
    if(isset($_GET["name"])){
        $name = $_GET["name"];
        preg_match_all('/[A-z]+/', $name, $matches);
        if(count($matches[0]) == 0){
            echo "No Results";
            exit();
        }
        else if(count($matches[0]) == 1){
            $x = $matches[0][0];
            $sql = "SELECT nom_st , prenom_st , heure_absence_st , nom_fil FROM stagiaire as S , filiere as F WHERE
            S.code_fil = F.code_fil AND 
            (nom_st like '$x%' OR prenom_st like '$x%') ;";
        }
        else if(count($matches[0]) > 1){
            $x = $matches[0][0];
            $y = $matches[0][1];
            $sql = "SELECT nom_st , prenom_st , heure_absence_st , nom_fil FROM stagiaire as S , filiere as F WHERE
            S.code_fil = F.code_fil AND 
            (nom_st like '$x%' AND prenom_st like '$y%') OR 
            (nom_st like '$y%' AND prenom_st like '$x%');";
        }
       
        $result = mysqli_query($conn,$sql);
        $hint = "<table border='1'><tr>
        <th>Full Name</th>
        <th>Nombre d'heure d'absence</th>
        <th>Filiere</th>
</tr>";
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $nom = $row["nom_st"];
                $prenom = $row["prenom_st"];
                $heure = $row["heure_absence_st"];
                $filiere = $row["nom_fil"];
                $fullName = $nom." ".$prenom;
                    $hint .="<tr   onclick=\"loadDoc1('getData.php?id=20')\">
                    <td>$fullName</td>
                    <td>$heure</td>
                    <td>$filiere</th>
                    </tr>";
                
            }
            $hint .="</table>";
            echo $hint;
            exit();
        }
        else{
            echo "No Results , Try Again !!";
            exit();
        }
        
    }
