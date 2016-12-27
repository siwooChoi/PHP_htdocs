<?php

    $tel = "010-1234-5678";

    echo $tel."<br>";

    $tel1 = substr($tel, 4);
    echo "{$tel1}<br>";
    $tel1 = substr($tel, 1, 1);
    echo "{$tel1}<br><br>";

    $tel2 = strlen($tel);
    echo "{$tel2} strlen <-- String length<br><br>";

    $tel3 = explode("-", $tel);
    $tel3_length = sizeof($tel3);
    echo $tel3[2]."<br><Br>";

    echo "tel3_length의 길이는 : $tel3_length<br>";

    $count = 0;

    foreach($tel3 as $x){
      // $count++;

      echo "{$x}";


      // if($count != $tel3_length){echo " ~ ";}
      // else {  }
    }


 ?>
