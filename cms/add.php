<?php
session_start();
if(isset($_SESSION['login']) && isset($_SESSION['username']) && isset($_GET['grupa']))
{
    if(isset($_GET['name']) && isset($_GET['role']) && $_SESSION['login']===TRUE) 
    {
        require_once '../phpClass/Kadra.php';
        $group="";
        switch ($_GET['grupa'])
        {
            case "Seniorzy":
            {
                $group="SeniorzyKadra";
                break;
            }
                            
            case "Trampkarze":
            {
                $group="TrampkarzeKadra";
                break;
            }
                            
            case "Mlodziki":
            {
                $group="MlodzikiKadra";
                break;
            }
                            
            case "Orliki":
            {
                $group="OrlikiKadra";
                break;
            }
                            
            case "Zaki":
            {
                $group="ZakiKadra";
                break;
            }
                        
        }
        $kadra = new Kadra($group);
        $kadra->addPlayer($_GET['name'], $_GET['role']);
        header("Location: kadra.php?grupa=".$_GET['grupa']);
    }
    
        if(isset($_GET['date']) && isset($_GET['club']) && isset($_GET['resultOfGame']) && isset($_GET['opponent'])  && $_SESSION['login']===TRUE) 
        {
        require_once '../phpClass/Terminarz.php';
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
            }        
        
        $kadra = new Terminarz($group);


        $kadra->addMatch($_GET['club'], $_GET['opponent'],$_GET['resultOfGame'],$_GET['date'] );
        header("Location: terminarz.php?grupa=".$_GET['grupa']);
        }
} else    header("Location:index.php");
?>