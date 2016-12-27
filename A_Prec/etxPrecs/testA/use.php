<?php

    require_once "./testA.php";


  echo "use.php이다.<br>";

  $obj = new A();



  if(isset($_GET['getValue'])){
    $value1 = $_GET['getValue'];

    if($_get['start'])
    print "스타트 라고 받았다";
  } else{
    print "값받은게없다";
  }


 ?>
