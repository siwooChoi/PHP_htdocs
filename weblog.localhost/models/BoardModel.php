<?php
class BoardModel extends ExecuteModel {

  public function checkRowCount(){
    $sql = "select * from status";
    $stt = $this->execute($sql);

    $boardRowCount = $stt->rowCount();
    return $boardRowCount;
  }


  // 게시판 글목록 보기
  public function contentBoard(){
    $boardArray = array();

    $sql = "select * from status order by id desc";
    $boardArray = $this->getAllRecord($sql);

    return $boardArray;
  }



  // 게시판 글목록의 '글작성' 버튼 클릭 시 글작성페이지로 이동
  public function clickedWrite(){
    return $this->render(array(), "uploadContent", "template");
  }

  // 글작성페이지에서 글작성 후 작성된 글 업로드
  public function uploadContent(){
    $regist_day = new DateTime();
    $regist_day = $regist_day->format('Y-m-d h:i:s');

    $sql = "insert into status(user_id, user_name, user_nick, message_name, message_text, time_stamp)
                      VALUES(:user_id, :user_name, :user_nick, :message_name, :message_text, :time_stamp)";
    $this->execute($sql, array(
                        ':user_id'=>$_SESSION['user']['id'],
                        ':user_name'=>$_SESSION['user']['user_name'],
                        ':user_nick'=>$_SESSION['user']['nick'],
                        ':message_name'=>$_POST['message_name'],
                        ':message_text'=>$_POST['message_text'],
                        ':time_stamp'=>$regist_day
                      ));
  }

  // 게시글 클릭시 해당 페이지의 값
  public function PageContentBoard($pageNum){
    $boardArray = array();

    $sql = "select * from status where id = :id";
    $boardArray = $this->getAllRecord($sql, array(':id' => $pageNum));

    return $boardArray;
  }

  // 글수정 하기
  public function modifyBoard($PageValues){

    $regist_day = new DateTime();
    $regist_day = $regist_day->format('Y-m-d h:i:s');



    $sql = "update status set message_name = :modify_message_name,
                              message_text = :modify_message_text,
                              time_stamp   = :time_stamp
                              where id = $PageValues[0]";
    $this->execute($sql, array(
                        ':modify_message_name'=>$PageValues[1],
                        ':modify_message_text'=>$PageValues[2],
                        ':time_stamp'         =>$regist_day
                      ));

  }

  // 글삭제 하기
  public function deleteBoard($pageNum){
    $sql = "delete from status where id = $pageNum";
    $this->execute($sql);

  }

}
?>
