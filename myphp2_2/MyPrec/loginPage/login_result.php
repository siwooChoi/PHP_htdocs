<?php

session_start();
  // POST로 값 넘어왔는지 확인하기
  if(isset($_POST['loginId_c'])){
    $id_of_c_post = $_POST['loginId_c'];
    $pw_of_c_post = $_POST['loginPw_c'];
  } else if(isset($_POST['loginId_s'])){

    $id_of_s_post = $_POST['loginId_s'];
    $pw_of_s_post = $_POST['loginPw_s'];
  }
      // echo $id_of_post." ".$pw_of_post;  // 값 넘어오는지 확인.

  // DB import
  require_once "DBManager.php";

  try{
    // DB연결
    $dbo = connect();
    // DB 값 출력
            // textbox의 입력ID와 DB존재ID 확인하기 위한 작업(1)
      // $sql = "select * from userlist where userid = :id_of_post;";

      // 쿠키 일때 실행될 페이지
    if(isset($_POST['loginId_c'])){
        $sql = "select * from userlist where userid = :id_of_post and userpw = :pw_of_post";

        $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':id_of_post'=>$id_of_c_post, ':pw_of_post'=>$pw_of_c_post));

            // textbox,DB존재 ID,PW 일치 시  1출력되는지 확인 (맞으면1 아니면0 출력)
        $result = $stt->rowCount();

      // if 입력ID, PW  와  DB의 아이디,비번 맞는지 비교
      // true  : 로그인 성공,  아이디&비번  쿠키or세션 저장
      // flase : 로그인 실패,  다시 로그인 화면으로 돌아가기
      if($result == 1){
      setcookie("userId_c", $id_of_c_post, time()+15);
?>

  <html>
    <div>
        <h2>
          로그인 성공, 로그인은 15초간 유지됩니다.<br />
          (쿠키 페이지에서 접속했습니다.)<br /><br />
          환영합니다! <b><font color='blue'> <?php echo $id_of_c_post; ?></font> </b> 님!
        </h2>
    </div>
  </html>
<?php
          // echo "<form action='login_cookie.php' method='post' >";
          // echo "<input type='submit' value='지금 로그아웃하기' name='Clicked_ok'>";
          // echo "</form>";
      } else {
          echo "로그인 실패<br />";
          echo "<form action='login_cookie.php' method='post' >";
          echo "<input type='submit' value='확인' name='Clicked_ok'>";
          echo "</form>";
      }
    } // isset id_쿠키 End

      // 세션일 때 실행 될 코드
    else {
          $sql = "select * from userlist where userid = :id_of_post and userpw = :pw_of_post";
          $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
          $stt->execute(array(':id_of_post'=>$id_of_s_post, ':pw_of_post'=>$pw_of_s_post));

              // textbox,DB존재 ID,PW 일치 시  1출력되는지 확인 (맞으면1 아니면0 출력)
          $result = $stt->rowCount();

      if($result == 1){

        $_SESSION["userId_s"] = $id_of_s_post;
?>

    <html>
      <div>
        <h2>
        로그인 성공<br />
        (세션 페이지에서 접속했습니다.)<br />
        환영합니다! <b><font color='blue'> <?php echo $id_of_s_post; ?> </font> </b> 님!

        <h2>
      </div>
    </html>

<?php
          // echo "<form action='./login_session.php' method='post' >";
          // echo "<input type='submit' value='로그아웃' name='Clicked_ok'>";
          // echo "</form>";
      } else {
          echo "로그인 실패<br />";
          echo "<form action='./login_session.php' method='post'>";
          echo "<input type='submit' value='확인' name='Clicked_ok'>";
          echo "</form>";
      }

    } // isset id_세션 End

    // DB끊기
    $dbo = NULL;
 }catch(PDOException $e) {
  exit("에러발생 {$e->getMessage()}");
}


 ?>
