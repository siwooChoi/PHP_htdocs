<meta charset="utf-8">

<?php

    //setcookie('쿠키이름', '쿠키값');
    //쿠키에 값이 설정되어 있으면 true
  if( isset($_COOKIE['userId_c']) ){
    echo "현재 로그인 중입니다.";
//
//     echo "로그아웃 하셨습니다.";
//
//  ?> <!--
//     <form action='login_cookie.php' method='POST'>
//       <input type="submit" value="확인" name='Clicked_logout'>
//     </form>
//    -->
   <?php
//
//   $clicked_ok = $_POST['Clicked_ok'];
//
//     // $clicked_logout = NULL;
//     if(isset($clicked_ok)){
//       setcookie("userId_c", null);
//     }
//
//
  }
    // 쿠키에 값이 설정되어있지 않으면 false
  else {
    echo "<form action='./login_result.php' method='POST'>";
    echo "<table border='1' solid black>";
    echo "<tr><td> ID : &nbsp <input type='textbox' name='loginId_c'><br />";
    echo "PW : <input type='password' name='loginPw_c'><br />";
    echo "<input type='submit' value='로그인'>";
    echo "</td></tr>";
    echo "</table>";
    echo "</form>";
  }


 ?>
