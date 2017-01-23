<?php
  class TestController extends Controller{

    const NAZE = "naze";
    const PAGE1 = "page1";
    const PAGE2 = "page2";

    // render() 아무런 값을 넣지 않고, test1Action 의 Action을 제외한 이름과 같은 test1.php 를 불러오는 함수

    public function testechoAction(){
      echo "testecho 실행<br>";
    }

    public function test1Action() {
        return $this->render();
    }

    // render()에 값을 넣어서 특정 이름의 ~~.php 를 불러오는 함수
    public function test2Action() {
      // echo "<script>alert('clicked!')</script>";
      // $nonearray = array();

      // if문으로 어떠한 결과값에 따라 다른 화면을 보여줄 수 있을 것 같다.

        // return $this->render($nonearray , "modelTest" , null );
        return $this->render();
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

    public function fileuploadAction(){

       // 설정
       $file = array();
       // 변수 정리
       $file['error'] = $_FILES['myfile']['error']; //파일 업로드에 관련한 에러 코드.
       $file['fname'] = $_FILES['myfile']['name']; //넘어온 파일의 이름을 추출할때 사용
       $file['ftype'] = pathinfo($file['fname'])['extension']; //파일의 확장자를 확인을 하기 위해서 한것이다.
       $file['fsize'] = $_FILES['myfile']['size'];// 파일의 사이즈
       $file['fpath'] = './img/board/'.$file['fname'];
       $file['allowed_ext'] = array('JPG','jpg','jpeg','png','gif','txt');

       // 오류 확인
       if( $file['error'] != UPLOAD_ERR_OK ) {
           switch( $file['error'] ) {
               case UPLOAD_ERR_INI_SIZE: //업로드한 파일이 php.ini파일의 upload_max_filesize 지시어보다 큽니다.
               case UPLOAD_ERR_FORM_SIZE://업로드한 파일이 HTML 폼에서 지정한 MAX_FILE_SIZE 지시어보다 큽니다.
                   echo "<script>window.alert(파일이 너무 큽니다. (".$file['error']."));</script>";
                   break;
               case UPLOAD_ERR_NO_FILE:
                   echo "<script>window.alert(파일이 첨부되지 않았습니다. (".$file['error']."));</script>";
                   break;
               default:
                   echo "<script>window.alert(파일이 제대로 업로드되지 않았습니다. (".$file['error']."));</script>";
           }
           exit;
       }

       // 확장자 확인
       if( !in_array($file['ftype'], $file['allowed_ext']) ) {
           echo "허용되지 않는 확장자입니다.";
           exit;
       }

       // 파일 이동
       //move_uploaded_file는 임시로 저장이 된 파일을 디렉토리에 옮기는 함수이다. 첫번째 인자는 임시저장한 파일, 두번째 인자는 이동할 디렉토리경로와 파일명을 적는다.
       //$_FILES[yourfile]['tmp_name']는 서버에 저장된 업로드된 파일의 임시 파일 이름을 말한다.
       move_uploaded_file( $_FILES['myfile']['tmp_name'], $file['fpath']);

       return $this->redirect('/test/test1');
   }

  }



 ?>
