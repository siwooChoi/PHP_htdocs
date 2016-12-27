<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "07staticEx.php";

      // $this->pi  같은 경우에만 $를 적지않는다.
      print "파이값 = ". StaticCls1::$pi . "<br>";
      print "원의면적 = ". StaticCls1::getCircleArea(100) . "<br>";

     ?>
  </body>
</html>
