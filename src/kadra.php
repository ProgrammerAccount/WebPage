<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Liskowiak Kadra</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sklad.css" type="text/css" />


</head>

<body>
    <main>
        <nav class="navbar navbar-expand-lg bg-dark">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="img/POL_gmina_Lisków_COA.svg" /> </a>
            <button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
                <span class=" navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">O Klubie</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="klub.php?grupa=Komisja">Komisja Rewizyjna</a>
                            <a class="dropdown-item dropdown-link" href="klub.php?grupa=Wladze">Władze klubu</a>
                            <a class="dropdown-item dropdown-link" href="klub.php?grupa=Zarzad">Zarząd</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Żaki</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Zaki">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Zaki">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Zaki">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Orliki</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Orliki">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Orliki">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Orliki">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Młodziki</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Mlodziki">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Mlodziki">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Mlodziki">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Trampkarze</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Trampkarze">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Trampkarze">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Trampkarze">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Seniorzy</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Seniorzy">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Seniorzy">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Seniorzy">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Pétanque</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Petanque">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Petanque">Terminarz</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Siatkówka</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Siatkowka">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Siatkowka">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Siatkowka">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php">Kontakt</a>
                    </li>

                </ul>
            </div>
        </nav>
        <div class="content">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <?php
if (isset($_GET['grupa'])) {

    $group = "";
    switch ($_GET['grupa']) {
        case "Seniorzy":
            {
                $group = "Seniorzy";
                break;
            }

        case "Trampkarze":
            {
                $group = "Trampkarze";
                break;
            }

        case "Mlodziki":
            {
                $group = "Mlodziki";
                break;
            }

        case "Orliki":
            {
                $group = "Orliki";
                break;
            }

        case "Zaki":
            {
                $group = "Zaki";
                break;
            }

        case "Petanque":
            {
                $group = "Petanque";
                break;
            }

        case "Siatkowka":
            {
                $group = "Siatkowka";
                break;
            }

    }

    if ($group !== "") {
        require 'phpClass/Kadra.php';
        require 'phpClass/connect_data.php';
        $kadra = new Kadra($group,$pdo);
        if ($group === "Petanque") {
            $table = $kadra->getSquadOfPentaqueAsTable();
        } else {
            $table = $kadra->getSquadAsTable();
        }

        echo $table;
    }

}
?>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <footer>
            <small>&copy; Copyright 2018 
            </small>
        </footer>
    </main>
</body>

</html>