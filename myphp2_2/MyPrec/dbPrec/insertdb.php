<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<?php
  $connect = mysql_connect("localhost", "root", "0000");
  mysql_select_db("syu_db", $connect);

  $sql = "insert into biz_card (num, name, company, tel, hp, address)";
  $sql.= "values (1, '원선우', '미래전자', '031-276-1829', ";
  $sql.= "'010-5723-2833', '경기도')";

  $result = mysql_query($sql);

  if($result) {
    echo "레코드 insert 완료";
  } else {
    echo "레코드 insert 에러, 실패 ";
  }

  mysql_close($connect);



?>
