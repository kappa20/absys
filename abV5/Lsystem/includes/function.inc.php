<?php
    function showStudents($conn, $nomFil)
    {
        $sql = "SELECT id_st ,nom_st , prenom_st , heure_absence_st 
                    FROM stagiaire as S , filiere as F 
                    where F.code_fil = S.code_fil AND F.nom_fil = ? ;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "statement Problem";
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $nomFil);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
    function studentTable($conn, $nomFil)
    {
        $resultData = showStudents($conn, $nomFil);
        if (mysqli_num_rows($resultData) > 0) {
            echo "<table><tr>
                    <th>FULL NAME</th>
                    <th>Absent</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($resultData)) {
                $id = $row["id_st"];
                $fullname = $row["nom_st"] . " " . $row["prenom_st"];
                echo "<tr>
                                <td><label for='$id'>$fullname</label></td>
                                <td><input type='checkbox' id='$id' name='$id' value='$fullname' class='check'></td>
                            </tr>";
            }
            echo "<tr>
                            <th><label for='selectAll'>Select All</label></td>
                            <td><input type='checkbox' id='selectAll'></td>
                        </tr>
             <tr>
                 <th><label for='start'>Start Hour </label></th>
                 <th><label for='end'>End Hour</label></th>
             </tr>
             <tr>
                 <td><input type='time' name='start' id='start' list='startList' required></td>
                 <td><input type='time' name='end' id='end' list='endList' required></td>
             </tr>
             <datalist id='endList'>
          
            <option value='10:50'>
            <option value='13:30'> 
            <option value='15:50'>
            <option value='18:30'>   
          </datalist>
          <datalist id='startList'>
          
            <option value='08:30'>
            <option value='11:10'>
            <option value='13:30'>
            <option value='16:10'>  
          </datalist>
         </table>
         <button type='submit' name='ajab'>Valider</button> 
                    <script src='selectAll.js'></script>
                    ";
        } else {
            echo "0 results";
        }
    }
    function addAbsence($conn, $id, $startTime, $endTime)
{
    $sql = "INSERT into etat_absence (id_st,date_abs,heure_debut_abs,heure_fin_abs,date_limit_justif,etat_justif)
        VALUES 
            (?,CURDATE(),?,?,curdate()+2,'NYJ');";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Problem While Preparing the statement ");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iss", $id, $startTime, $endTime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function showAbs($conn, $nomFil)
{
    $sql = "SELECT S.id_st, nom_st, prenom_st, date_abs, heure_debut_abs, heure_fin_abs, id_abs
    FROM stagiaire AS S, etat_absence AS E, filiere AS F
    where S.id_st = E.id_st AND etat_justif = 'NYJ' AND F.code_fil = S.code_fil AND  nom_fil = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "statement Problem";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $nomFil);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function justifTable($conn, $nomFil)
{

    $resultData = showAbs($conn, $nomFil);
    if (mysqli_num_rows($resultData) > 0) {
        echo "<table>
                <tr>
                    <th>FULL NAME</th>
                    <th>Date d'absence</th>
                    <th>Heur debut d'absence</th>
                    <th>Heur Fin d'absence</th>
                    <th>Justifier</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($resultData)) {
            $id = $row["id_abs"];
            $fullname = $row["nom_st"] . " " . $row["prenom_st"];
            $date_ab = $row["date_abs"];
            $h_debut = $row['heure_debut_abs'];
            $h_fin = $row['heure_fin_abs'];
            echo "<tr>
                        <td><label for='$id'>$fullname</label></td>
                        <td><label for='$id'>$date_ab</label></td>
                        <td><label for='$id'>$h_debut</label></td>
                        <td><label for='$id'>$h_fin</label></td>
                        <td><input type='checkbox' id='$id' name='$id' value='$fullname' class='check'></td>
                </tr>";
        }
        echo "<tr>
                        <th><label for='selectAll'>Select All</label></td>
                        <td><input type='checkbox' id='selectAll'></td>
                    </tr>
     </table>
     <button type='submit' name='ajust'>Valider</button>
                <script src='selectAll.js'></script>
                ";
    } else {
        echo "<br> 0 results";
    }
}
function addjustif($conn, $id)
{
    $sql = "UPDATE etat_absence SET etat_justif = 'J'
    WHERE id_abs = ?;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Problem While Preparing the statement ");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function showNews($conn){
    $sql = "SELECT E.id_abs, nom_st, prenom_st,heure_debut_abs,heure_fin_abs, nom_fil from etat_absence as E , stagiaire as S, filiere as F
    where E.id_st = S.id_st and F.code_fil = S.code_fil and date_abs = CURRENT_DATE  and etat_justif = 'NYJ'";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "<table>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Heure debut</th>
            <th>Heure Fin</th>
            <th>Filiere</th>
            <th>Justifie<th>
        </tr>
        ";
        while($row = mysqli_fetch_assoc($result)){
            $nom = $row['nom_st'];
            $prenom = $row['prenom_st'];
            $debut = $row['heure_debut_abs'];
            $fin = $row['heure_fin_abs'];
            $filiere = $row['nom_fil'];
            $id = $row['id_abs'];

            echo "
                
                    <tr>
                        <th>$nom</th>
                        <th>$prenom</th>
                        <th>$debut</th>
                        <th>$fin</th>
                        <th>$filiere</th>
                        <th  id=\"$id\"><button onclick =\"loadDoc('justf_day.php?id=$id',success)\">Justif</button><th>
                    </tr>
            ";
        }
        echo "</table>";
    }
    
}
    