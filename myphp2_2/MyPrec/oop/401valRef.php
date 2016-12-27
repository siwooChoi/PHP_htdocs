<?php

  $a = 10;
  $b = &$a;
  $c = $a;
  $b = 50;

  print $a. "<br>";
  print $b. "<br>";
  print $c. "<br><br>";

  $d = 10;
  $e = 20;
  $num = &$d;
  print $num ."<br><br>";
  $num = &$e;
  $num = 30;

  print $d. "<br>";
  print $e. "<br>";
  print $num. "<br>";



 ?>
