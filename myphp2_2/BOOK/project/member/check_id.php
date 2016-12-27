<meta charset="utf-8">

<?php
  //if(!$id){   // book
  if(!isset($_GET['id'])){
    echo("아이디를 입력하세요.");
  }

  // 입력이 제대로 됬을 때 else문이 실행 됨.
  else{
    // include "../lib/dbconn.php";   // book
    require_once "../DBManager.php";

    try{
      $dbo = connect();

      $sql = "select * from member where id=:id";   // 플레이스 홀더를 잡아놨음

      $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));  // <--외울 것

      // 플레이스홀더를 잡는다. id 의 값은 $_GET['id'] 이다.
      $stt->execute(array(':id'=>$_GET['id']));

      $result = $stt ->rowCount();

      // $result=mysql_query($sql, $connect);  // book
      // $num_record=mysql_num_rows($result);  // book



      // if($um_record){  // book
      if($result){

        echo "아이디가 중복됩니다.<br />";
        echo "다른 아이디를 사용하세요.<br />";


        echo "<input type='button' value='확인' onclick='window.close()'>";
      }

      else{

        echo "사용가능한 아이디입니다.";
        echo "<input type='button' value='확인' onclick='window.close()'>";
      }

      $dbo = NULL;

  }catch(PDOException $e){
    exit("에러발생 {$e->getMessage()}");
  }

    // mysql_close();  // book   <-- 이거 대신 dbo의   $dbo = NULL 이다.
  }


 ?>
