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
            <?php $today   = date("Y-m-d");
                $yesterday = date("Y-m-d", strtotime($today . 'yesterday'));
                $currentW= date("Y-m-d", strtotime($today . 'last monday'));
                $lastW = date("Y-m-d", strtotime($today . 'last week'));
                $lastM = date("Y-m-d", strtotime($today . 'last month'));
                $last3M = date("Y-m-d", strtotime($today . '-3 months'));
                $day = date("j", strtotime($today));
                $month = date("n", strtotime($today));
                $year = date("Y", strtotime($today));
                if($month < 8 ){
                    $lastaug = date("Y-m-d", mktime(0,0,0,8,$day,$year - 1));
                }
                if($month > 8 ){
                    $lastaug = date("Y-m-d", mktime(0,0,0,8,$day,$year));
                }
                
               
                      
                ?>
                <select name="duration" id="dur">
                    <option value="nodur" readonly>Durée</option>
                    
                    <?php if($day != "1"): ?>
                        <option value="<?php echo $yesterday; ?>">Hier</option>
                        <option value="<?php echo $currentW; ?>">Cette Semaine</option>
                    <?php endif; ?>
                   
                    <option value="<?php echo $lastW; ?>">La Semaine Derniere</option>
                    <option value="<?php echo $lastM; ?>">Le Dernier Mois</option>
                    <option value="<?php echo $last3M; ?>">Les Derniers 3 Mois</option>
                    <option value="autre">Autre</option>
                </select>
                <div  id="deuxdates" style="display:none;place-items:center">
                    <input type="date" name="date_debut" max="<?php echo $today;?>" value="<?php echo $lastaug ?>"  >
                    <span class='bi bi-arrow-down'></span>
                    <input type="date" name="date_fin" max="<?php echo $today; ?>" value="<?php echo $today ?>">
                </div>
            <button type="submit" name="sub" value="submit" >Valider</button>
        </form>

        <?php
        if (isset($_GET['sub'])) {
            $duration = $_GET["duration"];
            $date_debut = $_GET["date_debut"];
            $date_fin = $_GET["date_fin"];
           
                if( $duration == "nodur"){
                    
                    showNews($conn,"all",$date_fin,$nom_gp);
                }
                else if($duration == "autre"){
                    showNews($conn,$date_debut,$date_fin,$nom_gp);
                }
                else{
                    showNews($conn,$duration,$date_fin,$nom_gp);
                }

              /*   echo $day;
                echo "<pre>";
                print_r($_GET);
                echo "<pre>"; */
            
        }
        ?>
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
    </main>
<?php endif ?>