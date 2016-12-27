<?php
	session_start();
?>
<meta charset="utf-8">
<?php

	$userid = $_SESSION['userid'];
	$name = $_POST['name'];
	$pass = $_POST['pass'];
  $nick = $_POST['nick'];


	$hp = $_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];
  $email = $_POST['email1']."@".$_POST['email2'];

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

   require_once "../DBManager.php";

	 $dbo = connect();

   $sql = "update member set pass='$pass', name='$name' , ";
   $sql .= "nick='$nick', hp='$hp', email='$email', regist_day='$regist_day' where id='$userid'";

	 $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
	 $stt->execute();

  //  mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

  //  mysql_close();                // DB 연결 끊기

   echo "
	   <script>
	    location.href = '../index.php';
	   </script>
	";

?>
