<?php
  //   // 데이터베이스 연결
  // $connect = mysql_connect("localhost", "root", "0000");
  //
  //   // 데이터베이스 선택
  // mysql_select_db("syu_db", $connect);

  require_once 'DBManager.php';

  try{
    $dbo = connect();
  } catch(PDOException $e){
    exit("에러 발생 : {$e -> getMessage()}");
  }



    // 데이터 입력 모드
  if(isset($_GET['mode']) && $_GET['mode']== "insert")
  {
    $getName = $_POST['name'];
    $getSub1 = $_POST['sub1'];
    $getSub2 = $_POST['sub2'];
    $getSub3 = $_POST['sub3'];
    $getSub4 = $_POST['sub4'];
    $getSub5 = $_POST['sub5'];

    $sum = $getSub1 + $getSub2 + $getSub3 + $getSub4 + $getSub5;
    $avg = $sum/5;

    // $sql = "insert into stud_score(name, sub1, sub2, sub3,
    //                               sub4, sub5, sum, avg) values";
    // $sql.= "('$getName', $getSub1, $getSub2, $getSub3,
    //           $getSub4, $getSub5, $sum, $avg);";
    //
    // $result = mysql_query($sql, $connect);

    $sql = "insert into stud_score(name, sub1, sub2, sub3, sub4, sub5, sum, avg) values";
    $sql.= "(:name, :getSub1, :getSub2, :getSub3, :getSub4, :getSub5, :sum, :avg);";

      try{
        $stt = $dbo -> prepare($sql, array(
          PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL
        ));
        $result = $stt->execute(array(
          ':name'=>$getName,
          ':getSub1'=>$getSub1,
          ':getSub2'=>$getSub2,
          ':getSub3'=>$getSub3,
          ':getSub4'=>$getSub4,
          ':getSub5'=>$getSub5,
          ':sum'=>$sum,
          ':avg'=>$avg
        )
      );//execute종료

      if($result){
        print '레코드 삽입완료';
      } else{
        print '레코드 삽입실패';
      }

    }catch(PDOException $e){

    }//catch종료
  }//if종료

//------------------------------------------------------------------------------------------
    // require_once 'DBManager';
    //
    // try{
    //   $dbo = connect();
    //
    //   if($_GET['mode'] == "insert"){
    //
    //   }
    //
    //
    // } catch(PDOException $e) {
    //     exit("에러발생: {$e->getMessage()}");
    // }

?>

  <meta charset="utf-8">
  <h3> 1) 성적 입력 하기</h3>

  <form action="p260_score_list_pdo.php?mode=insert" method='post'>
  <table width="920" border="1" cellpadding="5">
    <tr>
      <td>이름 : <input type="text" size="6"name="name"> &nbsp;
         과목1 : <input type="text" size="3" name="sub1"> &nbsp;
         과목2 : <input type="text" size="3" name="sub2"> &nbsp;
         과목3 : <input type="text" size="3" name="sub3"> &nbsp;
         과목4 : <input type="text" size="3" name="sub4"> &nbsp;
         과목5 : <input type="text" size="3" name="sub5"> &nbsp;
      </td>
    <td align="center">
      <input type="submit" value="입력하기">
    </td>
   </tr>
 </table>
 </form>


  <h3> 2) 성적 출력 하기 </h3>
  <p><a href = "p260_score_list_pdo.php?mode=big_first">[성적순 정렬]</a>
     <a href = "p260_score_list_pdo.php?mode=small_first">[성적 역순 정렬]</a></p>


    <!-- 제목표시 시작 -->
  <table width="720" border="1" cellpadding="5">
  <tr align = "center" bgcolor = "#eeeeee">
      <td>번호</td>
      <td>이름</td>
      <td>과목1</td>
      <td>과목2</td>
      <td>과목3</td>
      <td>과목4</td>
      <td>과목5</td>
      <td>합계</td>
      <td>평균</td>
      <td>&nbsp;</td>
    </tr>
    <!-- 제목표시 끝-->
<?php
      // select문 수행  ( select 명령 저장 )
  if(isset($_GET['mode']) && $_GET['mode']== "big_first"){   // <-- 성적순 정렬 (내림차순)
   $sql = "select * from stud_score order by sum desc;";
 } else if(isset($_GET['mode']) && $_GET['mode']== "small_first"){  // <-- 성적순 정렬 (오름차순)
   $sql = "select * from stud_score order by sum;";
 } else {
   $sql = "select * from stud_score";
 }

    // $result = mysql_query($sql);
    try{
      $stt = $dbo->prepare($sql,
      array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL)
    );
    $stt->execute();
    }catch(PDOExcepton $e){

    }

 $count = 1;

 // 데이터베이스 데이터 출력 시작

 //while($row = mysql_fetch_array($result))
  while($row = $stt->fetch(PDO::FETCH_ASSOC))   //ASSOC <---연관배열
 {

   $avg = $_POST['avg'] = round($row['avg'], 1);
   $num = $_POST['num'] = $row['num'];



   echo ("<tr align = 'center'>
      <td>$count</td>
      <td>$row[name]</td>
      <td>$row[sub1]</td>
      <td>$row[sub2]</td>
      <td>$row[sub3]</td>
      <td>$row[sub4]</td>
      <td>$row[sub5]</td>
      <td>$row[sum]</td>
      <td>$avg</td>
      <td><a href='p266_score_delete_pdo.php?num=$num'>[삭제]</a></td>
    </tr>
   ");

   $count++;
 }
 // 데이터베이스 데이터 출력 완료

  //mysql_close();    //데이터베이스의 접속 종료
  $dbo = NULL;
 ?>

</table>


















<!---->
