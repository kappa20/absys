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
    body{
        background-image: url('./img/work.jpg');
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 100vh;
    }
    header img{
        width: 100px;
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
        display: flex;
        padding: 2px 1rem;
        background-color: rgb(248, 180, 255);
        color: rgb(151, 33, 33);
    }
</style>
<body>

    <header class="d-flex justify-content-center">
        <img src="./img/logo_ofppt.png">
    </header>