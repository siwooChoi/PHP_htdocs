<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "221interfaceEx3.php";

      $obj = new SubC2();

      $obj->Multi(50);
      $obj->show();

      $obj->Divi(200);
      $obj->show();


    ?>
  </body>
</html>
