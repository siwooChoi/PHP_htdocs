<?php
  echo "<style>
      #nothing {background:gray;}
      #star {background:yellow;}    </style>";

  echo "<table width='300px' height='300px' border=1 solid black>";

  $number = 15;

  for($x = 0; $x < $number; $x++) {
    echo "<tr>";
    for($y = 0; $y < $number; $y++) {

      if($x < ($number/2)) {
        if($y + $x < ($number/2)-1 || ($number/2) < $y - $x ) {
            echo "<td id='nothing' align='center'>&nbsp</td>";
          } else {
            echo "<td id='star' align='center'>*</td>";
          }
      }
      else {
        if($x - $y > ($number/2) || $x + $y > ($number/2)*3-1) {   // $number 9일때 $x는 5부터
            echo "<td id='nothing' align='center'>&nbsp</td>";
          } else {
            echo "<td id='star' align='center'>*</td>";
          }
      }
    }
    echo "</tr>";
  }
  echo "</table>";
 ?>
