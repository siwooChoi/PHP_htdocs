<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php

  require_once "02oopTest.php";

  $obj = new Test();
  $obj->calc(10,5);

  // 이번에는 echo 말고 print를 써보자.
  print "프로퍼티 값은 {$obj->number}입니다.";



 ?>

  </body>
</html>
