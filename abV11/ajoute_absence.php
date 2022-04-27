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
    <script>
        var myForm = document.querySelector("form[action='Absents.php']");
        var chec = document.querySelectorAll("input[type='checkbox']")
        var errorCheck = document.getElementById("errorCheck");
        var btnajab = document.querySelector("button[name='ajab']")
        /*  console.log(chec) */
        window.nosub = false;
        var divs = Array.from(chec)
        divs.forEach((e)=>{
            e.addEventListener("click",function(element){
                window.nosub = false;
                for(var element of divs){
                    if(element.checked == true){
                        window.nosub = true;
                        break;
                    }
                }
                if(window.nosub){
                    divs.forEach((e)=>{
                        e.style.boxShadow = "0px 0px 7px 0px green";
                        
                    })
                    btnajab.style.boxShadow = "0px 0px 7px 0px green";
                    errorCheck.style.color = "white";
                }
                else{
                    divs.forEach((e)=>{
                        e.style.boxShadow = "0px 0px 7px 0px red";
                        
                    })
                    btnajab.style.boxShadow = "0px 0px 7px 0px red";
                    errorCheck.style.color = "red";
                }
               
            })
        })
        myForm.addEventListener("submit", function(e) {


            for (let i = 0; i < chec.length; i++) {
                if (chec[i].checked == true) {
                    window.nosub = true;
                    break;
                }
            }

            if (window.nosub) {
                this.submit()
            } else {
                errorCheck.style.color = "red";
                for (let i = 0; i < chec.length; i++) {
                    chec[i].style.boxShadow = "0px 0px 5px 0px red";
                }
                btnajab.style.boxShadow = "0px 0px 7px 0px red";
               
                e.preventDefault();
            }

        })
        /* for (let i = 0; i < chec.length; i++) {
                if(che)
            } */
    </script>
<?php endif ?>