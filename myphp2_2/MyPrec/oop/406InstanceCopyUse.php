<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "405InstanceCopyEx.php";

      $a = new Member();

      $a->id = 101;
      $a->name = "킴";
      $b = clone $a;  // 인스턴스의 복사
      // $b= $a;   // 참조 복사
        // Member 인스턴스1 <- $a,  Member인스턴스2 <-$b
      print "<br>";

      var_dump($a==$b);
      var_dump($a===$b);

      print_r($a);
      print "<br><br>";
      print_r($b);

      // $b->id = 201;
      // $b->name = "팍";

      // print_r($a);
      // print "<br><br>";
      // print_r($b);


    ?>

  </body>
</html>
