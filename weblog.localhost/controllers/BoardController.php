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

  // 글작성페이지에서 글작성 후 업로드
  public function uploadContentAction(){
    $message_name = $_POST['message_name'];
    $message_text = $_POST['message_text'];


    if ($message_name == "") {
      echo "<script>alert('제목을 기입해주세요.')</script>";
      return $this->render(array('messaged' => $message_text), "writeContent", "template");
    }
    $this->boardRowCount = $this->_connect_model->get('Board')->uploadContent();
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

  // 글수정 하기
  public function modifyBoardAction(){
    $pageNum = $this->_request->getPost('content_number');

    $PageValues = $this->_connect_model->
      get('Board')->PageContentBoard($pageNum);

    $content_view = $this->render(array('content' => $PageValues), "modifyContent", "template");
    return $content_view;
  }

  public function modifyUploadBoardAction(){
    $pageNum = $this->_request->getGet('page');

    $modifyValues = array(
      $pageNum,
      $this->_request->getPost('modify_message_name'),
      $this->_request->getPost('modify_message_text')
    );

    $this->_connect_model->
      get('Board')->modifyBoard($modifyValues);

    $this->redirect('/board/contentBoard');

  }

  // 글삭제 하기
  public function deleteBoardAction(){

    $pageNum = $this->_request->getPost('hidden_Contentdelete');

    $this->_connect_model->
      get('Board')->deleteBoard($pageNum);

      $this->redirect('/board/contentBoard');
  }






}
?>
