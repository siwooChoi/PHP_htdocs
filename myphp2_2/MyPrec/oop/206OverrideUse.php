<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

      require_once "205CustomerSub.php";

      $obj1 = new Customer();
      $obj1->show("미스터킴", "헬반");

      $obj2 = new Customer();
      $obj2->show("미스터킴의 동생", "헬반도 국가");


    ?>
  </body>
</html>
