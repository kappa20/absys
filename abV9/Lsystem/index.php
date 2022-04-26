<?php session_start() ?>
<?php if(isset($_SESSION["role_us"])): ?>
  <?php require_once "index_header.php";?>






    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div id="index-container" class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5">Ajoute d'absence</div>
              <div class="card-footer d-flex">
                <a href="ajoute_absence.php" class="link-light">View Details</a> 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark h-100">
              <div class="card-body py-5">Justifier l'absence</div>
              <div class="card-footer d-flex">
                <a href="ajoute_justife.php" class="link-light">View Details</a> 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">Détails de la classe</div>
              <div class="card-footer d-flex">
                <a href="class_details.php" class="link-light">View Details</a> 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5">L'absences d'aujourd'hui</div>
              <div class="card-footer d-flex">
                <a href="absence_day.php" class="link-light">View Details</a> 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
              </div>
              <div class="card-body">
                <div class="table-responsive">


                  <table
                    id="table_stagiaire"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>heure d'absence</th>
                        <th>Filiere</th>
                        <th>Numero de parents</th>
                      </tr>
                    </thead>

                    <?php require_once "./includes/dbh.inc.php";


$sql = "SELECT id_st,nom_st, prenom_st, nom_fil, heure_absence_st, numero_parents FROM
  stagiaire as S , filiere as F  WHERE S.code_fil = F.code_fil";
$result = mysqli_query($conn, $sql);
$hint = "<tbody>";
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $id_st = intval($row["id_st"]);
    $nom = $row["nom_st"];
    $prenom = $row["prenom_st"];
    $heure_absence = $row['heure_absence_st'];
    $filier = $row['nom_fil'];
    $Num = $row['numero_parents'];
    $fname = $prenom . " " . $nom;

    $hint .= "
          <tr class=\"rowtable\" onclick=\"window.location.replace('StudentDetails.php?id=$id_st&fname=$fname')\">
              <td>$nom</td>
              <td>$prenom</td>
              <td>$heure_absence</td>
              <td>$filier</td>
              <td>$Num</td>
          </tr>
          ";
  }
  $hint .= "</tbody>";
  echo $hint;
  exit();
} else {
  echo "No Results , Try Again !!";
  exit();
}
?>

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>



<?php endif ?>