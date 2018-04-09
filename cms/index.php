
<?php session_start();?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <meta charset="UTF-8">
        <title>Liskowiak</title>
        <link href="../css/cmsLogin.css" rel="stylesheet"/>
    </head>
    <body>
        <form id="login" action="login.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" /> </br>
            <input type="password" name="pass" placeholder="hasło"/> </br>
            <a href="register.php"/>Dodaj Konto</a> </br>
            <input type="submit" value="login"/>
            <?php 
                if(isset($_SESSION["error"]))
                {
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                }
            ?>
        </form>
    </body>
</html>
