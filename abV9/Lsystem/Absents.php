<?php session_start() ?>
<?php if(isset($_SESSION["role_us"])): ?>

<?php 
        require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
        require_once "index_header.php";
?>

<main class="mt-5 pt-3">
<?php 

if (isset($_POST["ajab"])) {
    $startTime = $_POST["start"].":00";
    $endTime = $_POST["end"].":00";
    $seance = $_POST['seance'];
    $id_st_array = [];
    $prof = $_POST['prof'];
    echo "<h4>The Absent Students are added successfully</h4>";

    foreach ($_POST as $k => $v) {  
        if ($k !== "ajab" && $k !=="start" && $k !== "end" && $k!== "seance" && $k !=='prof') {
            $id_st = intval($v);
            array_push($id_st_array,$id_st);
        }else if($k =='prof'){
            $id_tch = $v;
        }
    }
    addAbsence($conn,$id_st_array,$startTime,$endTime,$seance,$prof,$id_tch);
    
    foreach($id_st_array as $id){
        update_houre($conn,$id);
    }
 
}
else if(isset($_POST['ajust'])){

    $c = count($_POST);
     if ($c == 1) {
        echo "<h4>No Absent Students </h4>";
    }else {
        echo "<h4>The Absent Studente are :</h4>";
        $id_abs_array = [];
        $id_st_array = [];
        $motif= $_POST['etat'];
        foreach ($_POST as $k => $v) {
            
            if ($k !== "ajust" && $k !== "etat") {
                $id_abs = intval($k);
                $id_st = intval($v);
                
                array_push($id_abs_array,$id_abs);
            }
        }
        addjustif($conn,$id_abs_array,$motif);
        echo "Absence justified successfully";

        /* print_r($motif_array); */
        
/*     foreach($id_st_array as $id){
        
    } */
    }
}
?>
</main>
<?php mysqli_close($conn); ?>
<?php endif ?>