<?php
require "login_header.php";
?>
<?php
if (isset($_SESSION['nom'])) {
    header("location: index.php");
    exit();
}
?>

<section class="login d-flex justify-content-center p-5">

    <form class="form-login border d-inline-block px-5 pb-5 p-4 " action="./includes/login.inc.php" method="post">

        <h3 class="pb-3">Accéder à la plateforme</h3>
        <!-- username inpute -->

        <label class="h6" for="user">Nom d'utilisateur</label>
        <div class="input-group mb-3 w-20">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><img src="./img/user.svg"></span>
            </div>
            <input id="user" type="text" name="uid" class="form-control" placeholder="Username">
        </div>

        <!-- password inpute -->

        <label class="h6" for="psswd">Mot de passe</label>
        <div class="input-group mb-3 w-20">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><img src="./img/pwd.svg"></span>
            </div>
            <input id="psswd" type="password" name="pwd" class="form-control" placeholder="Password">

            <div class="input-group-prepend">
                <i class="bi bi-eye-fill input-group-text"
                 style="height: 100%;cursor:pointer"
                  id="pwdTog">
                </i>
            </div>


        </div>




        <!-- Login button -->
        <div class="d-grid">

            <!-- Error message -->
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyFields") {
                    echo '<p class="signupError">Fill in all in fields !</p>';
                } else if ($_GET['error'] == "wrongUsername") {
                    echo '<p class="signupError">Wrong username !</p>';
                } else if ($_GET['error'] == "wrongPassword") {
                    echo '<p class="signupError">Wrong password !</p>';
                }
            }
            ?>

            <button class="btn btn-primary w-20" name="login" type="submit">Connexion</button>
        </div>


    </form>
    
</section>
<script src="./js/pwd.js"></script>