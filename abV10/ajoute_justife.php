<?php session_start() ?>
<?php if (isset($_SESSION["role_us"])) : ?>
    <?php
    require_once "./includes/function.inc.php";
    require_once "./includes/dbh.inc.php";
    require_once "index_header.php";
    ?>

    <main id="main_justif" class="mt-5 pt-3">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <div class="centerCont">
                <span id='drop_cont'>
                    <div id="dropText">
                        <?php

                        if (isset($_GET["nomFil"])) {
                            $nomFil = $_GET["nomFil"];
                            echo '<span>' . $nomFil . '</span>';
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
                        <?php
                        $resultFiliere = showFiliere($conn);
                        while ($row = mysqli_fetch_assoc($resultFiliere)) {
                            $nom_fil = $row['nom_fil'];
                            echo "
                                <li>
                                    <button class='btnSub' type='submit' name='nomFil' value=$nom_fil>$nom_fil</button>
                                </li>";
                        }
                        ?>
                    </ul>
                </span>

            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                <?php
                if (isset($_GET["nomFil"])) {
                    $nomFil = $_GET["nomFil"];
                    stTable($conn, $nomFil);
                }
                ?>
            </form>
    </main>
    <script>
        const justif = document.getElementById("main_justif");

        function loadDoc(url, myFunction) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    myFunction(this);
                }
            }
            xhttp.open("GET", url, true);
            xhttp.send()
        }

        function myFunction(xhttp) {
            justif.innerHTML = xhttp.responseText;
            var select = document.querySelector(".autre");
            var input = document.querySelector('.input_autre')
            select.onchange = function() {
                var value = select.value
                if (value == "Autre") {
                    select.removeAttribute("name");
                    input.setAttribute("name", "etat")
                    input.style.display = "block"
                } else {
                    input.removeAttribute("name");
                    select.setAttribute("name", "etat")
                    input.style.display = "none"
                }
            }
        }
    </script>

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