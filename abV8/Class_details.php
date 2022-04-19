<?php session_start() ?>
<?php if(isset($_SESSION["role_us"])): ?>
<?php 
        require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
        require_once "index_header.php";
?>

<main class="mt-5 pt-3">

    <label for="nomFil">Choose your class</label>
     <select name="nomFil" id="nomFil" onchange="loadDoc1(`./dist/class.php?name=${this.value}`)">
        <option value="DEV101">DEV101</option>
        <option value="DEV102">DEV102</option>
        <option value="TDI201">TDI201</option>
        <option value="TDI202">TDI202</option>
     </select>

     <section id="chartDiv">
         
    </section>


    <script>

        function loadDoc1(url){

            $('#chartDiv').html('<canvas id="myChart"></canvas>');
            const ctx = document.getElementById('myChart');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(xhttp.readyState == 4 && xhttp.status == 200){
                    var monthData = JSON.parse(this.response);


                    var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
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
                },{
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
            xhttp.open("GET",url,true);
            xhttp.send()
        }
       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = loadDoc1("./dist/class.php?name=DEV101")
    </script>
    </main>
    <?php endif ?>