<?php include_once "header.php" ?>
<?php require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
?>
<?php 
        if(isset($_SESSION['role_us'])){
            $nom = $_SESSION['nom'];
            $role = $_SESSION['role_us'];
            echo "<h3>Hello $role <i class='right'> $nom</i> </h3>";
        }
        else{
            header("location: login.php");
            exit();
        }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="nomFil">Choose your class</label>
     <select name="nomFil" id="nomFil">
         <option value="DEV101">DEV101</option>
         <option value="DEV102">DEV102</option>
         <option value="TDI201">TDI201</option>
         <option value="TDI202">TDI202</option>
     </select>
     
     <button type="submit" name="submit">Valider</button>
    </form>
    <form action="Absents.php" method="POST">
        <?php
        
        if(isset($_POST["nomFil"])){
            $nomFil = $_POST["nomFil"];
            echo $nomFil;
            studentTable($conn, $nomFil);
        }
        ?>  
    </form>