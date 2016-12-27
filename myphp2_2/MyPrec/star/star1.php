<?php


  echo "<table width='300px' height='300px' border=1 solid black>";

  $number = 5;

  for($x = 0; $x <= $number; $x++) {
    echo "<tr>";
    for($y = 0; $y <= $number; $y++) {

      if($y + $x < $number) {
          echo "<td align='center'>&nbsp</td>";
      } else {
          echo "<td align='center'>*</td>";
      }

    }
    echo "</tr>";
  }

  echo "</table>";


 ?>
