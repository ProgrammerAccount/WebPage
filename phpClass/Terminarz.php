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
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        }
        
    }
    public function getTimetable()
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
   
    public function getTimetableOfPetanque()
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
                    ."<span class='petanque'>".$row['club']."</span>"
                    ."</div>"
                    ."</li>";
        }
        $list=$list."</ul>";
        return $list;
    }

     public function getTimetableCMS()
    {
  
        $result = $this->pdo->query("SELECT * FROM ".$this->group."Terminarz"." ORDER BY date DESC");
        $form="";
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="" method="GET">'
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
                    ."<input class='col player' type='submit' name='remove' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }

    public function getTimetableOfPetanqueCMS()
    {
  
        $result = $this->pdo->query("SELECT * FROM ".$this->group."Terminarz"." ORDER BY date DESC");
        $form="";
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="" method="GET">'
                    ."<div class='row'>"        
                    ."<div class='col player form-control'>".$row['date']."</div>"
                    ."<div class='col player team form-control'>".$row['club']."</div>"
                    ."<input type='hidden' name='date' value='".$row['date']."'/>"
                    ."<input type='hidden' name='club' value='".$row['club']."'/>"    
                    ."<input type='hidden' name='resultOfGame' value='".$row['resultOfGame']."'/>"
                    ."<input type='hidden' name='opponent' value='".$row['opponent']."'/>"
                    ."<input type='hidden' name='grupa' value='".$this->group."'/>"
                    ."<input class='col player' type='submit' name='remove' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }


    public function RemoveMatch($club,$opponent,$resultOfGame,$date)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM ".$this->group."Terminarz"." WHERE club=:club AND opponent=:opponent AND resultOfGame=:resultOfGame AND date=:date");
            $query->bindParam(":club", $club, PDO::PARAM_STR);
            $query->bindParam(":opponent", $opponent, PDO::PARAM_STR);
            $query->bindParam(":resultOfGame", $resultOfGame, PDO::PARAM_STR);
            $query->bindParam(":date", $date ,PDO::PARAM_STR,16);
            $query->execute();
                        
        }
        catch (PDOException $exc) {
           echo "Chwilowy brak dostępu do bazy danych";
        }
    }
        public function addMatch($club,$opponent,$resultOfGame,$date)
    {
        try {

            $query = $this->pdo->prepare("INSERT INTO ".$this->group."Terminarz"."  VALUES (NULL, :club, :opponent, :resultOfGame, :date)");
            $query->bindParam(":club", $club, PDO::PARAM_STR);
            $query->bindParam(":opponent", $opponent, PDO::PARAM_STR);
            $query->bindParam(":resultOfGame", $resultOfGame, PDO::PARAM_STR);
            $query->bindParam(":date", $date ,PDO::PARAM_STR,16);

            $query->execute();
                        
        }
        catch (PDOException $exc) {
            echo "Chwilowy brak dostępu do bazy danych";
        }
    }


    public function __destruct() {

    }
}

?>
