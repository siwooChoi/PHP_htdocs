<meta charset="utf-8">
<?php
  $hp = $_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];
  $email = $_POST['email1']."@".$_POST['email2'];
  // 등록날짜는 시스템시간으로  "년월일 (시:분:초)"  로 받는다.
  $regist_day = date("Y-m-d (H:i:s)");
      //교과서에는 방문자의 주소.  라는게 있지만 ip를 저장하는 곳이 없다. 입력하지 않아도 된다.

    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $nick = $_POST['nick'];
    $level = 9;

/*
  // 공식처럼 외워야 됨.
    require_once "../DBManager.php";

    try{
      $pdo = connect();


    }catch(PDOException $e){
      exit("에러 발생 : {$e->getMessage()}");
    }
*/

    require_once "../DBManager.php";

    try{
      $dbo = connect();

      $sql = "select * from member where id=:id";

      $stt = $dbo->prepare($sql,
        array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));

      $stt->execute(array(':id'=>$id));  // 위쪽에서 $id = $_POST['id'] 했기 때문에 $id를 쓴다.

      $result = $stt->rowCount();

      //  history.go(-1);   또는  history.back;
      if($result){
        echo(" <script>
          window.alert('해당 ID가 존재합니다.');
          history.go(-1);
        </script>");
          exit;
      } else{
         $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level)";
         $sql.= "values(:id, :pass, :name, :nick, :hp, :email, :regist_day, 9)";

         $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));

         $stt->execute(
            array(
              ':id'=>$id,
              ':pass'=>$pass,
              ':name'=>$name,
              ':nick'=>$nick,
              ':hp'=>$hp,
              ':email'=>$email,
              ':regist_day'=>$regist_day
            )
         );

        // if($result){ // 참: 값이 제대로 들어갔다.
        //   echo "회원가입 완료";
        // }
      }
      $dbo = NULL;
      echo( // location.href='../index.php'; 처럼 주소를 적어주면
            // history.go(-1);   또는  history.back;  을 대신할 수 있다.
            // 또는 header() 함수와도 바꿔 쓸 수 있다.
        "<script>
          location.href='../index.php';
        </script>"
      );

    }catch(PDOException $e){
      exit("에러 발생 : {$e->getMessage()}");
    }




?>
