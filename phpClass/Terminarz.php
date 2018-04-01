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

class Terminarz {

    private $pdo;
    private $group;
    public function __construct($group) {
        $this->group=$group;
        require_once 'connect_data.php';
        $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";
        
        try {
            $this->pdo= new PDO($dsn, $USER_NAME, $PASSWORD);   
        }
            catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }
    public function getSquadAsTable()
    {
        
        $result = $this->pdo->query("SELECT * FROM ".$this->group."Terminarz"." ORDER BY date DESC");
        $list="<ul class='terminarz'>";
        if($result!==false)
        while ($row = $result->fetch())
        {             

            $date = strtotime($row["date"]);
            $list = $list."<li class='article'>"
                    ."<div class='dateTime'>"
                    ."<div class='hour'>".date('H:i', $date)."</div>"
                    ."<div class='date'>".date('Y-m-d', $date)."</div>"
                    ."</div>"
                    ."<div class='result'>"
                    ."<span class='club'>".$row['club']."</span>"
                    ."<span class='resultOfGame'>".$row['resultOfGame']."</span>"
                    ."<span class='club'>".$row['opponent']."</span>"
                    ."</div>"
                    ."</li>";
        }
        $list=$list."</ul>";
        return $list;
    }
    /*public function getSquadAsTable()
    {
        
        $result = $this->pdo->query("SELECT * FROM $this->group ORDER BY date DESC");
        $list = "<table id='mecze'>"
                ."<tr class='row'>"
                . "<th class='col-3'>Data</th>"
                . "<th class='col-3'>Drużyna 1</th>"
                . "<th class='col-3'>Wynik</th>"
                . "<th class='col-3'>Drużyna 2</th>"
                ."</tr>";
        if($result!==false)
        while ($row = $result->fetch())
        {
            $list=
                    $list."<tr class='row'>"
                    ."<td class='col-3'>".$row['date']."</td>"
                    ."<td class='col-3 team'>".$row['club']."</td>"
                    ."<td class='col-3'>".$row['resultOfGame']."</td>"
                    ."<td class='col-3 team'>".$row['opponent']."</td>"
                    ."</tr>";
        }
        $list=$list."</table>";
        return $list;
    }*/
     public function getSquadCMS()
    {
        $result = $this->pdo->query("SELECT * FROM ".$this->group."Terminarz"." ORDER BY date DESC");
        $form="";
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="remove.php" method="GET">'
                    ."<div class='row'>"        
                    ."<div class='col player form-control'>".$row['date']."</div>"
                    ."<div class='col player team form-control'>".$row['club']."</div>"
                    ."<div class='col player form-control'>".$row['resultOfGame']."</div>"
                    ."<div class='col player team form-control'>".$row['opponent']."</div>"
                    ."<input type='hidden' name='date' value='".$row['date']."'/>"
                    ."<input type='hidden' name='club' value='".$row['club']."'/>"    
                    ."<input type='hidden' name='resultOfGame' value='".$row['resultOfGame']."'/>"
                    ."<input type='hidden' name='opponent' value='".$row['opponent']."'/>"
                    ."<input type='hidden' name='grupa' value='".$this->group."'/>"
                    ."<input class='col player' type='submit' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }
    public function RemoveMatch($club,$opponent,$resultOfGame,$date)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM ".$this->group."Terminarz"." WHERE club=:club AND opponent=:opponent AND resultOfGame=:resultOfGame AND date=:date");
            $query->bindParam(":club", $club);
            $query->bindParam(":opponent", $opponent);
            $query->bindParam(":resultOfGame", $resultOfGame);
            $query->bindParam(":date", $date);
            $query->execute();
                        
        }
        catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
        public function addMatch($club,$opponent,$resultOfGame,$date)
    {
        try {
            $date = $date.":00";

            $query = $this->pdo->prepare("INSERT INTO ".$this->group."Terminarz"."  VALUES (NULL, :club, :opponent, :resultOfGame, :date)");
            $query->bindParam(":club", $club);
            $query->bindParam(":opponent", $opponent);
            $query->bindParam(":resultOfGame", $resultOfGame);
            $query->bindParam(":date", $date);

            $query->execute();
                        
        }
        catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function __destruct() {

    }
}

?>
