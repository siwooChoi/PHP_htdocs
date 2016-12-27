<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      function array_val($array){   // 1> call by value
        $array[0] *= 2;
        $array[1] *= 2;
      }

      function array_ref(&$array){  // 2> call by reference
        $array[0] *= 2;
        $array[1] *= 2;
      }

      $a = 10;
      $b = 20;
      //$array = array($a, &$b);
      $array = array(&$a, &$b);

      array_val($array);

      print $a. "<br>";
      print $b. "<br>";
      print_r($array);

      print "<br><br><br>";

      $c = 10;
      $d = 20;
      //$array = array($c, &$d);
      $array2 = array($c, $d);

      array_ref($array2);

      print $c. "<br>";
      print $d. "<br>";
      print_r($array2);

    ?>
  </body>
</html>
