<?php include_once "header.php" ?>

<?php require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
?>
<?php 
        if(isset($_SESSION['nom'])){
            $nom = $_SESSION['nom'];
            $prenom = $_SESSION['prenom'];
            $role = $_SESSION['role'];
            if($role == "teacher"){
                header("location: Teacher.php");
                exit();
            }
            echo "<h3>Hello $role <i class='right'>$prenom $nom</i> </h3>";
            echo "<a href='./includes/logout.inc.php'>Log out</a>";
        }
        else{
            echo "<h3>You Need To <a href='login.php'>Log IN</a></h3>"; 
        }
    ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <button name="ajt" type="submit">Ajouter l'absence</button>
        <button name="jstf" type="submit">Justifier l'absence</button>
        <button name="studentDetails" type="submit">Get Student details</button>
        <button name="classDetails" type="submit">Get Class details</button>
</form>
<?php
    if(isset($_POST['ajt'])){
        header('location: Teacher.php');
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
?>

<?php include_once "footer.php" ?>