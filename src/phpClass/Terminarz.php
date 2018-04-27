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

class Terminarz
{

    private $pdo;
    private $group;
    public $dbTableName = "Terminarz";
    public function __construct($group,$pdo)
    {
        $this->group = $group;
        $this->dbTableName = $this->group . $this->dbTableName;
        $this->pdo = $pdo;
    }
    public function getTimetable()
    {

        $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY date DESC");
        $list = "<ul class='terminarz'>";
        if ($result !== false) {
            while ($row = $result->fetch()) {

                $date = strtotime($row["date"]);
                $list = $list . "<li class='article'>"
                . "<div class='dateTime'>"
                . "<div class='hour'>" . date('H:i', $date) . "</div>"
                . "<div class='date'>" . date('Y-m-d', $date) . "</div>"
                    . "</div>"
                    . "<div class='result'>"
                    . "<span class='club'>" . $row['club'] . "</span>"
                    . "<span class='resultOfGame'>" . $row['resultOfGame'] . "</span>"
                    . "<span class='club'>" . $row['opponent'] . "</span>"
                    . "</div>"
                    . "</li>";
            }
        }

        $list = $list . "</ul>";
        return $list;
    }

    public function getTimetableOfPetanque()
    {

        $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY date DESC");
        $list = "<ul class='terminarz'>";
        if ($result !== false) {
            while ($row = $result->fetch()) {

                $date = strtotime($row["date"]);
                $list = $list . "<li class='article'>"
                . "<div class='dateTime'>"
                . "<div class='hour'>" . date('H:i', $date) . "</div>"
                . "<div class='date'>" . date('Y-m-d', $date) . "</div>"
                    . "</div>"
                    . "<div class='result'>"
                    . "<span class='petanque'>" . $row['club'] . "</span>"
                    . "</div>"
                    . "</li>";
            }
        }

        $list = $list . "</ul>";
        return $list;
    }

    public function getTimetableCMS()
    {

        $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY date DESC");
        $form = "";
        while ($row = $result->fetch()) {
            $form =
            $form . '<form class="form-group" style="width:100vw" action="" method="GET">'
            . "<div class='row'>"
            . "<input class='col form-control' type='text' name='date' value='" . $row['date'] . "' />"
            . "<input class='col form-control' type='text' name='club' value='" . $row['club'] . "'/>"
            . "<input class='col form-control' type='text' name='resultOfGame' value='" . $row['resultOfGame'] . "'/>"
            . "<input class='col form-control' type='text' name='opponent' value='" . $row['opponent'] . "'/>"
            . "<input type='hidden' name='grupa' value='" . $this->group . "'/>"
                . "<input type='hidden' name='id' value='" . $row['id'] . "'/>"
                . "<input class='col player' type='submit' name='remove' value='Usuń'/>"
                . "<input class='col player' type='submit' name='edit' value='Edytuj'/>"
                . "</div>"
                . "</form></br>";
        }
        return $form;
    }

    public function getTimetableOfPetanqueCMS()
    {

        $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY date DESC");
        $form = "";
        while ($row = $result->fetch()) {
            $form =
            $form . '<form class="form-group" style="width:100vw" action="" method="GET">'
            . "<div class='row'>"
            . "<div class='col player form-control'>" . $row['date'] . "</div>"
            . "<div class='col player team form-control'>" . $row['club'] . "</div>"
            . "<input type='hidden' name='date' value='" . $row['date'] . "'/>"
            . "<input type='hidden' name='club' value='" . $row['club'] . "'/>"
            . "<input type='hidden' name='resultOfGame' value='" . $row['resultOfGame'] . "'/>"
            . "<input type='hidden' name='opponent' value='" . $row['opponent'] . "'/>"
            . "<input type='hidden' name='grupa' value='" . $this->group . "'/>"
                . "<input class='col player' type='submit' name='remove' value='Usuń'/>"
                . "</div>"
                . "</form></br>";
        }
        return $form;
    }

    public function editMatch($id, $club, $opponent, $resultOfGame, $date)
    {
        try {
            //echo "UPDATE ".$this->group."Terminarz"."SET club=$club, opponent=$opponent, resultOfGame=$resultOfGame ,date=$date WHERE id=:id";
            //   exit;
            $club = htmlspecialchars($club);
            $opponent = htmlspecialchars($opponent);
            $resultOfGame = htmlspecialchars($resultOfGame);
            $date = htmlspecialchars($date);
            $id = htmlspecialchars($id);
            $statement = $this->pdo->prepare("UPDATE " . $this->dbTableName . " SET club=:club, opponent=:opponent ,resultOfGame=:resultOfGame ,date=:date WHERE id=:id");
            $statement->bindParam(":club", $club, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":opponent", $opponent, PDO::PARAM_STR);
            $statement->bindParam(":resultOfGame", $resultOfGame, PDO::PARAM_STR);
            $statement->bindParam(":date", $date, PDO::PARAM_STR, 16);
            $statement->execute();

        } catch (PDOException $exc) {
            echo "Chwilowy brak dostępu do bazy danych";
        }
    }

    public function RemoveMatch($club, $opponent, $resultOfGame, $date)
    {
        try {
            $club = htmlspecialchars($club);
            $opponent = htmlspecialchars($opponent);
            $resultOfGame = htmlspecialchars($resultOfGame);
            $date = htmlspecialchars($date);
            $statement = $this->pdo->prepare("DELETE FROM " . $this->dbTableName . " WHERE club=:club AND opponent=:opponent AND resultOfGame=:resultOfGame AND date=:date");
            $statement->bindParam(":club", $club, PDO::PARAM_STR);
            $statement->bindParam(":opponent", $opponent, PDO::PARAM_STR);
            $statement->bindParam(":resultOfGame", $resultOfGame, PDO::PARAM_STR);
            $statement->bindParam(":date", $date, PDO::PARAM_STR, 16);
            $statement->execute();

        } catch (PDOException $exc) {
            echo "Chwilowy brak dostępu do bazy danych";
        }
    }
    public function addMatch($club, $opponent, $resultOfGame, $date)
    {
        try {
            $club = htmlspecialchars($club);
            $opponent = htmlspecialchars($opponent);
            $resultOfGame = htmlspecialchars($resultOfGame);
            $date = htmlspecialchars($date);
            $statement = $this->pdo->prepare("INSERT INTO " . $this->dbTableName . "  VALUES (NULL, :club, :opponent, :resultOfGame, :date)");
            $statement->bindParam(":club", $club, PDO::PARAM_STR);
            $statement->bindParam(":opponent", $opponent, PDO::PARAM_STR);
            $statement->bindParam(":resultOfGame", $resultOfGame, PDO::PARAM_STR);
            $statement->bindParam(":date", $date, PDO::PARAM_STR, 16);

            $statement->execute();

        } catch (PDOException $exc) {
            echo "Chwilowy brak dostępu do bazy danych";
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
