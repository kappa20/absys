<?php session_start() ?>
<?php if(isset($_SESSION["role_us"])): ?>
<?php 
        require_once "./includes/function.inc.php";
        require_once "./includes/dbh.inc.php";
        require_once "index_header.php";
?>
<main class="mt-5 pt-3">

    <?php showNews($conn) ?>
    
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
        function success(xhttp){
            var id = Number(xhttp.responseText)
            document.getElementById(`${id}`).innerHTML = `<i class="bi bi-check2-circle"></i>`
        }
    </script>
</main>
<?php endif ?>