
<style>
    h3 {background-color : red; color : white; padding : 8px;}
</style>

<?php

$weatherUrl = "http://weather.livedoor.com/forecast/rss/area/400010.xml";
$saveFile="comment.log";

$m = isset($_GET['m']) ? $_GET['m'] : "";

switch($m) {
  case "write" : writeComment(); break;
  case "show" : display(); break;
  default : display(); break;
}

  function display() {
    global $weatherUrl;
    $info = load_log();
    $tag = date("Y-m-d");

    if(empty($info[$tag])){   // empty 변수의 내용이 비어있는지 검사.
                  //http://php.net/manual/kr/function.empty.php
        $s=trim(@file_get_contents($weatherUrl));
        $xml = simplexml_load_string($s);
        $list = array();

        foreach($xml->channel->item as $val){
          $list[] = strval($val->title);    // 차례대로 배열에 저장된다. 이게 기억이 안나면 push로 밀어넣으면 됨.
    }
    $info[$tag] = array("예보"=>$list);

    save_log($info);
  }

  // 본격적으로 화면 출력
  $info  = array_reverse($info);
  $self = $_SERVER['SCRIPT_NAME'];

  foreach($info as $key=>$val){
    $yohou_h = htmlspecialchars(implode("\n", $val["예보"]));



    echo "<h3>$key</h3>";
    echo "<pre>$yohou_h</pre>";
    echo "<form action='$self'>";
    echo "<input type='hidden' name='m' value='write' />";
    echo "<input type='hidden' name='tag' value='$key' />";
    echo "코멘트: ";
    echo "<input type='text' name='memo' value='' />";
    echo "<input type='submit' value='쓰기' />";
    echo "</form>";
  }

  $comment = isset($val["comment"]) ? $val["comment"]  : array();
  foreach($comment as $row){
    $row_h = htmlspecialchars($row);
    echo "<div>->{$row_h}</div>";
  }
}
  function load_log() {
    global $saveFile;
    $info = array();
    if(file_exists($saveFile)){
      $info = unserialize(file_get_contents($saveFile));
    }
    return $info;
  }

  function save_log($a) {
    $info = $a;
    global $saveFile;
    file_put_contents($saveFile, serialize($a));
  }


  function writeComment() {
    $info = load_log();
    $tag = isset($_GET["$tag"]) ? $_GET["$tag"] : "";
    $memo = isset($_GET["$memo"]) ? $_GET["$memo"]:"";

    if(empty($info[$tag]["comment"])){
      $info[$tag]["comment"] = array();
    }
    $info[$tag]["comment"][] = $memo;
    save_log($info);

    header("location:".$_SERVER['SCRIPT_NAME']);

  }
?>
