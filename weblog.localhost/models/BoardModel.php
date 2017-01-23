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

  // 검색된 단어로 게시판 글목록 찾기
  public function searchContent($search){
    $boardArray = array();

    $sql = "select * from status where message_name like :search order by id desc";
    $boardArray = $this->getAllRecord($sql, array(':search' => $search));

    return $boardArray;
  }

  // 게시판 글목록의 '글작성' 버튼 클릭 시 글작성페이지로 이동
  public function clickedWrite(){
    return $this->render(array(), "uploadContent", "template");
  }

  // 글작성페이지에서 글작성 후 작성된 글 업로드
  public function uploadContent($file_name = null, $file_path = null, $file_size = null){
    $regist_day = new DateTime();
    $regist_day = $regist_day->format('Y-m-d h:i:s');

    $sql = "insert into status(user_id, user_name, user_nick, message_name, message_text, time_stamp, file_name, file_path, file_size)
                      VALUES(:user_id, :user_name, :user_nick, :message_name, :message_text, :time_stamp, :file_name, :file_path, :file_size)";
    $this->execute($sql, array(
                        ':user_id'=>$_SESSION['user']['id'],
                        ':user_name'=>$_SESSION['user']['user_name'],
                        ':user_nick'=>$_SESSION['user']['nick'],
                        ':message_name'=>$_POST['message_name'],
                        ':message_text'=>$_POST['message_text'],
                        ':time_stamp'=>$regist_day,
                        ':file_name' => $file_name,
                        ':file_path' => $file_path,
                        ':file_size' => $file_size
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
                              time_stamp   = :time_stamp,
                              file_name    = :file_name,
                              file_path    = :file_path,
                              file_size    = :file_size
                              where id = $PageValues[0]";
    $this->execute($sql, array(
                        ':modify_message_name'=>$PageValues[1],
                        ':modify_message_text'=>$PageValues[2],
                        ':time_stamp'         =>$regist_day,
                        ':file_name'          =>$PageValues[3],
                        ':file_path'          =>$PageValues[4],
                        ':file_size'          =>$PageValues[5]
                      ));

  }

  // 글삭제 하기
  public function deleteBoard($pageNum){
    $sql = "delete from status where id = $pageNum";
    $this->execute($sql);

  }

  // 페이지번호를 받아서 해당 페이지의 정보들을 반환
  public function returnPageValues($pageNum){
    $sql = "select * from status where id = $pageNum";

    $pageValues = $this->getAllRecord($sql);

    return $pageValues;
  }

}
?>
