<?php
$SERVER = "localhost:3306";
$USER_NAME = "root";
$PASSWORD = "";
$DB_NAME = "Liskowiak";
$dsn = "mysql:host=$SERVER;dbname=$DB_NAME";

        try {
            $pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $e) {
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        }
