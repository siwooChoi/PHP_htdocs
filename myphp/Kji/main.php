<?php

$savefile = dirname(__FILE__)."/msg.txt";
$master_pw = "aaa";

if(isset($_POST['msg'])){
  $pass = isset($_POST['pass]'])?$_POST['pass']:"";


  file_put_contents($savefile,$_POST['msg']);
  echo "저장완료";
//  header("Location:"주소");  화면전환을 위한 코드(?)

} else {
  $self = $_SERVER['SCRIPT_NAME'];
  echo <<<FORM


    <textarea name="msg" cols="60" rows="10">
    </textarea><br/>
<form method="POST" action='File_Menu.php'>
  <input type="submit" value="기록"/>
</form>

<form method="POST" action='File_Menu.php'>
  <input type="submit" value="기록"/>
  </form>

FORM;

}
?>
