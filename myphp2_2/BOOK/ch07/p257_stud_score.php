<meta charset="utf-8">
<?php
// $connect = mysql_connect("localhost", "root", "0000");
// $db_con = mysql_select_db("syu_db", $connect);
//
// $sql = "create table stud_score (";
// $sql .= "num int not null auto_increment,";
// $sql .= "name varchar(12),";
// $sql .= "sub2 int,";
// $sql .= "sub1 int,";
// $sql .= "sub3 int,";
// $sql .= "sub4 int,";
// $sql .= "sub5 int,";
// $sql .= "sum int,";
// $sql .= "avg float,";
// $sql .= "primary key(num))";
//
// $result = mysql_query($sql, $connect);
//
// if($result){
//   echo "데이터베이스 테이블 'stud_score' 가 생성되었습니다.";
// } else {
//   echo "데이터베이스 테이블생성 에러";
// }
//
//   mysql_close();

  //------------------------------------------------------------

  require_once 'DBManager.php';

try{
  $dbo = connect();
  $sql = "create table stud_score (";
  $sql .= "num int not null auto_increment,";
  $sql .= "name varchar(12),";
  $sql .= "sub1 int,";
  $sql .= "sub2 int,";
  $sql .= "sub3 int,";
  $sql .= "sub4 int,";
  $sql .= "sub5 int,";
  $sql .= "sum int,";
  $sql .= "avg float,";
  $sql .= "primary key(num));";

  $stt = $dbo -> prepare($sql,
      array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
//------------------------------------ ★


      $result = $stt->execute();

      if($result){
        echo "성공";
      } else {
        echo "실패";
      }
//-------------------------------------
  $dbo = NULL;
} catch(PDOException $e){
      exit("에러발생: {$e->getMessage()}");
}



?>
