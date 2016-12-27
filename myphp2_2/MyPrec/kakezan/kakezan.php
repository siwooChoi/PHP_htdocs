<?php

  echo "<style>
      #backC { background:green; }
      </style>";


  echo "<table width='800px' height='650px' border=1 black solid>";

  for($x = 0; $x <= 9; $x++){     // 행
    echo "<tr>";

      for($y = 2; $y <= 9; $y++){   // 행에 존재하는 열 (칸 수)

        if($x == 0) {
          echo "<td id='backC'  align='center'> $y 단 </td>";
        } else {
          echo "<td align='center'>". $y . " x " .  $x . " = " .  $y*$x."</td>";
        }
      }
    echo "</tr>";

  }






 ?>
