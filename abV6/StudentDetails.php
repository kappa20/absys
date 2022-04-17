<?php
    require_once "header.php";
    require_once "./includes/dbh.inc.php";
    require_once "./includes/function.inc.php";
?>

<?php if(isset($_SESSION["role_us"])): ?>
<div class="body-container">

    <div class="search-sugg">
        <div class="search-containter">
            <input type="text" placeholder="FullName ..." onkeyup='loadDoc(`./dist/getHint.php?name=${this.value}`,myFunction)'>

            <div class="dropdown" id="suggestion">
            <ul>
                <!-- Suggestion -->
            </ul>

        </div>
        </div>
    
    </div>

    <section class="chart">
        <canvas id="myChart"></canvas>
    </section>

    <section class="test">

    </section>

</div>
    <script>
        const suggest = document.getElementById("suggestion");
        function loadDoc(url,myFunction){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(xhttp.readyState == 4 && xhttp.status == 200){
                    myFunction(this);
                }
            }
            xhttp.open("GET",url,true);
            xhttp.send()
        }
        function myFunction(xhttp){
            suggest.innerHTML = xhttp.responseText;
        }
    </script>
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
    <script src="./js/jquery-3.5.1.js"></script>
    <script>
            $(document).ready(function(){
        
                $("body").on('click', () => {
                    $('#suggestion ul').css('display', 'none');
                });

                $('#input').on('click', () =>{
                    $('#suggestion ul').css('display', 'block');
                });

                $('#suggestion ul li').on('click', () =>{
                    $('#suggestion ul').css('display', 'none');
                });

            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="jquery.js"></script>

    <script>
        function GetInfo(url,id){
            loadDoc1(url+id)
            
            loadDoc("./dist/getTable.php",myFunction0)


        }
        const container = document.querySelector('.test')
        function myFunction0(Data){
            var tables = JSON.parse(Data.response);
            
            var jus = `<table border="1"> <tr>Etat J</tr>`
            var notyjust = `<table border="1"> <tr>Etat NYJ</tr>`
            var notjust = `<table border="1"> <tr>Etat NJ</tr>`


            var head = `
                    <tr>
                        <th>Etat</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Date absence</th>
                        <th>heure debut</th>
                        <th>heure fin</th>
                    </tr>
            ` 
            // table J
            var body_J = ""
            if(tables['J'].length == 0){
                body_J += "<tr>message</tr>"
            }else{
                tables['J'].forEach(e => {
                body_J += `
                    <tr>
                        <th>${e.Etat}</th>
                        <th>${e.Nom}</th>
                        <th>${e.Prenom}</th>
                        <th>${e.Date_abs}</th>
                        <th>${e.Heure_debut}</th>
                        <th>${e.Heure_fin}</th>
                    </tr>
                `
                    })
            }body_J += "</table>"


            // table NYJ
            var body_NYJ = ""
            if(tables['NYJ'].length == 0){
                body_NYJ += "<tr>message</tr>"
            }else{
                tables['NYJ'].forEach(e => {
                body_NYJ += `
                    <tr>
                        <th>${e.Etat}</th>
                        <th>${e.Nom}</th>
                        <th>${e.Prenom}</th>
                        <th>${e.Date_abs}</th>
                        <th>${e.Heure_debut}</th>
                        <th>${e.Heure_fin}</th>
                    </tr>
                `
                    })
            }body_NYJ += "</table>"


            // table NJ
            var body_NJ = ""
            if(tables['NJ'].length == 0){
                body_NJ += "<tr>message</tr>"
            }else{
                tables['NJ'].forEach(e => {
                body_NJ += `
                    <tr>
                        <th>${e.Etat}</th>
                        <th>${e.Nom}</th>
                        <th>${e.Prenom}</th>
                        <th>${e.Date_abs}</th>
                        <th>${e.Heure_debut}</th>
                        <th>${e.Heure_fin}</th>
                    </tr>
                `
                    })
            }body_NJ += "</table>"


            container.innerHTML = jus + head + body_J + "<br>" + 
                                notyjust + head + body_NYJ + "<br>" + 
                                notjust + head + body_NJ

        }
    </script>
    
        <?php endif ?>