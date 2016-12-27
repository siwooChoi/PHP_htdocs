<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "09constEx.php";
      print "클래스 정수(상수) PI = ". ConstCls::PI ."<br>";
      print "원의면적 = ". ConstCls::getCircleArea(100) . "<br>";


     ?>
  </body>
</html>
