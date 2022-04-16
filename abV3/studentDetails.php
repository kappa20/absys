<?php include_once "header.php" ?>
<?php require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
?>
    <?php if(isset($_SESSION["role"])): ?>
        <input type="text" placeholder="FullName ..." onkeyup='loadDoc(`getHint.php?name=${this.value}`,myFunction)'>
    Suggestion :<p id="suggestion"></p>
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
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('myChart');

        function loadDoc1(url){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(xhttp.readyState == 4 && xhttp.status == 200){
                    var monthData = JSON.parse(this.response);
                    const myChart = new Chart(ctx, {
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
        /* document.onload = loadDoc1("getData.php?id=20") */
       
        </script>
    <?php else: ?>
    
        <?php header("location: home.php");
        exit(); ?>
    <?php endif ?>
        
   
    

<?php include_once "footer.php" ?>