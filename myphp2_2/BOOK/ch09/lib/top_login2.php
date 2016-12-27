<div id="logo">
  <a href="../index.php">
    <img src="../img/logo.gif" border="0">
    <!-- 경로는 require된 소스파일의 경로를 따른다. -->
  </a>
  </div>
<div id="moto">
    <img src="../img/moto.gif">
 </div>
<div id ="top_login">

<?php

  // $_SESSION['userid'] = 'syu';
  // $_SESSION['usernick'] ='chesyu';
  // $_SESSION['userlevel'] = '10';

  // unset($_SESSION['userid']);
  // unset($_SESSION['usernick']);
  // unset($_SESSION['userlevel']);

  if(!isset($_SESSION['userid']))  // <-- (userid가 있지 않으면)
  {
?>
    <a href="../login/login_form.php">로그인</a> |
    <a href="../member/member_form.php">회원가입</a>

<?php
  }
  else
  {
?>
<?=$_SESSION['usernick']?> (level:<?=$_SESSION['userlevel']?>) |
  <a href="../login/logout.php">로그아웃</a> |
  <a href="../login/member_form_modify.php">정보수정</a>
<?php
  }


 ?>
</div>
