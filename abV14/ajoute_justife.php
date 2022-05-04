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
                <span class="drop_cont" id='drop_cont'>
                    <div  id="dropText">
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


                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <ul id='listParent' class="hide">
                        <?php
                        $resultFiliere = showFiliere($conn);
                        while ($row = mysqli_fetch_assoc($resultFiliere)) {
                            $nom_fil = $row['nom_fil'];
                            echo "
                                <li>
                                    <button type='submit' class='btnSub' name='nomFil' value='$nom_fil'>$nom_fil</button>
                                </li>";
                        }
                        ?>
                    </ul>
                    </form>


                </span>
                <span class="drop_cont2" id='drop_cont'>
                    <div id="dropText">
                        <span>Choose Your Group</span>

                        <span id="iconCont">
                            <svg id="dropdownIcon" class="goUpIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </span>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">

                        <ul id='listParent' class="hide">
                            <?php
                                if (isset($_GET["nomFil"])) {
                                    $sql = "SELECT nom_gp from groupe as g , filiere as F where F.code_fil = G.code_fil and F.code_fil = (select code_fil from filiere where nom_fil = '$nomFil');";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $nom_gp = $row['nom_gp'];
                                        echo "
                                            <li>
                                                <button type='submit' class='btnSub' name='nom_gp' value='$nom_gp'>$nom_gp</button>
                                            </li>";
                                    }
                                }
                            ?>
                        </ul>
                    </form>


                </span>

            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                <?php
                if (isset($_GET["nom_gp"])) {
                    $nom_gp = $_GET["nom_gp"];
                    stTable($conn, $nom_gp);
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
            var btn = document.querySelector("#ajustbtn")
            var chec = document.querySelectorAll("input[type='checkbox']")
            window.none = false
            var divs = Array.from(chec)

            divs.forEach((e)=>{
                e.addEventListener("click",function(){
                    btn.disabled = true
                    divs.forEach((i)=>{
                        if(i.checked == true){
                            btn.disabled = false
                        }
                    })
                    
                })
            })
            
        }
    </script>

<script>
        const iconContainer = document.getElementById("iconCont");
        const icon = document.getElementById('coco')
        const btnSub = document.querySelectorAll(".drop_cont .btnSub");
        const dropText = document.querySelector(".drop_cont #dropText")
        const Text = document.querySelector(".drop_cont  #dropText span")
        const list = document.querySelector('.drop_cont  #listParent');
        const dropdownIcon1 = document.querySelector('.drop_cont svg')
            
        btnSub.forEach((e) => {
            e.addEventListener("click", function() {
                console.log(this.value)

                Text.innerText = this.value
                /* loadDoc(`./dist/group.php?nom_fil=${this.value}`) */
            })
        })
        dropText.addEventListener("click", dropDownToggle)

        function dropDownToggle() {
            console.log(dropText)
            console.log(dropdownIcon1)
            if (dropdownIcon1.classList.contains("goUpIcon")) {
                dropdownIcon1.classList.add("goDownIcon")
                dropdownIcon1.classList.remove("goUpIcon")
                list.classList.toggle("hide")
            } else if (dropdownIcon1.classList.contains("goDownIcon")) {
                dropdownIcon1.classList.remove("goDownIcon")
                dropdownIcon1.classList.add("goUpIcon")
                list.classList.toggle("hide")
            }
        }
    </script>
        <script>
        const btnSub1 = document.querySelectorAll(".drop_cont2 .btnSub");
        const dropText1 = document.querySelector(".drop_cont2 #dropText")
        const list1 = document.querySelector('.drop_cont2 #listParent');
        const dropdownIcon2 = document.querySelector('.drop_cont2 svg');

        btnSub1.forEach((e) => {
            e.addEventListener("click", function() {
                dropText.innerText = this.value
            })
        })
        dropText1.addEventListener("click", dropDownToggle)

        function dropDownToggle() {
            console.log(dropdownIcon2)
            if (dropdownIcon2.classList.contains("goUpIcon")) {
                dropdownIcon2.classList.add("goDownIcon")
                dropdownIcon2.classList.remove("goUpIcon")
                list1.classList.toggle("hide")
            } else if (dropdownIcon2.classList.contains("goDownIcon")) {
                dropdownIcon2.classList.remove("goDownIcon")
                dropdownIcon2.classList.add("goUpIcon")
                list1.classList.toggle("hide")
            }
        }
    </script>
    
<?php endif ?>