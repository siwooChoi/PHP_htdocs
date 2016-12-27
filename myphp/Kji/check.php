<?php

  $inputId = $_POST['UserId'];

  $master_id = "choi";

  if($inputId == $master_id){
    goPage();
  } else {
    backPage();
  }

  function backPage(){
    echo <<<LOG
    <form action="login.php">
    {$inputId}는 사용할 수 없는 아이디 입니다
      <input type='submit' value='뒤로 돌아가기'>
    </form>
LOG;
  }

  function goPage(){
    echo <<<GOMAIN
    <form action="File_Menu.php">

      <input type='submit' value='main으로 가기'>
    </form>
GOMAIN;
  }


    ?>
