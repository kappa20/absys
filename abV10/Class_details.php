<?php session_start() ?>
<?php if (isset($_SESSION["role_us"])) : ?>
    <?php
    require_once "./includes/function.inc.php";
    require_once "./includes/dbh.inc.php";
    require_once "index_header.php";
    ?>

    <main class="mt-5 pt-3">
        <div class="centerCont">
            <span id='drop_cont'>
                <div id="dropText">
                    <span id="nom_fil">Choose Your Class</span>
                    <span id="iconCont">
                        <svg id="dropdownIcon" class="goUpIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
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
                            <button onclick=\"loadDoc1('./dist/class.php?name=$nom_fil')\" class='btnSub' type='submit' name='nomFil' value=$nom_fil>$nom_fil</button>
                        </li>";
                    }
                    ?>
                </ul>
            </span>
        </div>
        <script>
            const icon = document.getElementById('coco')
            const btnSub = document.querySelectorAll(".btnSub");
            const dropText = document.getElementById("dropText")
            const list = document.getElementById('listParent');
            const iconContainer = document.getElementById("iconCont");

            function Getinfo(name) {
                const nom_fil = document.getElementById('nom_fil')
                nom_fil.innerText = name
                dropDownToggle()
            }

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

        <section id="chartDiv">

        </section>


        <script>
            function loadDoc1(url) {
                $('#chartDiv').html('<canvas id="myChart"></canvas>');
                const ctx = document.getElementById('myChart');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var monthData = JSON.parse(this.response);

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