
<?php
    require_once "header.php";
    require_once "./includes/dbh.inc.php";
    require_once "./includes/function.inc.php";
?>
<?php if(isset($_SESSION["role_us"])):?>

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

            document.getElementById(`${id}`).innerHTML = `<img src="success.png ">`
        }
    </script>
<?php endif ?></table>