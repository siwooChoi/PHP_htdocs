<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "301overrideEx.php";

      $obj = new SamCls();
      $obj->m1 = '김영진';
      $obj->id = 1000;

      print $obj->m1."<br>";
      print $obj->id."<br>";

      $obj->disp();

    ?>
  </body>
</html>
