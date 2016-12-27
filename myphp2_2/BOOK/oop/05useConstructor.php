<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

      require_once "04constructEx.php";

      $price = new Calculate(0.08); // "04constructEx.php" 안의 class를 객체로 만듬.
      print "세금포함 금액은 {$price->taxCalc(1000)}엔 입니다.";

   ?>

  </body>
</html>
