<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kadra
 *
 * @author janiak
 */

class Kadra
{

    private $pdo;
    private $group;
    private $dbTableName="Kadra";
    public function __construct($group)
    {
        require_once 'connect_data.php';
        $this->group = $group; // for example "Orliki","Trampkarze"
        $this->dbTableName = $this->group.$this->dbTableName;
        $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";

        try {
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $e) {
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        }

    }

    public function getSquadAsTable()
    {
        $table = "<table id='squad'>"
            . "<tr class='row'>"
            . "<th class='col-8'>Imie i Nazwisko</th>"
            . "<th class='col-4'>Rola</th>"
            . "</tr>";

        try {
            $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY role");

            if ($result !== false) {
                while ($row = $result->fetch()) {
                    $table =
                        $table . "<tr class='row'>"
                        . "<td class='NamePlayer col-8'>" . $row['name'] . "</td>"
                        . "<td class='PositionPlayer col-4'>" . $row['role'] . "</td>"
                        . "</tr>";
                }
            }
        } catch (Exception $e) {}

        $table = $table . "</table>";
        return $table;
    }
    public function getSquadOfPentaqueAsTable()
    {
        $table = "<table id='squad'>"
            . "<tr class='row'>"
            . "<th class='col-12'>Imie i Nazwisko</th>"
            . "</tr>";
        try {
            $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY role");

            if ($result !== false) {
                while ($row = $result->fetch()) {
                    $table =
                        $table . "<tr class='row'>"
                        . "<td class='NamePlayer col-12'>" . $row['name'] . "</td>"
                        . "</tr>";
                }
            }
        } catch (Exception $e) {}
        $table = $table . "</table>";
        return $table;
    }
    public function getSquadCMS()
    {
        $form = "";
        try {
            $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY role");

            if ($result !== false) {
                while ($row = $result->fetch()) {
                    $form =
                    $form . '<form class="form-group" style="width:100vw" action="" method="GET">'
                    . "<div class='row'>"
                    . "<input class='col form-control' type='text' name='name' value='" . $row['name'] . "'/>"
                    . "<input class='col form-control' type='text' name='role' value='" . $row['role'] . "'/>"
                    . "<input class='col form-control' type='hidden' name='id' value='" . $row['id'] . "'/>"
                    . "<input type='hidden' name='grupa' value='" . $this->group . "'/>"
                        . "<input class='col form-control' type='submit' name='remove' value='Usuń'/>"
                        . "<input class='col form-control' type='submit' name='edit' value='Edytuj'/>"
                        . "</div>"
                        . "</form></br>";
                }
            }

        } catch (Exception $e) {}
        return $form;
    }

    public function getSquadOfPetanqueCMS()
    {
        $form = "";
        try {
            $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY role");
            if ($result !== false) {
                while ($row = $result->fetch()) {
                    $form =
                    $form . '<form class="form-group" style="width:100vw" action="" method="GET">'
                    . "<div class='row'>"
                    . "<input class='col form-control' type='text' name='name' value='" . $row['name'] . "'/>"
                    . "<input class='col form-control' type='hidden' name='id' value='" . $row['id'] . "'/>"
                    . "<input type='text' name='role' value='" . $row['role'] . "'/>"
                    . "<input type='hidden' name='grupa' value='" . $this->group . "'/>"
                        . "<input class='col form-control' type='submit' name='remove' value='Usuń'/>"
                        . "<input class='col form-control' type='submit' name='edit' value='Edytuj'/>"
                        . "</div>"
                        . "</form></br>";
                }
            }
        } catch (Exception $e) {}

        return $form;

    }
    public function removePlayer($name, $role)
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM " . $this->dbTableName . " WHERE name=:name AND role=:role");
            $statement->bindParam(":name", $name, PDO::PARAM_STR);
            $statement->bindParam(":role", $role, PDO::PARAM_STR);
            $statement->execute();

        } catch (PDOException $exc) {}
    }
    public function editPlayer($id, $name, $role)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE " . $this->dbTableName . " SET name=:name , role=:role WHERE id=:id");
            $statement->bindParam(":name", $name, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":role", $role, PDO::PARAM_STR);

            $statement->execute();

        } catch (PDOException $exc) {}
    }
    public function addPlayer($name, $role)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO " . $this->dbTableName . " VALUES (NULL, :role, :name)");
            $statement->bindParam(":name", $name, PDO::PARAM_STR);
            $statement->bindParam(":role", $role, PDO::PARAM_STR);
            $statement->execute();

        } catch (PDOException $exc) {}
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
