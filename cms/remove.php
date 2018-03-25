<?php
   
    session_start();
    if(isset($_SESSION['login']) && isset($_SESSION['username']))
    {
        if(isset($_GET['name']) && isset($_GET['year']) && isset($_GET['Tshirt']) && isset($_GET['role']) && $_SESSION['login']===TRUE) 
        {
             require_once '../Kadra.php';
            $kadra = new Kadra();
            $kadra->RemovePlayer($_GET['name'], $_GET['role'], $_GET['year'], $_GET['Tshirt']);
            header("Location: sklad.php");
        }
    }
?>