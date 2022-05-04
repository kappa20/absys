<?php session_start() ?>
<?php if (isset($_SESSION["role_us"])) : ?>
    <?php
    require_once "./includes/function.inc.php";
    require_once "./includes/dbh.inc.php";
    require_once "index_header.php";
    ?>
    <main class="mt-5 pt-3 ">
        <form action="./locale/upload.php"  method="post" enctype="multipart/form-data">

            <div style="
           
            display:grid;
            gap:1rem;
            place-items:center;
            ">
                <p class="bg-warning text-dark mt-2 rounded p-2">les formats autorisés sont :Excel (xls|xlsx)</p>
                <div>
                    <label for="basePlate" class="btn btn-lg btn-block btn-primary">La base plate des stagiaires</label>
                    <input type="file" accept="
                     .xls,.xlsx,
                     application/vnd.ms-excel,
                     application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
                     " class="nocolor hiden" name="basePlate" id="basePlate" value="importer">
                </div>
                <div>
                    <label for="avancement" class="btn btn-lg btn-block btn-primary">Avancement du Programme</label>
                    <input type="file" accept="
                    .xls,.xlsx,
                     application/vnd.ms-excel,
                     application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
                     " class="nocolor hiden" name="avancement" id="avancement">
                </div>
                <div id="btnContainer">
                    <button type="submit" class="btn btn-primary disabled" disable name="submit">Valider</button>

                </div>
                <?php if (isset($_GET["error"])) : ?>
                    <?php if ($_GET["error"] == "wrongType") : ?>
                        <div class="alert alert-danger" role="alert">
                            Veuillez vérifier que les fichiers choisis sont de type excel(xls,xlsx)
                        </div>
                    <?php endif ?>
                <?php endif ?>
                <?php if (isset($_GET["success"])) : ?>

                    <div class="alert alert-success" role="alert">
                        la mise à jour des données a été terminé avec succès
                    </div>

                <?php endif ?>
            </div>

        </form>
    </main>
    <script>
        const inputFiles = document.querySelectorAll("input[type=file]");
        const basePlate = document.getElementById("basePlate");
        const baselabel = document.querySelector("label[for='basePlate']");
        const avantlabel = document.querySelector("label[for='avancement']");
        const subBtn = document.querySelector("button[type='submit']")
        const form = document.querySelector("form")

        const btnContainer = document.getElementById("btnContainer");
        console.log(btnContainer)
        window.loading = false;



        
       


        function disable() {
            $("button[type='submit']").attr("disabled", true);
            $("button[type='submit']").addClass('disabled');

        }

        function enable() {
            $("button[type='submit']").removeAttr("disabled");
            $("button[type='submit']").removeClass('disabled');

        }

        inputFiles.forEach((element) => {
            element.addEventListener("change", fileHandler);
        })
        window.base = 0
        window.avant = 0


        function fileHandler(event) {
            var id = event.target.getAttribute("id");
            if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
                return;
            }

            const name = event.target.files[0].name;
            const lastDot = name.lastIndexOf('.');

            const fileName = name.substring(0, lastDot);
            const ext = name.substring(lastDot + 1);
            if (ext == "xls" || ext == "xlsx") {
                event.target.previousElementSibling.setAttribute("class", "btn btn-lg btn-block btn-success")
                if (id == "basePlate") {
                    window.base = 1;
                } else {
                    window.avant = 1;
                }

            } else {
                if (id == "basePlate") {
                    window.base = 0;
                } else {
                    window.avant = 0;
                }
                event.target.previousElementSibling.setAttribute("class", "btn btn-lg btn-block btn-danger")
            }
            var valid = window.avant + window.base

            if (valid == 2) {
                console.log("this is need to work")
                enable();
            } else {
                disable();
            }
        }
    </script>

<?php endif ?>