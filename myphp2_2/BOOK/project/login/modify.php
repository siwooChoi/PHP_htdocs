<meta charset="utf-8">
<?php
  $hp = $_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];
  $email = $_POST['email1']."@".$_POST['email2'];
  // 등록날짜는 시스템시간으로  "년월일 (시:분:초)"  로 받는다.
  $regist_day = date("Y-m-d (H:i:s)");
      //교과서에는 방문자의 주소.  라는게 있지만 ip를 저장하는 곳이 없다. 입력하지 않아도 된다.

    // $id = $_POST['id'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $nick = $_POST['nick'];
    $userid = $_SESSION['userid'];
    // $level = 9;

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
      $pdo = connect();


         $sql = "update member set pass=:pass, name=:name,";
         $sql.= "nick=:nick, hp=:hp, email=:email, regist_day=:regist_day";
         $sql.= "where id=:i";

         $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));

         $stt->execute(
            array(
              ':id'=>$userid,
              ':pass'=>$pass,
              ':name'=>$name,
              ':nick'=>$nick,
              ':hp'=>$hp,
              ':email'=>$eamil,
              ':regist_day'=>$regist_day,

            )
         );

        // if($result){ // 참: 값이 제대로 들어갔다.
        //   echo "회원가입 완료";
        // }

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
