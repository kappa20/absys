<?php include_once "header.php" ?>
    <?php 
        if(isset($_SESSION['nom'])){
            $role = $_SESSION['role'];
            if($role == 'teacher'){
                header("location: Teacher.php");
                exit();
            }else if($role == 'superviser'){
                header("location: Super.php");
                exit();
            }
        }else{
            echo "<h3>You Need To <a href='login.php'>Log IN</a></h3>"; 
        }
        
    ?>
    

<?php include_once "footer.php" ?>