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

class Kadra {

    private $pdo;

    public function __construct() {
        require_once 'connect_data.php';
        $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";
        
        try {
            $this->pdo= new PDO($dsn, $USER_NAME, null);   
        }
            catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }
    
    public function getSquadAsTable()
    {
        
        $result = $this->pdo->query("SELECT * FROM Kadra ORDER BY role");
        $list = "<table id='squad'>"
                ."<tr class='row'>"
                . "<th class='col-6'>Imie i Nazwisko</th>"
                . "<th class='col-2'>Pozycja</th>"
                . "<th class='col-2'>Wiek</th>"
                . "<th class='col-2'>Numer</th>"
                ."</tr>";
        while ($row = $result->fetch())
        {
            $age =  date("Y") -$row['yearOfBrith'];
            $list=
                    $list."<tr class='row'>"
                    ."<td class='col-6'>".$row['name']."</td>"
                    ."<td class='col-2'>".$row['role']."</td>"
                    ."<td class='col-2'>". $age."</td>"
                     ."<td class='col-2'>".$row['TShirtNumber']."</td>"
                    ."</tr>";
        }
        $list=$list."</table>";
        return $list;
    }
     public function getSquadCMS()
    {
        $result = $this->pdo->query("SELECT * FROM Kadra ORDER BY role");
        $form="";
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="remove.php" method="GET">'
                    ."<div class='row'>"        
                    ."<div class='col player form-control'>".$row['name']."</div>"
                    ."<div class='col player form-control' name='role'>".$row['role']."</div>"
                    ."<div class='col player form-control' name='year'> ". $row['yearOfBrith']."</div>"
                    ."<div class='col player form-control' name='Tshirt'>".$row['TShirtNumber']."</div>"
                    ."<input type='hidden' name='name' value='".$row['name']."'/>"
                    ."<input type='hidden' name='role' value='".$row['role']."'/>"
                    ."<input type='hidden' name='year' value='".$row['yearOfBrith']."'/>"
                    ."<input type='hidden' name='Tshirt' value='".$row['TShirtNumber']."'/>"        
                    ."<input class='col player' type='submit' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }
    public function RemovePlayer($name,$role,$year,$Tshirt)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM Kadra WHERE name=:name AND role=:role AND yearOfBrith=:year AND TShirtNumber=:TShirtNumber");
            $query->bindParam(":name", $name);
            $query->bindParam(":role", $role);
            $query->bindParam(":year", $year);
            $query->bindParam(":TShirtNumber", $Tshirt);
            $query->execute();
                        
        }
        catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
        public function addPlayer($name,$role,$year,$Tshirt)
    {
        try {
            
            $query = $this->pdo->prepare("INSERT INTO Kadra  VALUES (NULL, :role, :name, :year, :TShirtNumber)");
            $query->bindParam(":name", $name);
            $query->bindParam(":role", $role);
            $query->bindParam(":year", $year);
            $query->bindParam(":TShirtNumber", $Tshirt);
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
