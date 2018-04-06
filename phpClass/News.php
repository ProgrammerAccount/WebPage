<?php
class News
{
    private $pdo;

    public function __construct()
    {
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
    public function getListOfNews()
    {
        $table="";
        $results = $this->pdo->query("SELECT * FROM News");

        if($results != false)
        while($row = $results->fetch())
        {
            $table =$table."<div class='media article'>
            <img class='align-self-start mr-4 ' width='150' height='150'  src='".$row['imgPath']."' alt='Generic placeholder image'>
            <div class='media-body'>
              <a class='title' href='news.php?id=".$row['id']."'><h5 class='mt-0'>".$row['title']."</h5></a>
              ".$row['description']."
            </div>
          </div>";
        }
        return $table;

    }

    public function getListOfNewsCMS()
    {
        $table="";
        $results = $this->pdo->query("SELECT * FROM News");

        if($results != false)
        while($row = $results->fetch())
        {
            $table =$table."<div class='row'>";
            $table =$table."<form action='add.php' method='GET'>";
            $table =$table."<div class='col'><input type='file' name='image'/></div>";
            $table =$table."</form>";

        }
        return $table.'</div>';

    }


    public function getNews($id)
    {
        $table="<div class='article'>";
        $results = $this->pdo->prepare("SELECT * FROM News WHERE id=:id");
        $results->bindParam(':id',$id,PDO::PARAM_INT);
        $results->execute();

        if($results != false)
        while($row = $results->fetch())
        {
            $table=$table."<img class='img' width= '600' height='450'src='".$row['imgPath']."'>";
            $table=$table."<h4 class ='title'>".$row['title']."<h4>";
            $table=$table."<b class='description'>".$row['description']."</b>";
            $table=$table."<p class='text'>".$row['article']."</p>";
        }
        return $table."</div>";

    }
}
?>