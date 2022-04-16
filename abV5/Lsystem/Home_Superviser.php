<?php include_once "header.php" ?>

<?php
        require_once "./includes/dbh.inc.php";
?>
<?php 
        if(isset($_SESSION['nom'])){
            if($_SESSION['role_us'] == 'superviser'){
                $nom = $_SESSION['nom'];
                $role = $_SESSION['role_us'];
                echo "<h3>Hello $role <i class='right'> $nom</i> </h3>";
            }else{
                header("location: Error.php");
                exit();
            }
        }
        else{
            header("location: login.php");
            exit();
        }
    ?>
<form class="btn-abs" style="display: flex;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <button name="ajt" type="submit">Ajouter l'absence</button>
        <button name="jstf" type="submit">Justifier l'absence</button>
        <button name="studentDetails" type="submit">Get Student details</button>
        <button name="classDetails" type="submit">Get Class details</button>
        <button name="news" type="submit">Get news</button>
</form>
<?php
    if(isset($_POST['ajt'])){
        header('location: Home_Teacher.php');
        exit();
    }
    else if(isset($_POST['jstf'])){
        header('location: justife.php');
        exit();
    }
    else if(isset($_POST["studentDetails"])){
        header("location: studentDetails.php");
        exit();
    }
    else if(isset($_POST["classDetails"])){
        header('location: classDetails.php');
        exit();
    }
    else if(isset($_POST["news"])){
        header('location: new.php');
        exit();
    }
?>