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
    private $group;

    public function __construct($group) {
        require_once 'connect_data.php';
        $this->group = $group;
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
        
        $result = $this->pdo->query("SELECT * FROM $this->group ORDER BY role");
        $list = "<table id='squad'>"
                ."<tr class='row'>"
                . "<th class='col-6'>Imie i Nazwisko</th>"
                . "<th class='col-2'>Pozycja</th>"
                ."</tr>";
        if($result!==FALSE)
        while ($row = $result->fetch())
        {
            $list=
                    $list."<tr class='row'>"
                    ."<td class='col-6'>".$row['name']."</td>"
                    ."<td class='col-2'>".$row['role']."</td>"
                    ."</tr>";
        }
        $list=$list."</table>";
        return $list;
    }
     public function getSquadCMS()
    {
        $result = $this->pdo->query("SELECT * FROM $this->group ORDER BY role");
        $form="";
        if($result!==FALSE)
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="remove.php" method="GET">'
                    ."<div class='row'>"        
                    ."<div class='col player form-control'>".$row['name']."</div>"
                    ."<div class='col player form-control' name='role'>".$row['role']."</div>"
                    ."<input type='hidden' name='name' value='".$row['name']."'/>"
                    ."<input type='hidden' name='role' value='".$row['role']."'/>"    
                    ."<input class='col player' type='submit' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }
    public function RemovePlayer($name,$role)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM $this->group WHERE name=:name AND role=:role");
            $query->bindParam(":name", $name);
            $query->bindParam(":role", $role);
            $query->execute();
                        
        }
        catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
        public function addPlayer($name,$role)
    {
        try {
            
            $query = $this->pdo->prepare("INSERT INTO $this->group  VALUES (NULL, :role, :name)");
            $query->bindParam(":name", $name);
            $query->bindParam(":role", $role);
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
