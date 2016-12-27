<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <a href="./ex_get.php?mode=login">로그인</a>
  <a href="./ex_get.php?mode=logout">로그아웃</a>
    <a href="./ex_get.php?mode=myname"></a>
      <a href="./ex_get.php?mode=myname">이름</a>
<hr>
    <div>
      get방식으로 받은 변수를 호출
      <table style="border:1px solid green;">
        <tr><td>

      <?php
        if( isset($_GET['mode']) ){


            if( $_GET['mode'] == "login"){
              print "로긘";
            } else if ($_GET['mode'] == "logout"){
              print "로가웃";
            } else {
              print "{$_GET['mode']}";
            }

        }

      ?>
    </td></tr>
      </table>
    </div>
  </body>
</html>
