
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>


    <title>OFPPT</title>
    <style>
      .rowtable{
          transition: all .2s ease-in;
          cursor: pointer;
        }
        .rowtable:hover {
          background-color: #f5f5f5;
          transform: scale(1.01);
          transform: translateX(0.5rem);
          box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
      }
      .stagiares_info{
        display: grid;
        place-items: center ;
      }
      .table_head{
        text-align: center;
            text-transform: uppercase;
            letter-spacing:2px;
            word-spacing: 10px;
      }

      .justified {
        width: 75%;
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  
}

.justified thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
}

.justified th,
.justified td {
  padding: 12px 15px;
}

.justified tbody tr {
  border-bottom: 1px solid #dddddd;
}

.justified tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.justified tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.justified tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}

    </style>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >OFPPT</a>
        

      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">

            <li>
            <a href="#" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-person-fill"></i></span>
                <span>
                <span>
                  <?php
                    echo strtoupper($_SESSION['prenom']).' '.strtoupper($_SESSION['nom']);
                  ?>
                </span>
                </span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="index.php" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Home</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>



            <li>
              <a
                class="nav-link px-3 sidebar-link"
                href="ajoute_absence.php"
              >
                <span class="me-2"><i class="bi bi-person-plus"></i></span>
                <span>Ajouter l'absence</span>
    
              </a>

            </li>

            <li>
              <a
                class="nav-link px-3 sidebar-link"
                href="ajoute_justife.php"
              >
                <span class="me-2"><i class="bi bi-check2-circle"></i></span>
                <span>Justifier l'absence</span>
    
              </a>

            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                href="Class_details.php"
              >
                <span class="me-2"><i class="bi bi-info-circle"></i></span>
                <span>Class details</span>
    
              </a>

            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                href="absence_day.php"
              >
                <span class="me-2"><i class="bi bi-clipboard-data"></i></span>
                <span>L'absence d'aujoud'hui</span>
    
              </a>

            </li>






            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Addons
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Charts</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Tables</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              <form class="form-inline" action="./includes/logout.inc.php" method="get">
                  <button class="btn btn-outline-primary" type="submit" name="logout">Logout</button>
                </form>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
 