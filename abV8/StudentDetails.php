<?php session_start() ?>
<?php if (isset($_SESSION["role_us"])) : ?>

    <?php require_once "index_header.php";
    require_once "./includes/function.inc.php";
    require_once "./includes/function.inc.php";
    ?>

    <main class="mt-5 pt-3">

        <div class="body-container">


            <section class="chart">
                <canvas id="myChart"></canvas>
            </section>

            <section class="stagiares_info">

            </section>

        </div>

        <script>
            const suggest = document.getElementById("suggestion");

            function loadDoc(url, callback) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        callback(this);
                    }
                }
                xhttp.open("GET", url, true);
                xhttp.send()
            }

            function myFunction(xhttp) {
                suggest.innerHTML = xhttp.responseText;
            }
        </script>


        <script>
            const ctx = document.getElementById('myChart');

            function loadDoc1(url, fname) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var monthData = JSON.parse(this.response);


                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                datasets: [{
                                    label: 'Heures justifiées',
                                    data: monthData[0],
                                    backgroundColor: [
                                        'rgb(78, 216, 36, 0.3)'
                                    ],
                                    borderColor: [
                                        'rgb(78, 216, 36, 1)'
                                    ],
                                    borderWidth: 1
                                }, {
                                    label: 'Heures Non justifiées',
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
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value, index, ticks) {
                                                return value + " h";
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: fname,
                                        font: {
                                            size: 30
                                        }
                                    },
                                    legend: {
                                        labels: {
                                            font: {
                                                size: 20
                                            }
                                        }
                                    }

                                }
                            }
                        });
                    }
                }
                xhttp.open('GET', url, true);
                xhttp.send()
            }
        </script>

        <script>
            function GetInfo(url, id, fname) {
                loadDoc1(url + id, fname)

                loadDoc(`./dist/getTable.php?id=${id}`, myFunction0)


            }
            const container = document.querySelector('.stagiares_info')

            function myFunction0(Data) {
                console.log(Data.responseText)
                var tables = JSON.parse(Data.response);

                var jus = `
            <table class="justified" border="1">`
                var notjust = `<table class="justified" border="1">`


                var headJ = `
            <tr><th class="table_head" colspan=\"4\">Les Absences justifiées</th></tr>
            
                    <tr style="background-color: #16a085;">
                        <th>Date absence</th>
                        <th>heure debut</th>
                        <th>heure fin</th>
                        <th>Nombre de heures</th>
                    </tr>
            `
                var headNJ = `
            <tr><th class="table_head" colspan=\"4\">Les Absences Non justifiées</th></tr>
                    <tr style="background-color: rgb(228, 92, 92);">
                        <th>Date absence</th>
                        <th>heure debut</th>
                        <th>heure fin</th>
                        <th>Nombre de heures</th>
                    </tr>
            `
                // table J
                var body_J = ""
                if (tables['J'].length == 0) {
                    body_J += `
                <tr style="text-align:center;">
                    <th style=\"font-size: 1rem;\">-</th>
                    <th style=\"font-size: 1rem;\">-</th>
                    <th style=\"font-size: 1rem;\">-</th>
                    <th style=\"font-size: 1rem;\">-</th>
                </tr>`
                } else {
                    tables['J'].forEach(e => {

                        var time1 = e.Heure_debut
                        var time2 = e.Heure_fin

                        function getHour(time1, time2) {
                            var arrTime1 = time1.split(":").map(ele => Number(ele))
                            var arrTime2 = time2.split(":").map(ele => Number(ele))
                            var hour1 = arrTime1[0]
                            var min1 = arrTime1[1] / 60 //convert To HOUR 

                            var hour2 = arrTime2[0]
                            var min2 = arrTime2[1] / 60 //convert Tohour
                            var hours = (hour2 - hour1) + (min2 - min1)
                            var minutes = parseInt((hours - parseInt(hours)) * 60)
                            if (minutes === 0) {
                                return `${parseInt(hours)}h`;
                            } else {
                                return `${parseInt(hours)}h ${minutes}min`;
                            }

                        }

                        var result = getHour(time1, time2)
                        body_J += `
                    <tr>
                        <th>${e.Date_abs}</th>
                        <th>${e.Heure_debut}</th>
                        <th>${e.Heure_fin}</th>
                        <th>${result}</th>
                    </tr>
                `
                    })
                }
                body_J += "</table>"

                // table NJ
                var body_NJ = ""
                if (tables['NJ'].length == 0) {
                    body_NJ += `
                <tr style="text-align:center;">
                    <th style=\"font-size: 1rem;\">-</th>
                    <th style=\"font-size: 1rem;\">-</th>
                    <th style=\"font-size: 1rem;\">-</th>
                    <th style=\"font-size: 1rem;\">-</th>
                </tr>`
                } else {
                    tables['NJ'].forEach(e => {

                        var time1 = e.Heure_debut
                        var time2 = e.Heure_fin

                        function getHour(time1, time2) {
                            var arrTime1 = time1.split(":").map(ele => Number(ele))
                            var arrTime2 = time2.split(":").map(ele => Number(ele))
                            var hour1 = arrTime1[0]
                            var min1 = arrTime1[1] / 60 //convert To HOUR 

                            var hour2 = arrTime2[0]
                            var min2 = arrTime2[1] / 60 //convert Tohour
                            var hours = (hour2 - hour1) + (min2 - min1)
                            var minutes = parseInt((hours - parseInt(hours)) * 60)
                            if (minutes === 0) {
                                return `${parseInt(hours)}h`;
                            } else {
                                return `${parseInt(hours)}h ${minutes}min`;
                            }

                        }
                        var result = getHour(time1, time2)

                        body_NJ += `
                    <tr>
                        <th>${e.Date_abs}</th>
                        <th>${e.Heure_debut}</th>
                        <th>${e.Heure_fin}</th>
                        <th>${result}</th>
                    </tr>
                `
                    })
                }
                body_NJ += "</table>"


                container.innerHTML = notjust + headNJ + body_NJ + jus + headJ + body_J


            }
        </script>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $fname = $_GET['fname'];
            echo "
                <script>
                    window.onload = GetInfo('./dist/getData.php?id=','$id','$fname')
                </script>";
        }

        ?>

    </main>
<?php endif ?>