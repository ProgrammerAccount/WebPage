<?php
require "/var/www/html/liskowiak/tests/HTML5Validate.php";
use PHPUnit\Framework\TestCase;
class testNews extends TestCase
{

    public function test_getListOfNews_html5Validation()
    {

        $news=new News($this->getPdoMock(array("imgPath"=>"path","id"=>"6","title"=>"title","description"=>"description")));
        $validator=new HTML5Validate();
        $result=$validator->Assert($news->getListOfNews());
        $this->assertTrue($result, true);
    }

    public function test_getListOfNewsCMS_html5Validation()
    {
        $news=new News($this->getPdoMock(array("imgPath"=>"path","id"=>"6","title"=>"title","description"=>"description","article"=>"article")));
        $validator=new HTML5Validate();
        $result=$validator->Assert($news->getListOfNewsCMS());
        $this->assertTrue($result, true);

        
    }
    //public function test_removeImg()
   // {
       // $this->assertTrue(News::removeImg("Screenshotfrom2018-03-2915-09-17.png","../img/"));
    //}
    public function test_getNews_html5Validation()
    {
        $validator =  new HTML5Validate();     

        $news=new News($this->getPdoMock(array("title"=>"title","article"=>"article","description"=>"description","imPath"=>"imgPath")));
        $this->assertTrue($validator->Assert($news->getNews(1)), true);
    
    }
    public function test_editNews(){

    $news =  new News($this->getPdoMock(array()));
    $this->assertEquals($news->editNews('id', '$title', '$description', '$article', '$imgPath'),true);
    }
    public function test_addNews(){
        $news =  new News($this->getPdoMock(array()));
        $this->assertEquals($news->addNews('$title', '$description', '$article', '$imgPath'),true);
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