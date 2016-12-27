<?php


    // $a = setcookie('php_cookie', 'php쿠키의 값');
    //
    // echo "php_cookie 를 만들었음<br><br>";


    // $call_cookie = $_COOKIE['php_cookie'];

    // echo "cookie : $call_cookie<br>";

    $result = setcookie('ppp', 'Cool~', time()+30);
    if($result){
      echo "쿠키생성";
    } else{
      echo "쿠키실패";
    }

    echo "$_COOKIE('ppp')";

 ?>
