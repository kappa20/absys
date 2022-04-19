
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.table_ajoute_stagiaire {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.table_ajoute_stagiaire td, .table_ajoute_stagiaire th {
    text-align: center;
    padding: 8px;
}

.table_ajoute_stagiaire td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.table_ajoute_stagiaire th {
    color: #ffffff;
    background: #4FC3A1;
}


.table_ajoute_stagiaire th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.table_ajoute_stagiaire tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

/* @media (max-width: 767px) {

} */
.btn_select{
  width: 100%;
}
.table_hour{
  padding: 1rem;
  font-weight: 500;
}
.box_btn{
  padding: 1rem;
}
.box_btn button{
  width: 6rem;
  height: 2rem;
  background: none;
}
.select_fil{
  width: 10rem;
  height: 2rem;
  padding-left: 10px;
}
section {
  font: 13px/1.5 "Roboto", sans-serif;
  padding: 50px;
}

/* INPUT SELECT OPTION */
.centerCont {

display: grid;
place-items: center;
padding: 20px 0 30px 0;
}

#drop_cont {
position: relative;
flex-direction: row;
box-shadow: 0 0 10px 0px rgba(43, 111, 246, 0.2);
width: 90%;
}
#dropText{
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0.5rem 1.5rem;
  cursor: pointer;
}

#iconCont {
cursor: pointer;
}
.goUpIcon {
-webkit-animation: iconGoUp 250ms ease-in forwards;
    animation: iconGoUp 250ms ease-in forwards;
}

.goDownIcon {
-webkit-animation: iconGoDown 250ms ease-in forwards;
    animation: iconGoDown 250ms ease-in forwards;
}

@-webkit-keyframes iconGoUp {
0% {
-webkit-transform: rotate(0deg);
      transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(180deg);
      transform: rotate(180deg);
}
}

@keyframes iconGoUp {
0% {
-webkit-transform: rotate(0deg);
      transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(180deg);
      transform: rotate(180deg);
}
}

@-webkit-keyframes iconGoDown {
0% {
-webkit-transform: rotate(180deg);
      transform: rotate(180deg);
}
100% {
-webkit-transform: rotate(0deg);
      transform: rotate(0deg);
}
}

@keyframes iconGoDown {
0% {
-webkit-transform: rotate(180deg);
      transform: rotate(180deg);
}
100% {
-webkit-transform: rotate(0deg);
      transform: rotate(0deg);
}
}
#listParent {
list-style-type: none;
list-style: none;
width: 100%;
position: absolute;
left: 0;
top: 2.6rem;
padding: 0;
overflow: hidden;
box-shadow: 0 0 10px 0px rgba(43, 111, 246, 0.2);
border-radius: 5px;
}

#listParent>li {
list-style-type: none;
list-style: none;
transition: all .2s ease-in;
height: 50px;
}

#listParent>li>button:hover {

background-color: #49e2bb;
}

#listParent>li>button {
height: 100%;
width: 100%;
background-color: white;
border: none;
}

.show {
display: block;
}

.hide {
max-height: 0px;
}
.section_justif{
  padding: 0 2rem;
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
 