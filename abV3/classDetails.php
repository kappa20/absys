<?php include_once "header.php" ?>
<?php require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
?>
    <?php if(isset($_SESSION["role"])): ?>
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
        <?php 
        if(isset($_POST["searchBy"])){
             $nom = strtoupper(trim($_POST["nom"]));
             $prenom = strtoupper(trim($_POST["prenom"]));
             studentTableSuggest($conn,$nom,$prenom);
        }     
      ?>
    <?php else: ?>
    
        <?php header("location: home.php");
        exit(); ?>
    <?php endif ?>
        
   
    

<?php include_once "footer.php" ?>