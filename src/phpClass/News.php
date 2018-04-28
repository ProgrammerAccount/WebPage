<?php
class News
{
    private $pdo;
    public $dbTableName = "News";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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

        $table = "<div class='table'>"
            . "<div class='theader'>"
            . "<div class='tr'>"
            . "<div class='th'>Zdjecie</div>"
            . "<div class='th'>Tytuł</div>"
            . "<div class='th'>Opis</div>"
            . "<div class='th'>Artykuł</div>"
            . "</div>"
            . "</div> <div class='tbody'>";
        if ($results != false) {
            while ($row = $results->fetch()) {
                $table = $table . "<form class='tr' enctype='multipart/form-data'  id='" . $row['id'] . "'  method='POST'>"
                    . "<div class='td fileUploader' style='background:url(../img/" . $row['imgPath'] . ")no-repeat center center'><input  type='file' name='img' /></div>"
                    . "<div class='td'><input  type='text' name='title' value='" . $row['title'] . "'/></div>"
                    . "<div class='td'><textarea  form='" . $row['id'] . "' name='description'>" . $row['description'] . "</textarea></div>"
                    . "<div class='td'><textarea  form='" . $row['id'] . "' name='article'>" . $row['article'] . "</textarea></div>"
                    . "<div class='td'><input type='hidden' name='id' value='" . $row['id'] . "'/></div>"
                    . "<div class='td'><input type='hidden' name='imgName' value='" . $row['imgPath'] . "'/></div>"
                    . "<div class='td'><input type='submit' name='edit' value='Edytuj'></div>"
                    . "<div class='td'><input type='submit' name='remove' value='Usun'></div>"
                    . " </form>";
            }
        }

        $table = $table . "</div></div>";
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
    public function addImg($file, $sourceFolderPath)
    {
        if (is_file($file['tmp_name'])) {
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
            if(!strstr(mime_content_type($file['tmp_name']),"image")){
                $positiveValidation = false;
            }
            if ($positiveValidation) {
                $fileName = str_replace(' ', '', (basename($file['name'])));
                $fileName = preg_replace('/[^A-Za-z0-9 _ .]/', '', $fileName);
                while (file_exists($sourceFolderPath . $fileName)) {
                    $fileName = "a" . $fileName;
                }

                if (move_uploaded_file($file['tmp_name'], $sourceFolderPath . $fileName)) {

                    return $fileName;
                }
                return false;
            }
            return false;
        }return false;
    }
    public function removeImg($imgName, $sourceFolderPath)
    {
        try {
            //echo file_exists($sourceFolderPath . $imgName)."<br>".$sourceFolderPath . $imgName;

            if (file_exists($sourceFolderPath . $imgName)) {
                return unlink($sourceFolderPath . $imgName);
            }
            return false;

        } catch (Exeption $e) {return false;}

    }
    public function addNews($title, $description, $article, $imgPath)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO $this->dbTableName VALUES(NULL,:title,:description,:article,:imgPath)");
            $title = htmlspecialchars($title);
            $description = htmlspecialchars($description);
            $article = htmlspecialchars($article);
            $imgPath = htmlspecialchars($imgPath);

            $statement->bindParam(":title", $title, PDO::PARAM_STR);
            $statement->bindParam(":description", $description, PDO::PARAM_STR);
            $statement->bindParam(":article", $article, PDO::PARAM_STR);
            $statement->bindParam(":imgPath", $imgPath, PDO::PARAM_STR);
            return $statement->execute();
        } catch (Exeption $e) {}
    }

    public function editNews($id, $title, $description, $article, $imgPath)
    {

        $statement = $this->pdo->prepare("UPDATE $this->dbTableName SET title=:title , description = :description , article=:article , imgPath=:imgName WHERE id=:id");
        $title = htmlspecialchars($title);
        $id = htmlspecialchars($id);
        $description = htmlspecialchars($description);
        $article = htmlspecialchars($article);
        $imgPath = htmlspecialchars($imgPath);

        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->bindParam(":article", $article, PDO::PARAM_STR);
        $statement->bindParam(":imgName", $imgPath, PDO::PARAM_STR);
        return $statement->execute();

    }
    public function removeNews($id, $imgName, $SOURCE_FOLDER_IMG)
    {
        try {
            $this->removeImg($imgName, $SOURCE_FOLDER_IMG);
            $statement = $this->pdo->prepare("DELETE FROM $this->dbTableName WHERE id=:id");
            $id = htmlspecialchars($id);

            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (Exeption $e) {}

    }
    public function __destruct()
    {
        $this->pdo = null;
    }
}
