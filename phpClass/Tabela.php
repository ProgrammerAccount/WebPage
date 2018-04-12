<?php
class Tabela
{
    private $group;
    private $pdo;
    public function __construct($group)
    {
        require_once 'connect_data.php';
        $this->group = $group;
        try {
            $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $e) {
            echo $e->getTraceAsString();
            die();
        }

    }
    public function getTable()
    {
        $result = $this->pdo->query("SELECT * FROM " . $this->group . "Tabela ORDER BY points DESC");
        $i = 1;
        $table = "<table class='table'>"
            . "<tr>"
            . "<th >Pozycja</th>"
            . "<th>Nazwa</th>"
            . "<th>Punkty</th>"
            . "<th class='WDL'>Wygrane</th>"
            . "<th class='WDL'>Remisy</th>"
            . "<th class='WDL'>Przegrane</th>"
            . "</tr>";
        //if($result!=FALSE)
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
        $table = $table . "</table>";
        return $table;
    }

    public function getTableCMS()
    {
        $result = $this->pdo->query("SELECT * FROM " . $this->group . "Tabela ORDER BY points DESC");
        $i = 1;
        $table = "<table class='table'>"
            . "<tr>"
            . "<th>Pozycja</th>"
            . "<th>Nazwa</th>"
            . "<th>Punkty</th>"
            . "<th>Wygrane</th>"
            . "<th>Remisy</th>"
            . "<th>Przegrane</th>"
            . "</tr>";
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

        $table = $table . "</table>";
        return $table;
    }
    public function addTeam($club, $points, $wins, $draws, $losses)
    {
        try {
            $query = $this->pdo->prepare("INSERT INTO " . $this->group . "Tabela " . " VALUES (NULL, :club, :points, :wins, :draws, :losses)");
            $query->bindParam(":club", $club, PDO::PARAM_STR);
            $query->bindParam(":points", $points, PDO::PARAM_INT);
            $query->bindParam(":wins", $wins, PDO::PARAM_INT);
            $query->bindParam(":draws", $draws, PDO::PARAM_INT);
            $query->bindParam(":losses", $losses, PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function removeTeam($id, $club, $points, $wins, $draws, $losses)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM " . $this->group . "Tabela " . " WHERE clubName=:club AND points=:points AND wins=:wins AND draws=:draws AND losses=:losses AND id = :id ");
            $query->bindParam(":club", $club, PDO::PARAM_STR);
            $query->bindParam(":points", $points, PDO::PARAM_INT);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->bindParam(":wins", $wins, PDO::PARAM_INT);
            $query->bindParam(":draws", $draws, PDO::PARAM_INT);
            $query->bindParam(":losses", $losses, PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function editTeam($id, $club, $points, $wins, $draws, $losses)
    {
        try {
            $query = $this->pdo->prepare("UPDATE " . $this->group . "Tabela SET points = :points, wins = :wins, draws = :draws, losses = :losses WHERE clubName = :club AND id = :id ");
            $query->bindParam(":club", $club, PDO::PARAM_STR);
            $query->bindParam(":points", $points, PDO::PARAM_INT);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->bindParam(":wins", $wins, PDO::PARAM_INT);
            $query->bindParam(":draws", $draws, PDO::PARAM_INT);
            $query->bindParam(":losses", $losses, PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}
