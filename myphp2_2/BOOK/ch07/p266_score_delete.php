<?php


$connect = mysql_connect("localhost", "root", "0000");
mysql_select_db("syu_db", $connect);



  // 필드 num이 $num값을 가지는 레코드 삭제


  $num = $_GET['num'];

  $sql = "delete from stud_score where num = $num";

  mysql_query($sql, $connect);

  mysql_close($connect);

  // score_list.php 로 돌아감
  Header("Location:p260_score_list.php");


 ?>
