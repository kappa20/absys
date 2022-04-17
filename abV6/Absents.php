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

    $id_abs_array = [];
    $id_st_array = [];
    echo "<h4>The Absent Students are :</h4>";
    foreach ($_POST as $k => $v) {  
        if ($k !== "ajab" && $k !=="start" && $k !== "end") {
            $id_abs = intval($k);
            $id_st = intval($v);
            array_push($id_abs_array,$id_abs);
            if(!in_array($id_st,$id_st_array)){//add  the id_st to the array if he is not in the array
                array_push($id_st_array,$id_st);
                
            }
            
        }
    }
    addAbsence($conn,$id_abs_array,$startTime,$endTime);
    
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
        foreach ($_POST as $k => $v) {
            
            if ($k !== "ajust") {
                $id_abs = intval($k);
                $id_st = intval($v);
                
                array_push($id_abs_array,$id_abs);
                if(!in_array($id_st,$id_st_array)){//add  the id_st to the array if he is not in the array
                    array_push($id_st_array,$id_st);
                    /* echo $id_st; */
                }
            }
        }
        addjustif($conn,$id_abs_array);
        print_r($id_st_array);
    foreach($id_st_array as $id){
        update_houre($conn,$id);
    }

    }
}
?>
</main>
<?php mysqli_close($conn); ?>
<?php endif ?>