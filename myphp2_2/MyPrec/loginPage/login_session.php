<meta charset="utf-8">

<?php
  session_start();

//$_SESSION['세션이름', '값'];

  if( isset($_SESSION['userId_s']) ){
    echo "현재 로그인 중입니다.<br>";
     // 아래 주석을 풀어서 세션을 제거해야 다시 로그인화면으로 넘어갈 수 있습니다.
    session_destroy();
    echo "로그아웃 하셨습니다.<br>";

?>
  <!-- <form action='login_session.php' method='POST'>
    <input type="submit" value="확인">
  </form> -->
<?php
  // $clicked_ok = $_POST['Clicked_ok'];
  // if(isset($clicked_ok)){
  //   session_destroy();
  // } else{
  //
  // }
}

  else {

    echo "<form action='./login_result.php' method='POST'>";
    echo "<table border='1' solid black>";
    echo "<tr><td> ID : &nbsp <input type='textbox' name='loginId_s'><br />";
    echo "PW : <input type='password' name='loginPw_s'><br />";
    echo "<input type='submit' value='로그인'>";
    echo "</td></tr>";
    echo "</table>";
    echo "</form>";
}

 ?>
