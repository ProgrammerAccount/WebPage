<?php
session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['username']))
{
    header("Location: ../index.php");
    exit();
}
if(isset($_GET['grupa']))
{
    
    $group="";
    switch ($_GET['grupa'])
    {
        case "Seniorzy":
        {
            $group="Seniorzy";
            break;
        }
        
        case "Trampkarze":
        {
              
            $group="Trampkarze";
            break;
        }
        
        case "Mlodziki":
        {
            $group="Mlodziki";
            break;
        }
        
        case "Orliki":
        {
            $group="Orliki";
            break;
        }
        
        case "Zaki":
        {
            $group="Zaki";
            break;
        }
        case "Petanque":
        {
            $group="Petanque";
            break;
        }
        
        case "Siatkowka":
        {
            $group="Siatkowka";
            break;
        }
    }
    
    if($group!==""){
    include '../phpClass/Terminarz.php';


    $kadra = new Terminarz($group);
    if(isset($_GET['add']) && isset($_GET['date']) && isset($_GET['club']) && isset($_GET['resultOfGame']) && isset($_GET['opponent'])  && $_SESSION['login']===TRUE)    
    {
        $kadra->addMatch($_GET['club'], $_GET['opponent'],$_GET['resultOfGame'],$_GET['date'] );
        header("Location: terminarz.php?grupa=".$_GET['grupa']);
    }
    if(isset($_GET['remove']) && isset($_GET['date']) && isset($_GET['club']) && isset($_GET['resultOfGame']) && isset($_GET['opponent'])  && $_SESSION['login']===TRUE)    
    {
        $kadra->RemoveMatch($_GET['club'], $_GET['opponent'],$_GET['resultOfGame'],$_GET['date'] );
        header("Location: terminarz.php?grupa=".$_GET['grupa']);
    }
    if(isset($_GET['edit']) && isset($_GET['id']) && isset($_GET['date']) && isset($_GET['club']) && isset($_GET['resultOfGame']) && isset($_GET['opponent'])  && $_SESSION['login']===TRUE)    
    {
        $kadra->editMatch($_GET['id'],$_GET['club'], $_GET['opponent'],$_GET['resultOfGame'],$_GET['date'] );
        header("Location: terminarz.php?grupa=".$_GET['grupa']);
    }
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Liskowiak Terminarz</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
         <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/zebra_datepicker/dist/zebra_datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker/dist/css/bootstrap/zebra_datepicker.min.css">
        <link rel="stylesheet" href="../css/navStyle.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/terminarz.css" type="text/css"/>

      
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

 
                <form  class="form-group " style="width:100%" action="" method="GET">
                    <div class="row">
                        <input type="text"  name="date" class="datepicker" />
                            <script>
                                $(document).ready(function() {

                                    // assuming the controls you want to attach the plugin to
                                    // have the "datepicker" class set
                                    $('input.datepicker').Zebra_DatePicker({
                                        format: 'Y-m-d H:i'
                                    });
                           
                                });
                            </script>
                        <input class="form-control col" placeholder="Drużyna 1" type="text" name="club" /> 
                        <?php
                        if($_GET['grupa']!=="Petanque")
                          echo  '<input class="form-control col" placeholder="Wynik" type="text" name="resultOfGame" />'. 
                         '<input class="form-control col" placeholder="Drużyna 2" type="text" name="opponent" />';  
                        else 
                            echo  '<input style="display:none" class="form-control col" placeholder="Wynik" type="text" name="resultOfGame" />'. 
                            '<input style="display:none" class="form-control col" placeholder="Drużyna 2" type="text" name="opponent" />';  
                        
                        ?>
                        <input class="form-control col" type="hidden" name="grupa" value=<?php
                      
                        if(isset($_GET['grupa']))
                                echo $_GET['grupa'];?> /> 
                        <input class="col" name='add' value="Dodaj" type="submit" /> 
                    </div>
                </form>
                
                <?php
                   
                        if($group==="Petanque")
                            $table = $kadra->getTimetableOfPetanqueCMS();
                        else 
                            $table = $kadra->getTimetableCMS();
                        echo $table;
                        }
                    
                    }
                    ?>


            </div>
        </main>
    </body>

</html>


