<?php
function showStudents($conn, $nom_gp)
{
    $sql = "SELECT id_st ,nom_st , prenom_st , heure_absence_st 
    FROM stagiaire where  nom_gp =  ? order by nom_st;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "statement Problem";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $nom_gp);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}
function prof($conn, $nom_gp)
{
    $sql =  "SELECT nom_tch,T.id_tch FROM teachers as T ,reltf as R 
    where T.id_tch = R.id_tch and R.nom_gp = '$nom_gp';";

    $result =  mysqli_query($conn, $sql);
    return $result;
}
function studentTable($conn, $nomFil)
{
    $resultProfs = prof($conn, $nomFil);
    $resultData = showStudents($conn, $nomFil);
    if (mysqli_num_rows($resultData) > 0) {
        echo "
            <section class='section_justif'>
            <table class='table_ajoute_stagiaire'>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th id='errorCheck'>Absent</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($resultData)) {
            $id = $row["id_st"];
            $nom = $row['nom_st'];
            $prenom = $row['prenom_st'];
            echo "
                <tr>
                    <td>$id</td>
                    <td><label for='$id'>$nom</label></td>
                    <td><label for='$id'>$prenom</label></td>
                    <td><input type='checkbox' id='$id' name='$id' value='$id' class='check'></td>
                </tr>";
        }
        echo "
         </table>


            <div class='table_hour'>
                <label for='start'>Start Hour </label>
                <input type='time' name='start' id='start' list='startList'required>
                <label for='end'>End Hour</label>
                <input type='time' name='end' id='end' list='endList'  required>
                <select name='seance'>
                    <option value='presentiel'>presentiel</option>
                    <option value='distanciel'>distanciel</option>
                </select>
                    <select name='prof'>
                ";
        while ($row = mysqli_fetch_assoc($resultProfs)) {
            $nom_tch = $row['nom_tch'];
            $id_tch = $row['id_tch'];
            echo "
                        <option value='$id_tch'>$nom_tch</option>
                    ";
        }
        echo "
                </select>
            </div>
         
         
         
        <div class='box_btn'>
            <button type='submit' name='ajab'>Valider</button>
        </div>
        </section>     
        ";
    } else {
        echo "
            <section class='section_justif'>
                0 results
            </section>
                ";
    }
    /* <datalist id='endList'>
          
        <option value='10:50'>
        <option value='13:30'> 
        <option value='15:50'>
        <option value='18:30'>   
      </datalist>
      <datalist id='startList'>
      
        <option value='08:30'>
        <option value='11:10'>
        <option value='13:30'>
        <option value='16:10'>  */
}
function addAbsence($conn, $arrays, $startTime, $endTime, $seance, $prof, $id_tch)
{
    
    $sql = "INSERT into etat_absence(id_st,id_tch,date_abs,heure_debut_abs,heure_fin_abs,seance)
    VALUES";
    $len = count($arrays);

    for ($i = 0; $i < $len; $i++) {
        $elem = $arrays[$i];
        if ($i === $len - 1) {
            $sql .= "($elem,'$id_tch',CURRENT_DATE,'$startTime','$endTime','$seance');";
        } else {
            $sql .= "($elem,'$id_tch',CURRENT_DATE,'$startTime','$endTime','$seance'),";
        }
    }
    /* echo $sql; */
    /* die($sql); */
    if (mysqli_query($conn, $sql)) {
        echo "Absence Added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    /* mysqli_close($conn); */
}

function showAbs($conn, $id_st)
{
    $sql = "SELECT S.id_st, nom_st, prenom_st, date_abs,nom_tch,seance, heure_debut_abs, heure_fin_abs, id_abs
    FROM stagiaire AS S, etat_absence AS E , teachers AS T
    where S.id_st = E.id_st AND etat_justif = 'NJ' AND T.id_tch = E.id_tch AND S.id_st = ?
    order by prenom_st,date_abs desc;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "statement Problem";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $id_st);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function justifTable($conn, $id_st)
{

    $resultData = showAbs($conn, $id_st);
    if (mysqli_num_rows($resultData) > 0) {
        echo "
        <section id='section_justif_stagiarie' style='padding:2rem 5%'>
        <form action='Absents.php' method='POST'>
            <table class='table table-striped data-table'>
                <tr>
                    <th>FULL NAME</th>
                    <th>Date d'absence</th>
                    <th>Heur debut d'absence</th>
                    <th>Heur Fin d'absence</th>
                    <th>Prof</th>
                    <th>Seance</th>
                    <th id='errorCheck'>Justifier</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($resultData)) {
            $id_st = $row["id_st"];
            $id = $row["id_abs"];
            $fullname = $row["nom_st"] . " " . $row["prenom_st"];
            $date_ab = $row["date_abs"];
            $h_debut = $row['heure_debut_abs'];
            $h_fin = $row['heure_fin_abs'];
            $nom_tch = $row['nom_tch'];
            $seance = $row['seance'];
            echo "<tr>  
                        <td><label for='$id'>$fullname</label></td>
                        <td><label for='$id'>$date_ab</label></td>
                        <td><label for='$id'>$h_debut</label></td>
                        <td><label for='$id'>$h_fin</label></td>
                        <td><label for='$id'>$nom_tch</label></td>
                        <td><label for='$id'>$seance</label></td>
                        <td><input type='checkbox' id='$id' name='$id' value='$id_st' class='check'></td>
                </tr>";
        }
        echo "
     </table>

     <div class='box_btn'>
        <select class='autre' name='etat'>
            <option selected value='Maladie'>Maladie</option>
            <option value='Permis'>Permis</option>
            <option value='examen'>Examen</option>
            <option value='Autre'>Autre</option>
        </select>
        <input class='input_autre' type='text'>
        <button id='ajustbtn' type='submit' name='ajust' disabled>Valider</button>
    </div>

    </form>
    </section>
     
                ";
    } else {
        echo "<br> 0 results";
    }
}
function addjustif($conn, $array, $motif)
{

    $sql = "UPDATE etat_absence SET etat_justif = 'J', Motif = '$motif'
    WHERE id_abs in (";


    foreach ($array as $id) {

        if (!next($array)) {
            $sql .= $id;
        } else {
            $sql .= $id . ",";
        }
    }
    $sql .= ");";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    /* mysqli_close($conn); */
}
function showNews($conn, $date_debut, $date_fin, $nom_gp)
{

    if ($date_debut == "all") {
        $today   = date("Y-m-d");
        $day = date("j", strtotime($today));
        $month = date("n", strtotime($today));
        $year = date("Y", strtotime($today));
        if ($month < 8) {
            $debut= date("Y-m-d", mktime(0, 0, 0, 8, $day, $year - 1));
        }
        if ($month > 8) {
            $debut = date("Y-m-d", mktime(0, 0, 0, 8, $day, $year));
        }    
    }
    else{
        $debut = $date_debut;
    }
    


    if ($nom_gp == "total") {
        $sql = "SELECT S.id_st , nom_gp , date_abs, nom_tch ,seance, nom_st, prenom_st,heure_debut_abs,heure_fin_abs 
        from teachers as T, etat_absence as E , stagiaire as S
        where T.id_tch = E.id_tch and etat_justif = 'NJ' and E.id_st = S.id_st  and
        (to_days(date_abs) >= to_days('$debut') AND to_days(date_abs) <= to_days('$date_fin')) order by id_st;";
    } else {
        $sql = "SELECT S.id_st , nom_gp , date_abs, nom_tch ,seance, nom_st, prenom_st,heure_debut_abs,heure_fin_abs 
        from teachers as T, etat_absence as E , stagiaire as S
        where T.id_tch = E.id_tch and etat_justif = 'NJ' and E.id_st = S.id_st  and
        (to_days(date_abs) >= to_days('$debut') AND to_days(date_abs) <= to_days('$date_fin')) AND nom_gp ='$nom_gp' order by id_st;";
    }


    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-striped data-table'>
        <tr>";
        if($date_debut == "all"){
            echo "<th colspan='8'>$nom_gp  cette année</th>";
        }
        else{
            echo "<th colspan='8'>$nom_gp  $debut => $date_fin</th>";
            
        }
           
       echo" </tr>
        <tr>
            <th>date</th>  
            <th>Filiere</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Heure debut</th>
            <th>Heure Fin</th>
            <th>Prof</th>
            <th>Seance</th>
        </tr>
        ";
        while ($row = mysqli_fetch_assoc($result)) {
            $date = $row["date_abs"];
            $id = $row['nom_fil'];
            $nom = $row['nom_st'];
            $prenom = $row['prenom_st'];
            $debut = $row['heure_debut_abs'];
            $fin = $row['heure_fin_abs'];
            $prof = $row['nom_tch'];
            $seance = $row['seance'];

            echo "
                
                    <tr>
                    <th>$date</th>
                    <th>$id</th>
                        <th>$nom</th>
                        <th>$prenom</th>
                        <th>$debut</th>
                        <th>$fin</th>
                        <th>$prof</th>
                        <th>$seance</th>
                    </tr>
            ";
        }
        echo "</table>";
    } else {
        echo "No Absence Today";
    }
}
function update_houre($conn, $id)
{




    $sql = "UPDATE  stagiaire set heure_absence_st = (select SUM(timestampdiff(hour,heure_debut_abs,heure_fin_abs)) 
        FROM etat_absence WHERE id_st = '$id') where id_st = '$id';";


    mysqli_query($conn, $sql);

    /*  mysqli_close($conn); */
}
function stTable($conn, $nom_gp)
{
    $resultData = showStudents($conn, $nom_gp);
    if (mysqli_num_rows($resultData) > 0) {
        echo "
            <section id='section_justif_stagiarie' style='padding:0 5%'>
            <table class='table table-striped data-table'>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prenom</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($resultData)) {
            $id = $row["id_st"];
            $nom = $row['nom_st'];
            $prenom = $row['prenom_st'];
            echo "
                <tr class='str_js' onclick=\"loadDoc('./dist/newtable.php?id=$id',myFunction)\">
                    <td>$id</td>
                    <td><label class='str_js' for='$id'>$nom</label></td>
                    <td><label class='str_js' for='$id'>$prenom</label></td>
                </tr>";
        }
        echo "</table></section>";
    } else {
        echo "
            <section class='section_justif'>
                0 results
            </section>
                ";
    }
}
function showFiliere($conn)
{
    $sql = "SELECT nom_fil FROM filiere;";

    $result = mysqli_query($conn, $sql);

    return $result;
}
