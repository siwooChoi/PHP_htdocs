<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>인치 에서 센티 로</title>
      <style>
        body{
          font-size: 12px;
          background-color: #cccccc;
        }
      </style>
  </head>
  <body>
    <h1>표준 몸무게와 현재 몸무게 비교하는 프로그램</h1>


    <?php

      if(isset($_GET["value1"]) && isset($_GET["value2"])){
        $value1 = $_GET["value1"];
        $value1 = floatval($value1);

        $value2 = $_GET["value2"];
        $value2 = floatval($value2);

        $result = ($value2 - 100) * 0.9;    // 표준몸무게 : (현재 키 - 100) * 0.9
        $result = floatval($result);

        echo "<div>";
        echo "표준 몸무게는 {$result}이며, 현재 몸무게는 {$value1}입니다.";
        echo "</div>";

      } else {
        $self = $_SERVER["SCRIPT_NAME"];

        echo "<form action='$self' method='GET'>";
        echo "<pre>           몸무게                         키 </pre>";
        echo "<input tpye='text' name='value1' value='' />";
        echo "<input tpye='text' name='value2' value='' />";
        echo "<input type='submit' value='전송' />";

        echo "</form>";

      }










     ?>

  </body>
</html>
