<?php


// $connect = mysql_connect("localhost", "root", "0000");
// mysql_select_db("syu_db", $connect);
  require_once 'DBManager.php';


  $id = $_POST['loginId'];   // <--  textbox로 부터 입력받은 id
  $pw = $_POST['loginPw'];                      //         pw



  try{
    $dbo = connect();

    //.
    //$check_userid = "select userid from userlist where userid = :userid";  // db에서 id 찾기쿼리
    // $stt = $dbo->prepare("SELECT * FROM userlist WHERE userid = :userid AND userpw = :userpw"); //$stt = $dbo -> prepare <--- 쿼리실행준비
    // $stt->bindParam(":userid",$id,PDO::PARAM_STR);
    // $stt->bindParam(":userpw",$pw,PDO::PARAM_STR);
    // $result = $stt ->execute();          //  $stt ->execute  <--- 쿼리실행

    

    $stt = $dbo->prepare("SELECT * FROM userlist");     // 쿼리실행 준비?
    $stt->execute();     //  <--- 적용

    $fail_count = 0;

    $row = $stt->fetch(PDO::FETCH_ASSOC);

      if{

      }

      else if($row['userid'] == $id && $row['userpw'] == $pw){
        echo "success";
      }

      else if(!isset() && isset($row['userpw']))
      {
        echo "아이디 null";
      }

      else {

        $fail_count++;
        // echo "fail";
        if($fail_count == 1)
        echo "fail";
      }

    $fail_count = 0;

  } catch(PDOException $e){
    exit("에러 발생 : {$e -> getMessage()}");
  }

$dbo = NULL;





  // score_list.php 로 돌아감
  // Header("test.php");


 ?>
