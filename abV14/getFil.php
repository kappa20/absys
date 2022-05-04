<?php
require_once "./getName.php";

$servername = "localhost";
$dbUsername = "root";
$password = "root";
$dbname = "absys";
$dbport = 3306;


$conn = new mysqli($servername, $dbUsername, $password, $dbname, $dbport);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

if (($open = fopen("bps.csv", "r")) !== FALSE) {

    while (($data = fgetcsv($open, 5000, ",")) !== FALSE) {
        $array[] = $data;
    }

    fclose($open);
}
$fillArr = [];
//To display array data

foreach ($array as $e) {
    if (!in_array($e[7], $fillArr) && $e[7] != "." &&  preg_match('/EL HANK/', $e[2])) {
        array_push($fillArr, $e[7]);
    }
}

/* echo "<pre>";
print_r($fillArr);
echo "<pre>"; */
/* -------------------------------------------------------------------------------------- */
$stag=[];
foreach ($array as $e) {
    if(preg_match('/oui/',strtolower($e[10]))){
        array_push($stag,array(
            "nom_st"=>$e[15],
            "prenom_st"=>$e[16],
            "tel_st"=>htmlspecialchars($e[22]),
            "code_fil"=>array_search($e[7],$fillArr)+1
        ));
    }
}


/* echo "<pre>";
print_r($stag);
echo "<pre>"; */

$stmt = $conn->prepare("INSERT INTO filiere(nom_fil) VALUES (?)");
$stmt->bind_param("s", $nom_fil);
foreach($fillArr as $nom_fil){
    $stmt->execute();
}



$stmt = $conn->prepare("INSERT INTO stagiaire(nom_st,prenom_st,code_fil,numero_parents) VALUES (?,?,?,?)");
$stmt->bind_param("ssis", $nom,$prenom,$code,$tel);
foreach($stag as $st){
    $nom = $st["nom_st"];
    $prenom = $st["prenom_st"];
    $code = (int)$st["code_fil"];
    $tel = $st["tel_st"];
    $stmt->execute();
}

$stmt->close();

$conn->close();
/* header('Content-type: application/json');
echo json_encode($fillArr); */
