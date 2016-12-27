<?php
  session_start();
  require_once "./DBManager.php";


      // fetch 로 ['컬럼']에 해당하는 값 찾기 Ex
  // $_SESSION['userid'] = 'csw';
  // $dbo = connect();
  //
  //
  //   $sql = "select * from member where id = :id";
  //   $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
  //   $stt->execute(array(':id'=>$_SESSION['userid']));
  //   $row = $stt->fetch();
  //
  //   echo $row['id'];
  //   echo $row['pass'];
  //
  //   echo "aaa";

    // fetchAll 로 해당하는 라인에 있는 값 찾기 Ex
// $sql = "select * from member";
// $stt = $dbo->prepare($sql);
// $stt->execute();
// $rowCount = $stt->rowCount();
// $row = $stt->fetchAll();
// for($i = 0 ; $i<$rowCount;$i++){
//   echo $row[$i]['id']."<br>";
//   echo $row[$i]['pass']."<br>";
//   echo $row[$i]['name']."<br>";
//   echo $row[$i]['nick']."<br>";
//   echo $row[$i]['hp']."<br>";
//   echo $row[$i]['email']."<br>";
//   echo $row[$i]['regist_day']."<br>";
//   echo $row[$i]['level']."<br>";
//
//   echo "------------------------------<br>";
// }
 ?>
