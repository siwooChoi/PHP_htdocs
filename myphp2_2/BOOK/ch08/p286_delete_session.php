<?php
  session_start();

  unset($_SESSION['userid']);
  unset($_SESSION['username']);
  unset($_SESSION['nowtime']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3> 세션 삭제 </h3>
    <table border='1px' >
      <tr>
        <td>아이디</td>
        <td>이름</td>
        <td>시각</td>
      </tr>
      <tr>
        <td><?=$_SESSION['userid'] ?> &nbsp;</td>
        <td><?=$_SESSION['username'] ?> &nbsp; </td>
        <td><?=$_SESSION['nowtime'] ?> &nbsp; </td>
      </tr>
    </tabel>
  </body>
</html>
