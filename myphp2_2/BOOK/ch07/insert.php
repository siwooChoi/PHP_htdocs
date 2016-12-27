<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<?php
  // $connect = mysql_connect("localhost", "root", "0000");
  // mysql_select_db("syu_db", $connect);
  //
  // $sql = "insert into biz_card (num, name, company, tel, hp, address)";
  // $sql.= "values (1, '원선우', '미래전자', '031-276-1829', ";
  // $sql.= "'010-5723-2833', '경기도 용인시')";
  //
  // $result = mysql_query($sql);
  //
  // if($result) {
  //   echo "레코드 insert 완료";
  // } else {
  //   echo "레코드 insert 에러, 실패 ";
  // }

  // mysql_close($connect);

//------------------ 위쪽이 일반적인 sql문, 아래쪽이 pdo 사용---------------------

  require_once 'DBManager.php';   //  <--- import 같은 효과

  try{
    $dbo=connect();
    $sql = "insert into biz_card (num, name, company, tel, hp, address)";
    $sql .= "values(:num, :name, :company, :tel, :hp, :address)";
    $stt = $dbo -> prepare($sql,
        array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
    $result = $stt->execute( array(
        ':num'=>1,
        ':name'=>'원선우',
        ':company'=>'미래전자',
        ':tel'=>'031=123=1234',
        ':hp'=>'010=532=5322',
        ':address'=>'경기도 용인시'
        )
      );
      if($result) {
        echo "레코드 insert 완료";
      } else {
        echo "레코드 insert 에러, 실패 ";
      }

      $dbo = NULL;
  } catch(PDOException $e){
        exit("에러발생: {$e->getMessage()}");
  }




?>
