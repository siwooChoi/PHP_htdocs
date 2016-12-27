<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      require '11capsuleEx.php';

      $obj = new CapsuleCls();
      // $obj->radius = 10;   // private라서 접근불가능함.

      $obj->setRadius(10);
      $obj->setHeight(50);

      print "반지름 : {$obj->getRadius()} <br>";
      print "높 이 : {$obj->getHeight()} <br>";

      print "원뿔부피 : {$obj->calcVolume()} <br>";



    ?>

  </body>
</html>
