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
        
        $result = $this->pdo->query("SELECT * FROM ". $this->group."Kadra". " ORDER BY role");
        $table = "<table id='squad'>"
                ."<tr class='row'>"
                . "<th class='col-8'>Imie i Nazwisko</th>"
                . "<th class='col-4'>Rola</th>"
                ."</tr>";
        if($result!==FALSE)
        while ($row = $result->fetch())
        {
                    $table=
                    $table."<tr class='row'>"
                    ."<td class='NamePlayer col-8'>".$row['name']."</td>"
                    ."<td class='PositionPlayer col-4'>".$row['role']."</td>"
                    ."</tr>";
        }
        $table=$table."</table>";
        return $table;
    }
    public function getSquadOfPentaqueAsTable()
    {
        
        $result = $this->pdo->query("SELECT * FROM ". $this->group."Kadra". " ORDER BY role");
        $table = "<table id='squad'>"
                ."<tr class='row'>"
                . "<th class='col-12'>Imie i Nazwisko</th>"
                ."</tr>";
        if($result!==FALSE)
        while ($row = $result->fetch())
        {
                    $table=
                    $table."<tr class='row'>"
                    ."<td class='NamePlayer col-12'>".$row['name']."</td>"
                    ."</tr>";
        }
        $table=$table."</table>";
        return $table;
    }
     public function getSquadCMS()
    {
 
        $result = $this->pdo->query("SELECT * FROM ". $this->group."Kadra". " ORDER BY role");
        $form="";
        //if($result!==FALSE)
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="" method="GET">'
                    ."<div class='row'>"        
                    ."<div class='col player form-control'>".$row['name']."</div>"
                    ."<div class='col player form-control' name='role'>".$row['role']."</div>"
                    ."<input type='hidden' name='name' value='".$row['name']."'/>"
                    ."<input type='hidden' name='role' value='".$row['role']."'/>"
                    ."<input type='hidden' name='grupa' value='".$this->group."'/>"        
                    ."<input class='col player' type='submit' name='remove' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }

    public function getSquadOfPetanqueCMS()
    {
 
        $result = $this->pdo->query("SELECT * FROM ". $this->group."Kadra". " ORDER BY role");
        $form="";
        //if($result!==FALSE)
        while ($row = $result->fetch())
        {
                    $form=
                    $form.'<form class="form-group" style="width:100vw" action="" method="GET">'
                    ."<div class='row'>"        
                    ."<div class='col player form-control'>".$row['name']."</div>"
                    ."<div class='col player form-control' style='display:none' name='role'>".$row['role']."</div>"
                    ."<input type='hidden' name='name' value='".$row['name']."'/>"
                    ."<input type='hidden' name='role' value='".$row['role']."'/>"
                    ."<input type='hidden' name='grupa' value='".$this->group."'/>"        
                    ."<input class='col player' type='submit' name='remove' value='Usuń'/>" 
                    . "</div>"
                    ."</form></br>";
        }
        return $form;
    }
    public function RemovePlayer($name,$role)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM " . $this->group."Kadra ". "WHERE name=:name AND role=:role");
            $query->bindParam(":name", $name, PDO::PARAM_STR);
            $query->bindParam(":role", $role, PDO::PARAM_STR);
            $query->execute();
                        
        }
        catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
        public function addPlayer($name,$role)
    {
        try {
            $query = $this->pdo->prepare("INSERT INTO ". $this->group."Kadra "." VALUES (NULL, :role, :name)");
            $query->bindParam(":name", $name, PDO::PARAM_STR);
            $query->bindParam(":role", $role, PDO::PARAM_STR);
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
