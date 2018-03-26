<?php
session_start();
if(isset($_SESSION['login']) && isset($_SESSION['username']))
{
    if(isset($_GET['name']) && isset($_GET['role']) && $_SESSION['login']===TRUE) 
    {
        require_once '../phpClass/Kadra.php';
        $kadra = new Kadra();
        $kadra->addPlayer($_GET['name'], $_GET['role']);
        header("Location: sklad.php");
    }
    
        if(isset($_GET['date']) && isset($_GET['club']) && isset($_GET['resultOfGame']) && isset($_GET['opponent'])  && $_SESSION['login']===TRUE) 
    {
        require_once '../phpClass/Terminarz.php';
        $kadra = new Terminarz();
        $kadra->addMatch($_GET['club'], $_GET['opponent'],$_GET['resultOfGame'],$_GET['date'] );
        header("Location: terminarz.php");
    }
}
?>