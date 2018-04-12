<?php
class Contact
{
    private $pdo;
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
        $query = $this->pdo->query("SELECT * FROM Contact");
        while ($row = $query->fetch()) {
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
        $query = $this->pdo->query("SELECT * FROM Contact");
        while ($row = $query->fetch()) {
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
        $query = $this->pdo->prepare("INSERT INTO Contact VALUES (NULL,:name,:phoneNumber,:email)");
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
    }
    public function removeContact($id, $name, $phoneNumber, $email)
    {
        $query = $this->pdo->prepare("DELETE FROM Contact WHERE id=:id AND name=:name AND phoneNumber=:phoneNumber AND email=:email");
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $query->execute();
    }
    public function editContact($id, $name, $phoneNumber, $email)
    {
        $query = $this->pdo->prepare("UPDATE Contact SET phoneNumber=:phoneNumber,email=:email WHERE Contact.name = :name AND Contact.id=:id");
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
        $query->execute();
    }
}
