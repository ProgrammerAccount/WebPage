<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/navStyle.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/sklad.css" type="text/css"/>

      
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-fixed-top">
            <a class="navbar-brand" href="index.php" >LOGO </a>
            <button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
                <span class=" navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav" >
                    <li class="nav-item">
                        <a class="nav-link" href="terminarz.php" >O Klubie</a>
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
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Trampkarze</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-link" href="kadra.php?grupa=Trampkarze">Kadra</a>
                            <a class="dropdown-item dropdown-link" href="terminarz.php?grupa=Trampkarze">Terminarz</a>
                            <a class="dropdown-item dropdown-link" href="tabela.php?grupa=Trampkarze">Tabela</a>
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
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <?php
                    if(isset($_GET['grupa']))
                    {
                        
                        $gruop="";
                        if($_GET['grupa']==="Seniorzy")
                            $gruop="SeniorzyKadra";
                        if($_GET['grupa']==="Trampkarze") $gruop="TrampkarzeKadra";
                        
                        if($gruop!=="")
                        {
                            include 'phpClass/Kadra.php';
                            $kadra = new Kadra($gruop);
                            $table = $kadra->getSquadAsTable();
                            echo $table;
                        }
                    
                    }
                    ?>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </main>
    </body>
    
</html>
