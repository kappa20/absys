<?php session_start() ?>
<?php
    require_once "./includes/function.inc.php";
    require_once "./includes/dbh.inc.php";
    require_once "index_header.php";
?>
<main class="mt-5 pt-3">
    <div class="btns_Trie">
        <input id="btn" type="button" value="Trié Totale"></input>
        <input id="btn" type="button" value="Trié non justifiés"></input>
    </div>
    <section class="class_charts"></section>
    
    <script>
        const btn = document.querySelectorAll('#btn')
        btn.forEach(e => {
            e.onclick = function(){
                loadDoc(`./dist/charts.php?name=${e.value}`)
            }
        })
        window.onload = function(){
            btn[0].click()
        }
    </script>

    <script>
        const section = document.querySelector('.class_charts')
        function loadDoc(url){
            section.innerHTML = "";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
            var c = 1
            Data = JSON.parse(this.response);
            Object.keys(Data).forEach(function(e){
               
                $('section').append(`<h4 id=HFIL>#${c}-${e}</h4><canvas id="${e}"></canvas>`);
                c += 1
                
                var ctx = document.getElementById(`${e}`)
                var classhData = Data[e]
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                        datasets: [{
                            label: 'Heures justifies',
                            data: classhData[0],
                            backgroundColor: [
                                'rgb(78, 216, 36, 0.3)'
                            ],
                            borderColor: [
                                'rgb(78, 216, 36, 1)'
                            ],
                            borderWidth: 1
                        }, {
                            label: 'Heures pas justifies',
                            data: classhData[1],
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
                        },}
                });
                
            })}
            xhttp.open('GET', url, false);
            xhttp.send()
            
        }
    </script>
</main>