<?php
  class TestController extends Controller{

    const NAZE = "naze";
    const PAGE1 = "page1";
    const PAGE2 = "page2";

    // render() 아무런 값을 넣지 않고, test1Action 의 Action을 제외한 이름과 같은 test1.php 를 불러오는 함수
    public function test1Action() {
        return $this->render();
    }

    // render()에 값을 넣어서 특정 이름의 ~~.php 를 불러오는 함수
    public function test2Action() {
      // echo "<script>alert('clicked!')</script>";
      $nonearray = array();

      // if문으로 어떠한 결과값에 따라 다른 화면을 보여줄 수 있을 것 같다.

        return $this->render($nonearray , "modelTest" , null );
        // return $this->render();
    }

    // 값을 입력받고, 값에 따라 다른 페이지를 보여주는 함수
    public function testPrintAction(){
      $nonearray = array();
      $value1 = $_POST['value1'];
      $value2 = $_POST['value2'];

      $resultValue = $value1 + $value2;

      if($resultValue <= 10){
        return $this->render($nonearray , SELF::PAGE1 , "template" );
      } else {
        return $this->render($nonearray , SELF::PAGE2 , "template" );
      }
    }

    // model 에서 pdo객체를 활용해서 sql을 처리하는 연습 함수
    public function testPDOAction(){
      echo "testController 안에서의 testPDO function 사용<br>";

      $rowCountValue = $this->_connect_model->get('Test')->testModel_rowCount();

      // $valueArray = array("rowCount" => $rowCountValue);
      $valueArray = array($rowCountValue);

      return $this->render($valueArray, "modelTest", "template");

    }

  }



 ?>
