<?php
class Contact
{
    private $pdo;
    public $dbTableName = "Contact";
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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
            $table = $table . "<form method='GET'><div class='row'>"
                . "<input type='hidden' value='" . $row['id'] . "' name='id'/>"
                . "<input type='text' value='" . $row['name'] . "' name='name' />"
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
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $phoneNumber = htmlspecialchars($phoneNumber);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        return $statement->execute();
    }
    public function removeContact($id, $name, $phoneNumber, $email)
    {
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $phoneNumber = htmlspecialchars($phoneNumber);
        $id = htmlspecialchars($id);
        $statement = $this->pdo->prepare("DELETE FROM $this->dbTableName WHERE id=:id AND name=:name AND phoneNumber=:phoneNumber AND email=:email");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        return $statement->execute();
    }
    public function editContact($id, $name, $phoneNumber, $email)
    {
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $phoneNumber = htmlspecialchars($phoneNumber);
        $id = htmlspecialchars($id);
        $statement = $this->pdo->prepare("UPDATE $this->dbTableName SET name = :name,  phoneNumber=:phoneNumber,email=:email WHERE  $this->dbTableName.id=:id");
        //echo "UPDATE $this->dbTableName SET name = $name  phoneNumber=$phoneNumber,email=$email WHERE  $this->dbTableName.id=$id";exit;
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        return $statement->execute();
    }
    public function __destruct()
    {
        $this->pdo = null;
    }
}
