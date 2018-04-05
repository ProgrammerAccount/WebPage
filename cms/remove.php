<?php
session_start();
if(isset($_SESSION['login']) && isset($_SESSION['username']) && isset($_GET['grupa']))
{
    if(isset($_GET['name']) && isset($_GET['role']) && $_SESSION['login']===TRUE) 
    {
        $headerUrl="kadra.php?grupa=".$_GET['grupa'];
        require_once '../phpClass/Kadra.php';
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
            case "Komisja":
            {
                $headerUrl="klub.php?grupa=".$_GET['grupa'];
                $group="Komisja";
                break;
            }
                            
            case "Wladze":
            {
                $headerUrl="klub.php?grupa=".$_GET['grupa'];
                $group="Wladze";
                break;
            }
                            
            case "Zarzad":
            {
                $headerUrl="klub.php?grupa=".$_GET['grupa'];
                $group="Zarzad";
                break;
            }
                        
        }
        $kadra = new Kadra($group);
        $kadra->RemovePlayer($_GET['name'], $_GET['role']);
        header("Location: $headerUrl");
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


        $kadra->RemoveMatch($_GET['club'], $_GET['opponent'],$_GET['resultOfGame'],$_GET['date'] );
        header("Location: terminarz.php?grupa=".$_GET['grupa']);
        }
        
        
        if(isset($_GET['remove']) && isset($_GET['club']) && isset($_GET['points']) && isset($_GET['wins']) && isset($_GET['draws']) && isset($_GET['losses'])  && $_SESSION['login']===TRUE)
        {
        require_once '../phpClass/Tabela.php';
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
        
        $tabela = new Tabela($group);

        $tabela->removeTeam($_GET['club'],$_GET['points'], $_GET['wins'],$_GET['draws'],$_GET['losses']);
        header("Location: tabela.php?grupa=".$_GET['grupa']);
        }
        
        
        if(isset($_GET['edit']) && isset($_GET['club']) && isset($_GET['points']) && isset($_GET['wins']) && isset($_GET['draws']) && isset($_GET['losses'])  && $_SESSION['login']===TRUE)
        {
        require_once '../phpClass/Tabela.php';
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
        
        $tabela = new Tabela($group);

        $tabela->editTeam($_GET['club'],$_GET['points'], $_GET['wins'],$_GET['draws'],$_GET['losses']);
        header("Location: tabela.php?grupa=".$_GET['grupa']);
        }
} else    header("Location:index.php");
?>