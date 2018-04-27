<?php
require "/var/www/html/liskowiak/tests/HTML5Validate.php";
use PHPUnit\Framework\TestCase;
class testNews extends TestCase
{
    public function test_getListOfNews_html5Validation()
    {
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue(array("imgPath"=>"path","id"=>"6","title"=>"title","description"=>"description")));
        $pdoSTMT->expects($this->any(1))->method('fetch')->willReturn(false);

        $pdo=$this->createMock('PDO');
        $pdo->expects($this->any())->method('query')->will($this->returnValue($pdoSTMT));

        $news=new News();
        $news->setDB($pdo);

        $validator=new HTML5Validate();
        $result=$validator->Assert($news->getListOfNews());
        $this->assertTrue($result, true);
    }

    public function test_getListOfNewsCMS_html5Validation()
    {
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue(array("imgPath"=>"path","id"=>"6","title"=>"title","description"=>"description","article"=>"article")));
        $pdoSTMT->expects($this->any(1))->method('fetch')->willReturn(false);

        $pdo=$this->createMock('PDO');
        $pdo->expects($this->any())->method('query')->will($this->returnValue($pdoSTMT));

        $news=new News();
        $news->setDB($pdo);

        $validator=new HTML5Validate();
        $result=$validator->Assert($news->getListOfNewsCMS());
        print $validator->message;
        $this->assertTrue($result, true);
        
    }
    //public function test_removeImg()
   // {
       // $this->assertTrue(News::removeImg("Screenshotfrom2018-03-2915-09-17.png","../img/"));
    //}
    public function test_getNews_html5Validation()
    {
        $pdoSTMT = $this->createMock("PDOStatement");
        $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue(array("title"=>"title","article"=>"article","description"=>"description","imPath"=>"imgPath")));
        $pdoSTMT->expects($this->at(1))->method('fetch')->will($this->returnValue(false));
        $PDO =  $this->createMock("PDO");
        $PDO->expects($this->any())->method("prepare")->will($this->returnValue($pdoSTMT));
        $news = new News();
        $news->setDB($PDO);
        $validator =  new HTML5Validate();
        $this->assertTrue($validator->Assert($news->getNews(1)),true);
    
    }
    public function test_editNews(){
    //$recovery= new Recovery();
    $pdoSTMT = $this->createMock('PDOStatement');
    $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
    $pdo=$this->createMock('PDO');
    $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
    $recovery =  new News();
    $recovery->setDB($pdo);
    $this->assertEquals($recovery->editNews('id', '$title', '$description', '$article', '$imgPath'),true);
    }
    public function test_addNews(){
        //$recovery= new Recovery();
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
        $pdo=$this->createMock('PDO');
        $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
        $recovery =  new News();
        $recovery->setDB($pdo);
        $this->assertEquals($recovery->addNews('$title', '$description', '$article', '$imgPath'),true);
        }
   /* public function test_addImg()
    {
        $_FILES = array(
            'test' => array(
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 542,
                'tmp_name' => __DIR__ . '/source-test.jpg',
                'error' => 0
            )
        );
        echo __DIR__ . '/source-test.jpg';
        $src= "/var/www/html/liskowiak/src/img";
       // $this->assertEquals(gettype(News::addImg($_FILES['test'],$src)),gettype("asd"));
       $this->assertEquals((News::addImg($_FILES['test'],$src)),true);
    }*/
}
?>