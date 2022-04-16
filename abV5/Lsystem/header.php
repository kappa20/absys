<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    nav img{
        width: 90px;
        border-radius: 50%;
        cursor: pointer;
    }
    span img{
        width: 25px;
    }
    .form-login{
        border-radius: 8px;
        background-color: white;
    }
    .signupError{
        color: red;
    }
</style>
<body>
<body>

    <nav class="navbar navbar-light bg-light px-5">

        <?php
            if(isset($_SESSION['nom'])){
                if($_SESSION['role_us'] == 'superviser'){
                    echo '<a href="Home_superviser.php" class="brand"><img src="logo_ofppt.png"></a>';
                }else if($_SESSION['role_us'] == 'teacher'){
                    echo '<a href="Home_Teacher.php" class="brand"><img src="logo_ofppt.png"></a>';
                }}else{
                    echo '<img src="logo_ofppt.png">';} 
        ?>


        <?php
            if(isset($_SESSION['role_us'])){
                echo '
                <form class="form-inline" action="./includes/logout.inc.php" method="get">
                    <button class="btn btn-outline-primary" type="submit" name="logout">Logout</button>
                </form>
                        
            ';}
                    
        ?>
    </nav>


