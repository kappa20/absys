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
                <span id='drop_cont' style="width: 60%;">
                    <div id="dropText">
                        <span id="dropText_span">Choose your class</span>

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
                                <li class='date_abs' >
                                    <input style='display:none;' id='$nom_fil' class='btnSub' type='radio' name='nomFil' value=$nom_fil>
                                    <label for='$nom_fil'>$nom_fil</label>
                                </li>";
                        }
                        ?>
                    </ul>
                </span>
                <input type="date" name="select_date">
                <button type="submit">Valider</button>
            </div>
        </form>

        <?php
        if (isset($_GET['select_date'])) {
            $date = $_GET['select_date'];
            $nom_fil = $_GET['nomFil'];
            showNews($conn, $date, $nom_fil);
        }
        ?>
        <script>
            const iconContainer = document.getElementById("iconCont");
            const icon = document.getElementById('coco')
            const btnSub = document.querySelectorAll(".btnSub");
            const dropText = document.getElementById("dropText")
            const Text = document.getElementById("dropText_span")
            const list = document.getElementById('listParent');

            btnSub.forEach((e) => {
                e.addEventListener("click", function() {
                    Text.innerText = this.value
                    dropDownToggle();
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
    </main>
<?php endif ?>