<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "403InstanceEx1.php";

      print '$a = new TestTest()를 실행 <br>';
      $a = new TestTest();

      print '$b = $a를 실행 <br>';
      $b = &$a;

      print 'unset($a)를 실행 <br>';
      unset($a);

      print 'unset($b)를 실행 <br>';
      unset($b);


    ?>
  </body>
</html>
