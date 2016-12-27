<?php

// 받아오는 값
// $_SESSION['userid'] = $userid;
// $_SESSION['username'] = $username;
// $_SESSION['usernick'] = $usernick;
// $_SESSION['userlevel'] = $userlevel;
	session_start();

	$scale=5;			// 한 화면에 표시되는 글 수
	// include "../lib/dbconn.php";
	require_once "../DBManager.php";

	$dbo = connect();

	$sql = "select * from memo order by num desc";

	try{
		// $dbo->prepare($sql, array())
		$stt = $dbo->prepare($sql, [PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
		$stt->execute();
		$total_record = $stt->rowCount();

	} catch(PDOException $e){
		exit("Error: {$e->getMessage()}");
	}

				// 아래 : 12 ~ 18라인
	// $result = mysql_query($sql, $connect);
	// 	//   아래 : 글의 갯수를 알아내는 것.
	// $total_record = mysql_num_rows($result); // 전체 글 수

	//아래: 전체 페이지 수($total_page) 계산.  페이징을 하기 위한 코드. 중요도 높음
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	if(!isset($_GET['page']))
		$page = 1;
	else {
		$page = $_GET['page'];
	}

		// 아래 : 31~ 45
	// if (!$_page)                 // 페이지번호($page)가 0 일 때
	// 	$page = 1;              // 페이지 번호를 1로 초기화


	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;

	$number = $total_record - $start;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/memo.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<div id="wrap">
  <div id="header">
    <?php include "../lib/top_login2.php"; ?>
  </div>  <!-- end of header -->

  <div id="menu">
	<?php include "../lib/top_menu2.php"; ?>
  </div>  <!-- end of menu -->

  <div id="content">
	<div id="col1">
		<div id="left_menu">
<?php
			include "../lib/left_menu.php";
?>
		</div>
	</div>
	<div id="col2">
		<div id="title">
			<img src="../img/title_memo.gif">
		</div>

		<div id="memo_row1">
    	<form  name="memo_form" method="post" action="insert.php">
				<div id="memo_writer"><span >▷ <?= $_SESSION['usernick'] ?></span></div>
				<div id="memo1"><textarea rows="6" cols="95" name="content"></textarea></div>
				<div id="memo2"><input type="image" src="../img/memo_button.gif"></div>
		</form>
		</div> <!-- end of memo_row1 -->

<?php
	try{	// end 는 175라인 쯤

		// $results = $stt ->fetchAll();		// 95 or 96 라인에서 사용하려고 만든 것.

													// 아래  &&  여기 중요(이게 글 수가 5가 아니라
									// 만약 1이나 2라면  이쪽을 만족하지 못하고 반복문이 종료된다.)
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {// end는 173라인 쯤
					//  $row = $reuslts[$i];		  		// 방법(1)
				//  $row = pdo_data_seek($results, $i);		// 방법(2)
		 					/*위쪽 pdo_data_seek : 미리 함수를 만들어 놓고 이렇게
		 						라이브러리처럼 쓸 수도 있다.  DBManager.php 에 함수 만들어놓음
		 		 				그런데 만약 stt에 10000개의 쿼리가 있다고 가정하면 result에도 10000개다.
				 				서버의 과부하가 걸릴 가능성도 고려해보아야 한다.*/

	$row = $stt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_ABS, $i);	// 방법(3)
				/* 위쪽 FETCH_ORI_ABS :  라이브러리처럼 2만개까지는 아니더라도 데이터를 관리절약하는 방법임.*/

      // mysql_data_seek($result, $i);
      // $row = mysql_fetch_array($result);

	  $memo_id      = $row['id'];
	  $memo_num     = $row['num'];
    $memo_date    = $row['regist_day'];
	  $memo_nick    = $row['nick'];

	  $memo_content = str_replace("\n", "<br>", $row['content']);
	  $memo_content = str_replace(" ", "&nbsp;", $memo_content);
					/*str_replace : select에서 가져온 필드가 content, 첫번째꺼를 두번째꺼로 바꾼다.
						\n 을 웹페이지 상의 <br>로 엔터키처리, 공백키를 $nbsp로 바꾸어 스페이스처리.*/
?>
		<div id="memo_writer_title">
		<ul>
		<li id="writer_title1"><?= $number ?></li>
		<li id="writer_title2"><?= $memo_nick ?></li>
		<li id="writer_title3"><?= $memo_date ?></li>
		<li id="writer_title4">
		      <?php
					if($_SESSION['userid']=="admin" || $_SESSION['userid']==$memo_id)
			          echo "<a href='delete.php?num=$memo_num'>[삭제]</a>";
				/*삭제 버튼이 나타나고, 클릭하면 delete.php가 실행이 되어 $memo_num에 해당하는 것을 삭제*/
			  ?>
		</li>
		</ul>
		</div>
		<div id="memo_content"><?= $memo_content ?>
		</div>
		<div id="ripple">
			<div id="ripple1">덧글</div>
			<div id="ripple2">
<?php

			$sql = "select * from memo_ripple where parent=:memo_num";

			$stt = $dbo->prepare($sql, [PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
			$stt->execute([':memo_num'=>$memo_num]);

	    // $sql = "select * from memo_ripple where parent='$memo_num'";
	    // $ripple_result = mysql_query($sql);


		//while ($row_ripple = mysql_fetch_array($ripple_result) )		//아래쪽 while의 원본
		while ($row_ripple = $stt->fetch(PDO::FETCH_ASSOC))
		{
			$ripple_num     = $row_ripple['num'];
			$ripple_id      = $row_ripple['id'];
			$ripple_nick    = $row_ripple['nick'];
			$ripple_content = str_replace("\n", "<br>", $row_ripple['content']);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple['regist_day'];
?>
				<div id="ripple_title">
				<ul>
				<li><?= $ripple_nick ?> &nbsp;&nbsp;&nbsp; <?= $ripple_date ?></li>
				<li id="mdi_del">
					<?php
						if($userid=="admin" || $userid==$ripple_id)
				            echo "<a href='delete_ripple.php?num=$ripple_num'>삭제</a>";
					?>
				</li>
				</ul>
				</div>
				<div id="ripple_content"> <?= $ripple_content ?></div>
<?php
		}

				// 아래쪽이 댓글입력 래그
?>
				<form  name="ripple_form" method="post" action="insert_ripple.php">
				<input type="hidden" name="num" value="<?= $memo_num ?>">
				<div id="ripple_insert">
				    <div id="ripple_textarea">
						<textarea rows="3" cols="80" name="ripple_content"></textarea>
						<!-- name="ripple_content"   <ㅡ 이 이름으로 insert_ripple.php 로 넘어간다.-->

					</div>
					<div id="ripple_button"><input type="image" src="../img/memo_ripple_button.png"></div>
				</div>
				</form>

			</div> <!-- end of ripple2 -->
  		    <div class="clear"></div>
			<div class="linespace_10"></div>
<?php
		$number--;
	}// 95라인쯤의 for end

}// 87라인 쯤의 try
 catch(PDOException $e) {
	 exit("DB에러: {$e->getMessage()}");
 }
	//  mysql_close();
	$dbo = NULL;
?>
						<!-- 이전 클릭버튼 나중에 구현 할 것.	아래줄의
						echo "<a href='memo.php?page=$i'> $i </a>";   를 활용하면 됨
					  첫번째 페이지에서는 링크가 안걸리고, 두번째 페이지부터 링크가 걸려야됨
					   다음  클릭버튼은 맨마지막 링크 안걸려야됨 -->
			<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp;
<?php
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{
			// 해당하는 페이지로 이동하는 링크가 걸리도록 되어 있다.
			echo "<a href='memo.php?page=$i'> $i </a>";
		}
   }
?>
			&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶</div>
		 </div> <!-- end of ripple -->
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
