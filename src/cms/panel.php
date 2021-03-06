<?php
session_start();
$SOURCE_FOLDER_IMG = "../img/";
if (!isset($_SESSION['login']) && !isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
require "../phpClass/News.php";
require '../phpClass/connect_data.php';

$news = new News($pdo);
if (isset($_POST['add']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['article']) && isset($_FILES['img'])) {
    $imgName = $news->addImg($_FILES['img'], $SOURCE_FOLDER_IMG);
    if ($imgName !== false) {
        $news->addNews($_POST['title'], $_POST['description'], $_POST['article'], $imgName);
    }

}

if (isset($_POST['id']) && isset($_POST['remove']) && isset($_POST['imgName'])) {
    $imgName = $news->removeNews($_POST['id'], $_POST['imgName'],$SOURCE_FOLDER_IMG);
    header("Location: panel.php");
}
if (isset($_POST['edit']) && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['article']) && isset($_POST['imgName'])) {
    $imgPath = $_POST['imgName'];
    if (isset($_FILES['img']['size'])) {
        $news->removeImg($imgPath, $SOURCE_FOLDER_IMG);
        $imgName = $news->addImg($_FILES['img'], $SOURCE_FOLDER_IMG);
        if ($imgName !== false) {
            $news->removeImg($imgPath, $SOURCE_FOLDER_IMG);
            $imgPath = $imgName;
        }
    }
     $news->editNews($_POST['id'], $_POST['title'], $_POST['description'], $_POST['article'], $imgPath);
    //exit;
    //echo $imgName;exit;
    header("Location: panel.php");
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
        <title>Liskowiak</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/navStyle.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/news.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-dark">
            <a class="navbar-brand" href="panel.php">
                <img class="logo" src="../img/POL_gmina_Lisków_COA.svg" /> </a>
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
        <main class="container">

            <form class='form-group' enctype="multipart/form-data" id='addArticle' action="" method="POST">
                <div class='row'>
                    <input class='form-control col' type='file' accept=".jpg, .jpeg, .png" name='img' />
                    <input class='form-control col' type='text' name='title' placeholder='Tytuł' />
                    <textarea class='form-control col' form='addArticle' name='description' placeholder='Opis'></textarea>
                    <textarea class='form-control col' form='addArticle' name='article' placeholder='Treść artykułu'></textarea>
                    <input class='form-control col' type='submit' name='add' value='Dodaj' />
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $news->getListOfNewsCMS(); ?>
                </div>

            </div>
        </main>
    </body>

    </html>