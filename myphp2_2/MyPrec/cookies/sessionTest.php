<?php

  session_start();

  $_SESSION['name'] = '김영진';
  $_SESSION['age'] = 25;

  echo "<pre>";

  print_r($_SESSION);

  unset($_SESSION['age']);

  print_r($_SESSION);

  echo session_id()."<br />";

  session_destroy();

  echo "세션파괴 : ". session_id()."<br />";

  echo "</pre>";

 ?>
