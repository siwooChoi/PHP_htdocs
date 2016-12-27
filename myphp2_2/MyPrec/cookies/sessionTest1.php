<?php

  // setcookie("test1", "테스트1");
  // setcookie("test3", "테스트3");

  session_start();


//  echo "<form action='./sessionTest2.php' method='POST'>";    // 그보다 form  이랑


    $_SESSION["test1"] = "테스트1";
    $_SESSION["test2"] = "123";


    echo "된건가<br>";

    echo "test1  : ".$_SESSION["test1"]." 이다.<br>";
    echo "test2  : ".$_SESSION["test2"]." 이다.<br>";
    // echo "test3  : ".$_COOKIE['test3']."이다.<br>";

//    echo "<input type='submit' value='asdf'>";  // submit 으로 넘기는거 이렇게 하는게 맞는건가...
//  echo "</form>";

 ?>
