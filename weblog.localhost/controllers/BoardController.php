<?php
class BoardController extends Controller{

  const POST = 'board/post';
  public $boardValues;
  public $boardRowCount;

  // 게시판 글목록 보기
  public function contentBoardAction(){
    // 게시글이 존재하는지 확인
    $this->boardRowCount = $this->_connect_model->get('Board')->checkRowCount();

    if($this->boardRowCount == 0){
      $board_view = $this->render();
      return  $board_view;

    } else{
      $this->boardValues = $this->_connect_model->
        get('Board')->contentBoard();

      $board_view = $this->render(array('content' => $this->boardValues), "contentBoard", "template");
      return $board_view;
    }
  }

  // 글작성페이지로 이동
  public function writeContentAction(){
    return $this->render(array(), "writeContent", "template");
  }

  // 글제목 검색
  public function searchContentAction(){
    $search = "%".$_POST['searchContent']."%";


    $this->boardValues = $this->_connect_model->
      get('Board')->searchContent($search);

    $board_view = $this->render(array('content' => $this->boardValues), "contentBoard", "template");
    return $board_view;

  }

  // 글작성페이지에서 글작성 후 업로드
  public function uploadContentAction($file_name = null, $file_path = null, $file_size = null){
    $message_name = $_POST['message_name'];
    $message_text = $_POST['message_text'];


    if ($message_name == "") {
      echo "<script>alert('제목을 기입해주세요.')</script>";
      return $this->render(array('messaged' => $message_text), "writeContent", "template");
    }
    $this->boardRowCount = $this->_connect_model->get('Board')->uploadContent($file_name, $file_path, $file_size);
    $this->redirect('/board/contentBoard');

  }

  // 해당게시판 열람하기
  public function openBoardAction(){
    $pageNum = $this->_request->getGet('page');

    $PageValues = $this->_connect_model->
      get('Board')->PageContentBoard($pageNum);

    $content_view = $this->render(array('content' => $PageValues), "readContent", "template");
    return $content_view;
  }

  // 글수정 눌렀을 때 수정할 페이지호출
  public function modifyBoardAction(){
    $pageNum = $this->_request->getPost('content_number');

    $pageValues = $this->_connect_model->
      get('Board')->PageContentBoard($pageNum);


    $content_view = $this->render(array('content' => $pageValues), "modifyContent", "template");
    return $content_view;
  }

  // 글수정 수정된 글 업로드
  public function modifyUploadBoardAction(){
    $pageNum = $this->_request->getGet('page');

    // 설정
    $file = array();
    // 변수 정리
    $file['error'] = $_FILES['myfile']['error']; //파일 업로드에 관련한 에러 코드.
    $file['fname'] = $_FILES['myfile']['name']; //넘어온 파일의 이름을 추출할때 사용
    if(!isset(pathinfo($file['fname'])['extension'])){
      $file['ftype'] = "txt";
    }else{
      $file['ftype'] = pathinfo($file['fname'])['extension']; //파일의 확장자를 확인을 하기 위해서 한것이다.
    }
    $file['fsize'] = $_FILES['myfile']['size'];// 파일의 사이즈
    $file['fpath'] = './file/'.$file['fname'];
    // $file['fpath'] = './img/'.$file['fname'];
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
        // exit;

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

    //  return $file;

    // echo $file['ftype'];

    $modifyValues = array(
      $pageNum,
      $this->_request->getPost('modify_message_name'),
      $this->_request->getPost('modify_message_text'),
      $file['fname'],
      $file['fpath'],
      $file['fsize']
    );

    var_dump($modifyValues);

    $this->_connect_model->
      get('Board')->modifyBoard($modifyValues);
      // $back = "<script> history.go(-2); </script>";
    $this->redirect('/board/contentBoard');

  }

  // 글삭제 하기
  public function deleteBoardAction(){

    $pageNum = $this->_request->getPost('hidden_Contentdelete');

    $this->_connect_model->
      get('Board')->deleteBoard($pageNum);

      $this->redirect('/board/contentBoard');
  }

  // 파일 업로드
  public function fileuploadAction(){
          // 설정
          $file = array();
          // 변수 정리
          $file['error'] = $_FILES['myfile']['error']; //파일 업로드에 관련한 에러 코드.
          $file['fname'] = $_FILES['myfile']['name']; //넘어온 파일의 이름을 추출할때 사용
          if(!isset(pathinfo($file['fname'])['extension'])){
            $file['ftype'] = "txt";
          }else{
            $file['ftype'] = pathinfo($file['fname'])['extension']; //파일의 확장자를 확인을 하기 위해서 한것이다.
          }
          $file['fsize'] = $_FILES['myfile']['size'];// 파일의 사이즈
          $file['fpath'] = './file/'.$file['fname'];
          // $file['fpath'] = './img/'.$file['fname'];
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
              // exit;

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

      //  return $file;

      // echo $file['ftype'];
          $this->uploadContentAction( $file['fname'],   $file['fpath'],   $file['fsize']);
          $back = "<script> history.go(-2); </script>";
  }


  // 파일 다운로드 (get 페이지넘버 and downloadAction으로 넘버보내기)
  public function pageNumforDownloadAction(){
    $pageNum = $this->_request->getGet('page');
    // echo $pageNum;

    $pageValues = $this->_connect_model->get('board')->returnPageValues($pageNum);

    // var_dump($pageValues);

    $this->downloadAction($pageValues);

  }

  // 파일 다운로드 (pageNumforDownloadAction 로부터 받은 페이지넘버에 다운로드)
  public function downloadAction($par){
        // $pageNum = $this->_request->getGet('page');

        // $dat = $this->_connect_model->get('board')
        //     ->getSelectPost($par['post']);

        $dat = $par;

        $file_path = urldecode($dat[0]['file_path']); ////한글이 암호화나 부호화가 될경우 디코딩한다.
        $file_name = urldecode($dat[0]['file_name']); //한글이 암호화나 부호화가 될경우 디코딩한다.

        if(file_exists($file_path)){
            $fp = fopen($file_path, "rb"); // 저장된 파일을 이진방식으로 읽어 온다. //첫번째 매개인자는 파일경로 두번째 인자는 일기 모드이다.  'r'읽기모드 'w'쓰기 모드 'b'이진모드

            header("Content-type:application/x-msdownload");
            header('Content-Length: '.filesize($file_path));
            header('Content-Disposition: attachment; filename='.$file_name);
            header('Content-Transfer-Encoding: binary');
            Header("Pragma: no-cache");
            header('Expires:0');

            ob_clean();
            // flush();

            if(!fpassthru($fp)){
                fclose($fp);
            }
        }
    }




}
?>
