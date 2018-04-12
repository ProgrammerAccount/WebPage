<?php
session_start();
if (isset($_GET['grupa'])) {

    $group = "";
    switch ($_GET['grupa']) {
        case "Komisja":
            {
                $group = "Komisja";
                break;
            }

        case "Wladze":
            {
                $group = "Wladze";
                break;
            }

        case "Zarzad":
            {
                $group = "Zarzad";
                break;
            }

    }

    if ($group !== "") {
        include '../phpClass/Kadra.php';
        $kadra = new Kadra($group);
        if (isset($_GET['name']) && isset($_GET['add']) && isset($_GET['role']) && $_SESSION['login'] === true) {
            $kadra->addPlayer($_GET['name'], $_GET['role']);
            header("Location:klub.php?grupa=$group");
            //exit;
        }
        if (isset($_GET['name']) && isset($_GET['remove']) && isset($_GET['role']) && $_SESSION['login'] === true) {
            $kadra->RemovePlayer($_GET['name'], $_GET['role']);
            header("Location:klub.php?grupa=$group");
        }
        if (isset($_GET['name']) && isset($_GET['id']) && isset($_GET['edit']) && isset($_GET['role']) && $_SESSION['login'] === true) {
            $kadra->editPlayer($_GET['id'], $_GET['name'], $_GET['role']);
            header("Location:klub.php?grupa=$group");
        }

        ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Liskowiak Klub</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/navStyle.css">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark">
            <a class="navbar-brand" href="panel.php" ><img class="logo" src="../img/POL_gmina_Lisków_COA.svg"/> </a>
            <button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
                <span class=" navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav" >

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">O Klubie</a>
                            <div class="dropdown-menu" >
                            <a class="dropdown-item dropdown-link" href="klub.php?grupa=Komisja">Komisja Rewizyjna</a>
                            <a class="dropdown-item dropdown-link" href="klub.php?grupa=Wladze">Władze klubu</a>
                            <a class="dropdown-item dropdown-link" href="klub.php?grupa=Zarzad">Zarząd</a>
                        </div>
                    </li>

                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Żaki</a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Zaki">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Zaki">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Zaki">Tabela</a>
                        </div>
                    </li>

                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Orliki</a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Orliki">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Orliki">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Orliki">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Młodziki</a>
                        <div class="dropdown-menu" >
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
                        <div class="dropdown-menu" >
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Seniorzy">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Seniorzy">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Seniorzy">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Pétanque</a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Petanque">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Petanque">Terminarz</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Siatkówka</a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Siatkowka">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Siatkowka">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Siatkowka">Tabela</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php" >Kontakt</a>
                    </li>

                </ul>
            </div>
        </nav>
        <main class="container">
            <div class="row">


                <form  class="form-group" style="width:100%" action="" method="GET">
                    <div class="row">
                        <input class="form-control col" placeholder="Imie i Nazwisko" type="text" name="name" />
                        <input class="form-control col" placeholder="Rola" type="text" name="role" />
                        <input class="form-control col" type="hidden" name="grupa" value=<?php
if (isset($_GET['grupa'])) {
            echo $_GET['grupa'];
        }
        ?> />
                        <input class="col" value="Dodaj" name='add' type="submit" />
                    </div>
                </form>

                <?php

        $table = $kadra->getSquadCMS();
        echo $table;
    }

}
?>




            </div>
        </main>
    </body>
</html>
