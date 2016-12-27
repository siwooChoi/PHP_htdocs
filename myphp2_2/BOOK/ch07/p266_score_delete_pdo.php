<?php


// $connect = mysql_connect("localhost", "root", "0000");
// mysql_select_db("syu_db", $connect);

//--------------------------------------------------중요
  require_once 'DBManager.php';


//--------------------------------------------------

  // 필드 num이 $num값을 가지는 레코드 삭제
  // mysql_query($sql, $connect);

  $num = $_GET['num'];
  //$sql = "delete from stud_score where num = $num";

  try{
    $dbo = connect();

    $sql = "delete from stud_score where num = :num";
    $stt = $dbo -> prepare($sql,
      array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL)
    );
    $stt ->execute(array(':num'=>$num));
    $dbo = NULL;

  } catch(PDOException $e){
    exit("에러 발생 : {$e -> getMessage()}");
  }

  // mysql_close($connect);



  // score_list.php 로 돌아감
  Header("Location:p260_score_list_pdo.php");


 ?>
