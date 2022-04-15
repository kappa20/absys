<?php include_once "header.php" ?>

<?php
     require_once "./includes/function.inc.php";
     require_once "./includes/dbh.inc.php";
if (isset($_POST["ajab"])) {
    $c = count($_POST);
    $startTime = $_POST["start"].":00";
    $endTime = $_POST["end"].":00";
    echo $startTime;
    echo $endTime;

    
    if ($c == 1) {
        echo "<h4>No Absent Students </h4>";
    } else if ($c == 2) {
        echo "<h4>The Absent Student is :</h4>";
        foreach ($_POST as $k => $v) {
            
            if ($k !== "ajab" && $k !=="start" && $k !== "end") {
                echo "$v<br>";
                addAbsence($conn,intval($k),$startTime,$endTime);
            }
        }
        exec('start messagemod.py'); 
               
        
         
    } else if($c > 2) {

        echo "<h4>The Absent Students are :</h4>";
        foreach ($_POST as $k => $v ) {
            if ($k !== "ajab" && $k !=="start" && $k !== "end") {
                echo "$v<br>";


                addAbsence($conn,intval($k),$startTime,$endTime);
                
            }
            
        }
        exec('start messagemod.py');
    }
    
}else if(isset($_POST['ajust'])){
    $c = count($_POST);
    echo $c;
     if ($c == 1) {
        echo "<h4>No Absent Students </h4>";
    } else if ($c == 2) {
        echo "<h4>The Absent Student is :</h4>";
        foreach ($_POST as $k => $v) {
            
            if ($k !== "ajust") {
                echo "$v<br>";
                addjustif($conn,intval($k));
            }
           
        }
    } else {

        echo "<h4>The Absent Students are :</h4>";
        foreach ($_POST as $k => $v ) {
            if ($k !== "ajust") {
                echo "$v<br>";
                addjustif($conn,intval($k));
            }
            
        }
    }
}
?>

<a href="./home.php">Home</a>

<?php include_once "footer.php" ?>