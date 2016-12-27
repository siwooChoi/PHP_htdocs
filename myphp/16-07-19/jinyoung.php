<style>
  h3 {background-color:red; color:white; padding:8px; }
</style>
<?php
// 동경의 날씨를 나타내는 RSS
$weather_rss = "http://weather.livedoor.com/forecast/rss/area/400010.xml";
// 날씨 예보를 메모해 둘 파일명
$savefile = "comment.log";
// 처리를 분기시킴. 요청에 m변수값이 있는지 여부에 따라
$m = isset($_GET["m"]) ? $_GET["m"] : "";
if ($m == "write") {
    write_comment();
} else {
    show_weather();
}
// 날씨와 코멘트 폼을 표시
function show_weather() {
    global $weather_rss;
    $info = load_log();
    // 오늘의 날짜 태그
    $tag = date("Y-m-d");
    if (empty($info[$tag])) { // 오늘의 날씨 예보를 취득할껀가?
    //  http://php.net/manual/kr/function.empty.php
    // http://php.net/manual/kr/function.trim.php
        // RSS데이터를 Web으로부터 다운로드
        $s = trim(@file_get_contents($weather_rss));
        // '@'가 앞에 있으면 오류메시지를 표시하지 않겠다는 의미
        $list = array();
        // XML을 파싱함.
        $xml = simplexml_load_string($s);
        // http://php.net/manual/kr/function.simplexml-load-string.php
        foreach ($xml->channel->item as $item) {
            $list[] = strval($item->title);
            // http://php.net/manual/kr/function.strval.php
        }
        $info[$tag] = array("yohou"=>$list);
        save_log($info);
    }
    // 표시함.
    $self = $_SERVER["SCRIPT_NAME"];
    $info = array_reverse($info);
    // http://php.net/manual/kr/function.array-reverse.php
    foreach ($info as $key => $item) {
        $yohou_h = htmlspecialchars(implode("\n", $item["yohou"]));
        // http://php.net/manual/kr/function.implode.php
        // http://php.net/manual/kr/function.explode.php
        // http://php.net/manual/kr/function.split.php
        // 날씨 예보를 표시
        echo "<h3>$key</h3>";
        echo "<pre>$yohou_h</pre>";
        // 코멘트 폼
        echo "<form action='$self'>";
        echo "<input type='hidden' name='m' value='write' />";
        echo "<input type='hidden' name='tag' value='$key' /> ";
        echo "코멘트:";
        echo "<input type='text' name='memo' value='' />";
        echo "<input type='submit' value='쓰기' />";
        echo "</form>";
        // 코멘트를 표시
        $comment = isset($item["comment"]) ? $item["comment"] : array();
        foreach($comment as $row) {
            $row_h = htmlspecialchars($row);
            echo "<div>→{$row_h}</div>";
        }
    }
}
// 코멘트를 써넣음
function write_comment() {
    $info = load_log();
    $tag = isset($_GET["tag"]) ? $_GET["tag"] : "";
    $memo = isset($_GET["memo"]) ? $_GET["memo"] : "";
    if (empty($info[$tag]["comment"])) { $info[$tag]["comment"] = array(); }
    $info[$tag]["comment"][] = $memo;
    save_log($info);
    header("location: ".$_SERVER["SCRIPT_NAME"]);
    //http://php.net/manual/kr/function.header.php
}
// 데이터를 읽어 들임
function load_log() {
    global $savefile;
    $info = array();
    if (file_exists($savefile)) { // 로그 파일을 읽어들임
        $info = unserialize(file_get_contents($savefile));
    }
    return $info;
}
// 데이터를 보존함
function save_log($info) {
    global $savefile;
    file_put_contents($savefile, serialize($info));
}
?>
