<?php
  $list = array("애플" => 300, "바나나" => 130, "오렌지" => 200);


      // 에러가 난다.
  // file_put_contents("fruits.txt", $list);
  // $read_list = file_get_contents("fruits.txt");
  // echo $read_list["바나나"];
      // php에서 데이터(객체)를 파일에 저장할 떄는
      // 시리얼라이즈(serialize) 를 해서 저장해야 하고
      // 시리얼라이즈 하여 저장한 데이터는 읽어서 사용하려면
      // 언시리얼라이즈(unserialize) 해야 한다.

      $serial_list = serialize($list);
      // $보존데이터 = serialize($원본데이터);
      file_put_contents("fruits.txt", $serial_list);
      $read_list = file_get_contents("fruits.txt");
      $unserialize_list = unserialize($read_list);
      // $읽을려했던데이터 = unserialize($읽어온데이터);
      // $원본데이터 = unserialize($보존데이터);

      echo "시리얼예제 : ".$unserialize_list["바나나"]."<br />";


      $jsondata = json_encode($list);
      // http://php.net/manual/kr/function.json-encode.php
      file_put_contents("fruits.txt", $jsondata);
      $readData = file_get_contents("fruits.txt");
      $json_decode_data = json_decode($readData);

      echo "JSON예제 : ".$json_decode_data->{"애플"}."<br />";
?>






























<?php//호옹이?>
