<?php session_start() ?>
<?php if (isset($_SESSION["role_us"])) : ?>
    <?php
    require_once "./includes/function.inc.php";
    require_once "./includes/dbh.inc.php";
    require_once "index_header.php";
    ?>

    <main class="mt-5 pt-3">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <div class="centerCont">
                <span id='drop_cont'>
                    <div id="dropText">
                        <?php

                            if (isset($_GET["nomFil"])) {
                                $nomFil = $_GET["nomFil"];
                                echo '<span>'.$nomFil.'</span>';
                                } else {
                                echo "<span>Choose Your Class</span>";
                                }
                        ?>
                        <span id="iconCont"><svg id="dropdownIcon" class="goUpIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </span>
                    </div>
                    <ul id='listParent' class="hide">
                        <li>
                            <button class='btnSub' type="submit" name="nomFil" value="DEV102">DEV102</button>
                        </li>
                        <li>
                            <button class='btnSub' type="submit" name="nomFil" value="DEV101">DEV101</button>
                        </li>
                        <li>
                            <button class='btnSub' type="submit" name="nomFil" value="TDI201">TDI201</button>
                        </li>
                        <li>
                            <button class='btnSub' type="submit" name="nomFil" value="TDI201">TDI201</button>
                        </li>
                    </ul>
                </span>

            </div>
        </form>
        <form action="Absents.php" method="POST">
            <?php

            if (isset($_GET["nomFil"])) {
                $nomFil = $_GET["nomFil"];
                studentTable($conn, $nomFil);
            }
            ?>
        </form>
    </main>

    <script>
        const iconContainer = document.getElementById("iconCont");
        const icon = document.getElementById('coco')
        const btnSub = document.querySelectorAll(".btnSub");
        const dropText = document.getElementById("dropText")
        const list = document.getElementById('listParent');
    
        btnSub.forEach((e) => {
            e.addEventListener("click", function() {
                dropText.innerText = this.value
            })
        })
        dropText.addEventListener("click", dropDownToggle)

        function dropDownToggle() {
            if (dropdownIcon.classList.contains("goUpIcon")) {
                dropdownIcon.classList.add("goDownIcon")
                dropdownIcon.classList.remove("goUpIcon")
                list.classList.toggle("hide")
            } else if (dropdownIcon.classList.contains("goDownIcon")) {
                dropdownIcon.classList.remove("goDownIcon")
                dropdownIcon.classList.add("goUpIcon")
                list.classList.toggle("hide")
            }
        }
    </script>
<?php endif ?>