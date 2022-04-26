<?php
if (isset($_POST['login'])) {

    require "dbh.inc.php";

    $username = $_POST['uid'];
    $password = $_POST['pwd'];

    if (empty($username) || empty($password)) {
        header("location: ../login.php?error=emptyFields");
        exit();
    } else {

        $sql = "SELECT * FROM users WHERE nom_us = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=SQLfaild");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                /* $passwordverfy = password_verify($password, $row['password_user']); */
                if ($password != $row['pwd_us']) {
                    header("location: ../login.php?error=wrongPassword");
                    exit();
                } else {
                    session_start();
                    $_SESSION['role_us'] = $row['role_us'];
                    $_SESSION['nom'] = $row['nom_us'];
                    $_SESSION['prenom'] = $row['prenom_us'];
                    header("location: ../index.php");
                    exit();
                }
            } else {
                header("location: ../login.php?error=wrongUsername");
                exit();
            }
        }
    }
} else {
    echo "<h1>Error 404 :/</h1>";
}
