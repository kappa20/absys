<?php session_start() ?>
<?php if(isset($_SESSION["role_us"])): ?>
<?php 
        require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
        require_once "index_header.php";
?>

<main class="mt-5 pt-3">

    <label for="nomFil">Choose your class</label>
     <select name="nomFil" id="nomFil">
         <option value="DEV101">DEV101</option>
         <option value="DEV102">DEV102</option>
         <option value="TDI201">TDI201</option>
         <option value="TDI202">TDI202</option>
     </select>
     
     <button type="submit" name="submit" onclick="loadDoc1('./dist/class.php')">Valider</button>

     <section>
        <canvas id="myChart"></canvas>
    </section>


    <script>
        const ctx = document.getElementById('myChart');

        function loadDoc1(url){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(xhttp.readyState == 4 && xhttp.status == 200){
                    var monthData = JSON.parse(this.response);


                    var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
                datasets: [{
                    label: 'Hours',
                    data: monthData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
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
    </main>
    <?php endif ?>