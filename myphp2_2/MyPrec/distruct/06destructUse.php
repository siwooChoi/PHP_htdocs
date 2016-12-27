<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "05destructEx.php";
      $obj = new DestructCls(200,1.234);  // num1, num2 에 각각 200,  1.234 가 들어감
      // 소멸자의 호출 : (서버관점에서 봤을 떄 php의종료) 종료 되었을 떄.

      print "num1 = {$obj->num1}"."<br>";
      print "num2 = {$obj->num2}"."<br>";


     ?>

  </body>
</html>
