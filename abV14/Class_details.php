<?php session_start() ?>
<?php if (isset($_SESSION["role_us"])) : ?>
    <?php
    require_once "./includes/function.inc.php";
    require_once "./includes/dbh.inc.php";
    require_once "index_header.php";
    ?>

    <main class="mt-5 pt-3">

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

                        <ul id='listParent' class="hide">
                            <?php
                                if (isset($_GET["nomFil"])) {
                                    $sql = "SELECT nom_gp from groupe as g , filiere as F where F.code_fil = G.code_fil and F.code_fil = (select code_fil from filiere where nom_fil = '$nomFil');";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $nom_gp = $row['nom_gp'];
                                        echo "
                                            <li>
                                                <button onclick=\"loadDoc1('./dist/class.php?name=$nom_gp')\" class='btnSub' type='submit' name='nom_gp' value=$nom_gp>$nom_gp</button>
                                            </li>";
                                    }
                                }
                            ?>
                        </ul>

                </span>

            </div>





            <section id="chartDiv">

</section>

<section id="hours_st_table">





























        
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



        </section>
        <script>
            function hour_table(data){
                const section_hours_table = document.getElementById("hours_st_table")
                var table = `<table class="justified" border="1" >
                <tr><th class="table_head" colspan=\"4\">Heures d'absence non justifier</th></tr>
                <tr style="background-color:rgba(0, 247, 205, 0.849)"><th>Matricule<th><th>Nome<th><th>Prenom<th><th>Hours<th></tr>
                `
                
                for( e of data){
                    table += `
                    <tr>
                        <th>${e[0]}<th>
                        <th>${e[1]}<th>
                        <th>${e[2]}<th>
                        <th>${e[3]}<th>
                    </tr>`
                }

                table +=  "</table>"
                
                section_hours_table.innerHTML = table
            }
            function Getinfo(name) {
                
                dropText1.innerText = name
                dropDownToggle()
            }
        </script>

        <script>
            function loadDoc1(url) {
                $('#chartDiv').html('<canvas id="myChart"></canvas>');
                const ctx = document.getElementById('myChart');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var monthData = JSON.parse(this.response);

                        hour_table(monthData[3])

                        Getinfo(monthData[2])

                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                datasets: [{
                                    label: 'Heures justifies',
                                    data: monthData[0],
                                    backgroundColor: [
                                        'rgb(78, 216, 36, 0.3)'
                                    ],
                                    borderColor: [
                                        'rgb(78, 216, 36, 1)'
                                    ],
                                    borderWidth: 1
                                }, {
                                    label: 'Heures pas justifies',
                                    data: monthData[1],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)'

                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                }
                xhttp.open("GET", url, true);
                xhttp.send()
            }
        </script>
    </main>
<?php endif ?>