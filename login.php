<?php include_once "header.php" ?>

    <form action="./includes/login.inc.php" method="Post">
        <input type="text"  name="emcin" placeholder="Email/CIN">
        <input type="password" name="pwd" placeholder="Enter Password">
        <button type="submit" name="submit">LOG IN</button>
        <?php
        
        if(isset($_GET["error"])){
            $error = $_GET["error"];
            if($error === "pwdError"){
                echo "<p class='error'>Mot de passe incorrecte</p>";
            }
            else if($error === "idError"){
                echo "<p class='error'>Email ou cin Introuvable</p>";
            }
        }
        ?>
    </form>

<?php include_once "footer.php" ?>
    