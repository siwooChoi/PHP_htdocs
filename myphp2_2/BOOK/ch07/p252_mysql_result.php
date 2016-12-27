<meta charset="utf-8">
<?php
  $connect = mysql_connect("localhost", "root", "0000");
  $db_con = mysql_select_db("syu_db", $connect);

  $sql = "select * from membership where address like '%서울%' order by age;";
  $result = mysql_query($sql, $connect);

  $records = mysql_num_rows($result);
  $fields = mysql_num_fields($reuslt);
  $number = 1;


?>

<h2> mysql_result()를 이용한 데이터 읽기 </h2>
<table width="800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor = "#cccccc">일련번호</td>
    <td bgcolor = "#cccccc">아이디</td>
    <td bgcolor = "#cccccc">이름</td>
    <td bgcolor = "#cccccc">우편번호</td>
    <td bgcolor = "#cccccc">주소</td>
    <td bgcolor = "#cccccc">전화번호</td>
    <td bgcolor = "#cccccc">나이</td>
  </tr>

<?php
  for($i = 0; $i < $records; $i++){
    echo "<tr>";
    echo "<td> $number </td>";

      for($j = 0; $j < $fields; $j++){
        echo "<td> $data </td>";
      }
      echo "</tr>";
      $number++;
  }
  mysql_close();
 ?>
</table>
