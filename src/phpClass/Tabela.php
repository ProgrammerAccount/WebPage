<?php
class Tabela
{
    private $group;
    private $pdo;
    public $dbTableName = "Tabela";
    public function __construct($group)
    {
        require 'connect_data.php';
        $this->group = $group;
        $this->dbTableName = $this->group . $this->dbTableName;
        try {
            $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $e) {
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        }

    }
    public function getTable()
    {
        $table = "<table class='table'>"
            . "<tr>"
            . "<th >Pozycja</th>"
            . "<th>Nazwa</th>"
            . "<th>Punkty</th>"
            . "<th class='WDL'>Wygrane</th>"
            . "<th class='WDL'>Remisy</th>"
            . "<th class='WDL'>Przegrane</th>"
            . "</tr>";
        try {
            $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY points DESC");
            $i = 1;

            if ($result != false) {
                while ($row = $result->fetch()) {
                    $table = $table . "<tr>"
                        . "<td>$i</td>"
                        . "<td>" . $row['clubName'] . "</td>"
                        . "<td>" . $row['points'] . "</td>"
                        . "<td class='WDL'>" . $row['wins'] . "</td>"
                        . "<td class='WDL'>" . $row['draws'] . "</td>"
                        . "<td class='WDL'>" . $row['losses'] . "</td>"

                        . "</tr>";
                    $i++;

                }
            }

        } catch (Exception $e) {

        }
        $table = $table . "</table>";
        return $table;
    }

    public function getTableCMS()
    {
        $table = "<table class='table'>"
            . "<tr>"
            . "<th>Pozycja</th>"
            . "<th>Nazwa</th>"
            . "<th>Punkty</th>"
            . "<th>Wygrane</th>"
            . "<th>Remisy</th>"
            . "<th>Przegrane</th>"
            . "</tr>";
        $i = 1;
        try {
            $result = $this->pdo->query("SELECT * FROM " . $this->dbTableName . " ORDER BY points DESC");
            if ($result != false) {
                while ($row = $result->fetch()) {
                    $table = $table . "<tr>   <div class='row'>"

                    . "<td>$i</td>"

                    . "<form class='form-group'  action='' method='GET'>"

                    . "<td><input class='form-control col' type='text' name='club' readonly value='" . $row['clubName'] . "'/></td>"
                    . "<td><input class='form-control col' type='text' name='points' value='" . $row['points'] . "'/></td>"
                    . "<td><input class='form-control col' type='text' name='wins' value='" . $row['wins'] . "'/></td>"
                    . "<td><input class='form-control col' type='text' name='draws' value='" . $row['draws'] . "'/></td>"
                    . "<td><input class='form-control col' type='text' name='losses' value='" . $row['losses'] . "'/></td>"
                    . "<td><input type='hidden' name='grupa' value='" . $this->group . "'/></td>"
                        . "<td><input type='hidden' name='id' value='" . $row['id'] . "'/></td>"
                        . "<td><input class='form-control col player' type='submit' name='edit' value='Edytuj'/></td>"
                        . "<td><input class='form-control col player' type='submit' name='remove' value='Usuń'/> </form></td>"
                        . "</div></tr>";
                    $i++;

                }
            }
        } catch (Exception $e) {

        }

        $table = $table . "</table>";
        return $table;
    }
    public function addTeam($club, $points, $wins, $draws, $losses)
    {
        try {
            $club=htmlspecialchars($club);
            $points=htmlspecialchars($points);
            $draws=htmlspecialchars($draws);
            $losses=htmlspecialchars($losses);
            $wins=htmlspecialchars($wins);
            $statement = $this->pdo->prepare("INSERT INTO " . $this->dbTableName . " VALUES (NULL, :club, :points, :wins, :draws, :losses)");
            $statement->bindParam(":club", $club, PDO::PARAM_STR);
            $statement->bindParam(":points", $points, PDO::PARAM_INT);
            $statement->bindParam(":wins", $wins, PDO::PARAM_INT);
            $statement->bindParam(":draws", $draws, PDO::PARAM_INT);
            $statement->bindParam(":losses", $losses, PDO::PARAM_INT);
            $statement->execute();

        } catch (PDOException $exc) {
            //echo $exc->getMessage();
        }
    }

    public function removeTeam($id, $club, $points, $wins, $draws, $losses)
    {
        try {
            $club=htmlspecialchars($club);
            $points=htmlspecialchars($points);
            $draws=htmlspecialchars($draws);
            $losses=htmlspecialchars($losses);
            $wins=htmlspecialchars($wins);
            $id=htmlspecialchars($id);

            $statement = $this->pdo->prepare("DELETE FROM " . $this->dbTableName . " WHERE clubName=:club AND points=:points AND wins=:wins AND draws=:draws AND losses=:losses AND id = :id ");
            $statement->bindParam(":club", $club, PDO::PARAM_STR);
            $statement->bindParam(":points", $points, PDO::PARAM_INT);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":wins", $wins, PDO::PARAM_INT);
            $statement->bindParam(":draws", $draws, PDO::PARAM_INT);
            $statement->bindParam(":losses", $losses, PDO::PARAM_INT);
            $statement->execute();

        } catch (PDOException $exc) {
            //echo $exc->getMessage();
        }
    }
    public function editTeam($id, $club, $points, $wins, $draws, $losses)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE " . $this->dbTableName . " SET points = :points, wins = :wins, draws = :draws, losses = :losses WHERE clubName = :club AND id = :id ");
            $club=htmlspecialchars($club);
            $id=htmlspecialchars($id);
            $points=htmlspecialchars($points);
            $draws=htmlspecialchars($draws);
            $losses=htmlspecialchars($losses);
            $wins=htmlspecialchars($wins);

            $statement->bindParam(":club", $club, PDO::PARAM_STR);
            $statement->bindParam(":points", $points, PDO::PARAM_INT);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":wins", $wins, PDO::PARAM_INT);
            $statement->bindParam(":draws", $draws, PDO::PARAM_INT);
            $statement->bindParam(":losses", $losses, PDO::PARAM_INT);
            $statement->execute();

        } catch (PDOException $exc) {
            //echo $exc->getMessage();
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

}
