<?php
  require_once "instanceOfEx.php";

  $obja = new A();
  // clone $a = $obja;
  $a = &$obja;

  if($obja instanceof A){
    echo "맞음<br>";
  }

  $obja->c();
  $obja->p();



  if(defined('aaa')){
    echo "aaa로 정의된게 있음<br><br>";
  }
  $obja->p();
  $obja->qqq();
  $a->p();

  $obja = new B();

  $a->b_p();
  $a->


  echo "<br>";




?>
