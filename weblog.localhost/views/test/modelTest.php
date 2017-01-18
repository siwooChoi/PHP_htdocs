user 테이블의 rowCount() 결과를 보여주는 화면 ---- Model사용 TEST ----<br>

<p style="text-align:center" ><a href="<?php print $base_url; ?>/test/testPDO"> 클릭 </a></p>

<?php
  // if(isset($this->valueArray[0])){
  //   echo $this->escape($this->valueArray[0]);
  // }

  // var_dump($parameters);
  if(empty($parameters[0])){
    echo "아직 클릭을 안해서 SQL을 실행 안했음. 클릭하면 SQL실행!";
  }else{
    echo $parameters[0];
  }
  // echo $this->rowCountValue;
  // $this->rowCountValue;
  // echo $this->example;
  echo "<br><br>";
  echo "위에  '  2  '   가 나오면 성공한것이다.";
?>
