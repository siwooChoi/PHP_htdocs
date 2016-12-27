<?php

  $arr = [46,2,65,1,12,35,67,34,14,6];

    echo "sort 하기 전 &nbsp: &nbsp";
  foreach($arr as $i) {
    echo "{$i} &nbsp &nbsp";
  }

  $count = 10;
  $temp =  0;

  for($x = $count - 2; $x >= 0; $x--) {

    for($y = 0; $y <= $x; $y++) {
      if($arr[$y] > $arr[$y+1]){
          $temp = $arr[$y];
          $arr[$y] = $arr[$y+1];
          $arr[$y+1] = $temp;
      }
    }
  }

  echo "<br><br>";
  echo "sort 한 후 &nbsp: &nbsp";
foreach($arr as $i) {
  echo "{$i} &nbsp &nbsp";
}






 ?>
