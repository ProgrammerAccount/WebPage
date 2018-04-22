<?php
class News
{
    private $pdo;
    public $dbTableName="News";

    public function __construct()
    {
        require 'connect_data.php';
        $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";

        try {
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $e) {
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        }

    }
    public function getListOfNews()
    {
        $table = "";
        $results = $this->pdo->query("SELECT * FROM $this->dbTableName ORDER BY id DESC");

        if ($results != false) {
            while ($row = $results->fetch()) {
                $table = $table . "<div class='media article row'>
            <img class='align-self-start mr-4 col-sm-4'  src='img/" . $row['imgPath'] . "' alt='Generic placeholder image'>
            <div class='media-body col-8'>
              <a class='title' href='news.php?id=" . $row['id'] . "'><h5 class='mt-0'>" . $row['title'] . "</h5></a>
              " . $row['description'] . "
            </div>
          </div>";
            }
        }

        return $table;

    }

    public function getListOfNewsCMS()
    {
        $table = "";
        $results = $this->pdo->query("SELECT * FROM $this->dbTableName");

        $table = "<table class='table'>"
            . "<tr>"
            . "<th>Zdjecie</th>"
            . "<th>Tytuł</th>"
            . "<th>Opis</th>"
            . "<th>Artykuł</th>"

            . "</tr>";
        if ($results != false) {
            while ($row = $results->fetch()) {
                $table = $table . "<tr>   <div class='row'>"
                    . "<form class='form-group' enctype='multipart/form-data'  id='" . $row['id'] . "'  action='' method='POST'>"
                    . "<td style='background:url(../img/" . $row['imgPath'] . ")no-repeat center center' class='fileUploader'><input class='form-control col' type='file' name='img' /></td>"
                    . "<td><input class='form-control col' type='text' name='title' value='" . $row['title'] . "'/></td>"
                    . "<td><textarea class='form-control col' form='" . $row['id'] . "' name='description'>" . $row['description'] . "</textarea></td>"
                    . "<td><textarea class='form-control col' form='" . $row['id'] . "' name='article'>" . $row['article'] . "</textarea></td>"
                    . "<td><input type='hidden' name='id' value='" . $row['id'] . "'/></td>"
                    . "<td><input type='hidden' name='imgName' value='" . $row['imgPath'] . "'/></td>"
                    . "<td><input class='form-control col' type='submit' name='edit' value='Edytuj'/></td>"
                    . "<td><input class='form-control col' type='submit' name='remove' value='Usun'> </form></td>"
                    . "</div></tr>";
            }
        }

        $table = $table . "</table>";
        return $table;

    }

    public function getNews($id)
    {
        $table = "<div class='article'>";
        $results = $this->pdo->prepare("SELECT * FROM $this->dbTableName WHERE id=:id");
        $results->bindParam(':id', $id, PDO::PARAM_INT);
        $results->execute();

        if ($results != false) {
            while ($row = $results->fetch()) {
                $table = $table . "<h4 class ='title'>" . $row['title'] . "<h4>";
                $table = $table . "<img class='img' width= '600' height='450'src='img/" . $row['imgPath'] . "'>";
                $table = $table . "<b class='description'>" . $row['description'] . "</b>";
                $table = $table . "<p class='text'>" . $row['article'] . "</p>";
            }
        }

        return $table . "</div>";

    }
    public function addImg($file,$sourceFolderPath)
    {
        if(is_file($file['tmp_name']))
        {
        $positiveValidation = true;
        $fileType = strtolower(pathinfo(basename($file['name']), PATHINFO_EXTENSION));
        if (getimagesize($file['tmp_name']) === false) {
            $positiveValidation = true;
        }

        if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
            $positiveValidation = false;
        }

        if (filesize($file['tmp_name']) > 3000000) {
            $positiveValidation = false;
        }

        if ($positiveValidation) {
            $fileName = str_replace(' ', '', basename($file['name']));
            while (file_exists($sourceFolderPath . $fileName)) {
                $fileName = "a" . $fileName;
            }

            if (move_uploaded_file($file['tmp_name'], $sourceFolderPath . $fileName)) {

                return $fileName;
            }
            return "";
        }
        return "";
    }return "";
    }
    public function removeImg($imgName,$sourceFolderPath)
    {
        try {
            if (file_exists($sourceFolderPath . $imgName)) {
                unlink($sourceFolderPath . $imgName);
            }

        } catch (Exeption $e) {}

    }
    public function addNews($title, $description, $article, $imgPath)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO $this->dbTableName VALUES(NULL,:title,:description,:article,:imgPath)");
            $title = htmlspecialchars($title);
            $description=htmlspecialchars($description);
            $article=htmlspecialchars($article);
            
            $statement->bindParam(":title", $title, PDO::PARAM_STR);
            $statement->bindParam(":description", $description, PDO::PARAM_STR);
            $statement->bindParam(":article", $article, PDO::PARAM_STR);
            $statement->bindParam(":imgPath", $imgPath, PDO::PARAM_STR);
            $statement->execute();
        } catch (Exeption $e) {}
    }

    public function editNews($id, $title, $description, $article, $imgPath)
    {
        try {
            $id=htmlspecialchars($id);
            $article=htmlspecialchars($article);
            $description=htmlspecialchars($description);
            $title=htmlspecialchars($$title);
            $statement = $this->pdo->prepare("UPDATE $this->dbTableName SET title=:title ,description = :description, article=:article,imgPath=:imgPath WHERE id=:id");
            $statement->bindParam(":title",  $$title, PDO::PARAM_STR);
            $statement->bindParam(":description", $description, PDO::PARAM_STR);
            $statement->bindParam(":article", $article, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":imgPath", $imgPath, PDO::PARAM_STR);
            $statement->execute();
        } catch (Exeption $e) {}
    }
    public function removeNews($id, $imgName,$SOURCE_FOLDER_IMG)
    {
        try {
            $this->removeImg($imgName,$SOURCE_FOLDER_IMG);
            $statement = $this->pdo->prepare("DELETE FROM $this->dbTableName WHERE id=:id");
            $id=htmlspecialchars($id);

            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (Exeption $e) {}

    }
    public function __destruct()
    {
        $this->pdo = null;
    }
}
