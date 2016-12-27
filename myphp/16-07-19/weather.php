<?php
  $weatherDataUrl = "http:/weather.livedoor.com/forecast/rss/area/400010.xml"
  $s=trim(@file_get_contents($weatherDataUrl));
  // http://php.net/manual/kr/function.trim.php         trim : 공백을 지워준다.
  // @에러 발생시 오류 메시지 표시 안함
  // echo $s;

  $xml = simplexml_load_string($s);  // xml을 읽어서 string으로 바꿔준다.


  //print_r($xml);


  $title = $xml->channel->title;

  echo "※ $title  <br /> ";
  // php내에서 xml객체에 요소 접근법
  //  $XML객체명->엘리먼트명->엘리먼트명
  // 만약 안에있는게 배열이라면
  //(ex item배열의 4번째를 가져올떄),  $xml->channel->item[4];

  foreach($xml->channel->item as $val){
    $val_title = strval($val->title);
    echo " - $val_title<br/>";

  }

?>
