<?php
  session_start();

  $id=$_SESSION['userid'];
  $name=$_SESSION['username'];
  $time=$_SESSION['time'];

  //$time = date('Y-m-d(H:t:s)', $time);
?>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h3> 등록된 세션의 사용 </h3>
    <table border='1px' width='300px'>
      <tr>
        <td align='center'>아이디</td>
        <td align='center'>이름</td>
        <td align='center'>시각</td>
      </tr>
      <tr>
        <td align='center'><?=$id?></td>
        <td align='center'><?=$name?></td>
        <td align='center'><?=$time?></td>
      </tr>
    </table>
  </body>
</html>
