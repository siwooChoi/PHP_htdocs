<?php

  $a = setcookie('userid', 'root', time()+6000);
  $b = setcookie("username", "홍길동", time()+60);


  if($a && $b){
    echo "쿠키 'userid'와 'username' 생성<br />";
    echo "쿠키 'username'은 60초(1분)간 지속됨";
  }



 ?>
