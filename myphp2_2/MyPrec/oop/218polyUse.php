<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once '216polyEx2.php';
      require_once '217polyEx3.php';

      $obj1 = new Product();
      $obj2 = new Goods();

      $obj1->disp();
      $obj2->disp();

      $obj = new Product();
      $obj->disp();


      $obj = new Goods();
      $obj->disp();

    ?>
  </body>
</html>
