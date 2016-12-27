<?php

echo "<table border=1 solid black>";
  for($x = 2; $x <= 9; $x++){
    echo "<tr><td align='center'> $x  단 </td><tr>";
    echo "<tr><td></td></tr>"; // ~단 밑에 보기 편하게 공백칸 넣은 것


    for($y = 1; $y <= 9 ; $y++){
      echo "<tr><td align='center'>";
      echo  "$x x $y = ".$x*$y;
      echo "</td><tr>";

      if($y >= 9) {
        echo "<tr><td>------------------</td></tr>";
      }
    }
    echo "</td></tr>";

  }
  echo "</table>";


 ?>
