<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once "303overloadMex1.php";

    $obj = new SampleC();
    // $obj->member("김영진");
    // $obj->member("김영진", "이영진");
    // print $obj->member();

    $obj->test("김영진");
    print $obj->test() ."<br>";
    $obj->test("김영진", "이영진");
    print $obj->test();


    ?>
  </body>
</html>
