<?php
class Contact
{
    private $pdo;
    public $dbTableName="Contact";
    public function __construct()
    {
        require 'connect_data.php';
        $dsn = "mysql:host = $SERVER; dbname=$DB_NAME";
        try {
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function getContacts()
    {
        $table = "<div class='row'>"
            . "<div class='header col'>Osoba</div>"
            . "<div class='header col'>Telefon</div>"
            . "<div class='header col'>Email</div>"
            . "</div>";
        $statement = $this->pdo->query("SELECT * FROM $this->dbTableName");
        while ($row = $statement->fetch()) {
            $table = $table . "<div class='row'>"
                . "<div class='col'>" . $row['name'] . "</div>"
                . "<div class='col'>" . $row['phoneNumber'] . "</div>"
                . "<div class='col'>" . $row['email'] . "</div>"
                . "</div>";
        }
        return $table;
    }
    public function getContactsCMS()
    {
        $table = "";
        $statement = $this->pdo->query("SELECT * FROM $this->dbTableName");
        while ($row = $statement->fetch()) {
            $table = $table . "<form action='' method='GET'><div class='row'>"
                . "<input type='hidden' value='" . $row['id'] . "' name='id'/>"
                . "<input type='text' value='" . $row['name'] . "' name='name' readonly />"
                . "<input type='text' value='" . $row['phoneNumber'] . "' name='phoneNumber'/>"
                . "<input type='text' value='" . $row['email'] . "' name='email'/>"
                . "<input class='col' type='submit' value='Usuń' name='remove'/>"
                . "<input class='col' type='submit' value='Edytuj' name='edit'/>"
                . "</div></form>";
        }
        return $table;
    }
    public function addContact($name, $phoneNumber, $email)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->dbTableName VALUES (NULL,:name,:phoneNumber,:email)");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
    }
    public function removeContact($id, $name, $phoneNumber, $email)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->dbTableName WHERE id=:id AND name=:name AND phoneNumber=:phoneNumber AND email=:email");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $statement->execute();
    }
    public function editContact($id, $name, $phoneNumber, $email)
    {
        $statement = $this->pdo->prepare("UPDATE $this->dbTableName SET phoneNumber=:phoneNumber,email=:email WHERE $this->dbTableName.name = :name AND $this->dbTableName.id=:id");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $statement->execute();
    }
    public function __destruct()
    {
        $this->pdo = null;
    }
}
