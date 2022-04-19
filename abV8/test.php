<main class="mt-5 pt-3">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
     <select class="select_fil" name="nomFil" id="nomFil" onchange="this.parentElement.submit() ">
     <option value="" disabled selected>Choose a Class</option>
         <option value="DEV101">DEV101</option>
         <option value="DEV102">DEV102</option>
         <option value="TDI201">TDI201</option>
         <option value="TDI202">TDI202</option>
     </select>
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
    
</main>