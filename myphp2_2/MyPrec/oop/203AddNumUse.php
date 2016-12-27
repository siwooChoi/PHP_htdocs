<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      require_once "202AddNumSub.php";
      // require_once "202AddNumber.php";

      $obj = new AddNumSub();
      $obj->add(30);
      $obj->record();

      $obj->add(100);

      print "num = {$obj->getNum()} <br>";
      print "recocrd = {$obj->getRecord()} <br>";


     ?>

  </body>
</html>
