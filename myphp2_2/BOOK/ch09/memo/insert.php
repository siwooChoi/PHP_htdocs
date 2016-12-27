<?php session_start(); ?>
<meta charset="utf-8">
<?php

require_once "../DBManager.php";

$dbo = connect();

	if(!isset($_SESSION['userid'])) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;

	}

	if(!isset($_POST['content'])) {
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장


		// 이 5~6줄이나 되는 코드는 왜 있을까... SESSION에 아이디, 닉네임 저장해놨으니
	// include "../lib/dbconn.php";       // dconn.php 파일을 불러옴
			//  SESSION으로 불러 쓰는게 더 효율적일것 같다.
  //   $sql = "select * from member where id='$userid'";
  //   $result = mysql_query($sql, $connect);
	// $row = mysql_fetch_array($result);
	//
	 $name 		= $_SESSION['username'];
	 $nick 		= $_SESSION['usernick'];
	 $userid	=	$_SESSION['userid'];
	 $content =	$_POST['content'];

	$sql = "insert into memo (id, name, nick, content, regist_day) ";
	$sql .= "values('$userid', '$name', '$nick', '$content', '$regist_day')";

	//mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	$stt = $dbo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
	$stt->execute();
	//mysql_close();                // DB 연결 끊기
	$dbo = null;
	echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
		 ";

	// 헤더 :  서버에서 클라이언트로 보낼때  주소를 바꾼다.
	// location : 클라이언트에서  서버로 요청할 때 주소를 바꾼다.
	  // 실행의 주체가 서버,클라이언트  어느쪽에 두느냐에 따라 다르다.
		// 깊에 파고들면 다른 점을 알 수 있다.
?>
