<?php
  session_start();

  $time = date('Y-m-d(H:t:s)', $time);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3> 등록된 세션의 사용 </h3>
    <table>
      <tr>
        <td>아이디</td> <td>이름</td> <td>시각</td>
      </tr>
      <tr>
        <td><?= $userid ?></td>
        <td><?= $username ?></td>
        <td><?= $time ?></td>
      </tr>
  </body>
</html>
