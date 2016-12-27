<?php
  session_start();

  echo "세션 시작<p>";

  $_SESSION['userid'] = "csw";
  $_SESSION['username'] = "슈";
  $_SESSION['time'] = time();  // <--- 현재 시각

  echo "세 개의 세션 변수 등록 <br>";
  echo $_SESSION['userid']."<br>";
  echo $_SESSION['username']."<br>";
  echo $_SESSION['time']."<br>";

 ?>
