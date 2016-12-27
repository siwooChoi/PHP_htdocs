<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>D-day 만들어보기</p>



    <?php
      date_default_timezone_set("Asia/Seoul");

      $now = time();
      $self = $_SERVER["SCRIPT_NAME"];

      echo "오늘 날짜 : ";
      show_today(date("Y/m/d", $now));   // 오늘날짜
      echo "출발하는 날짜 : ";
      show_today(date("Y/m/30", $now));  //  30일(출발하는 날짜)
      echo "D-day : ";
      show_Dday(date("d", $now));        // D-day.



      echo "<br><br><br>";
        echo "<form action='D-day.php' method='get'>";
            echo "<table>";
            echo "<tr><td>";
      echo "날짜 입력 : ";

      echo "<input type = 'text' name='yearValue' style='width:50px; text-align:right' />년";
      echo "<input type = 'text' name='monthValue' style='width:50px; text-align:right' />월";
      echo "<input type = 'text' name='dayValue' style='width:50px; text-align:right' />일";
          echo "</td><td>";

      echo "&nbsp&nbsp <input type = 'submit' value = '확인' / >";
          echo "</td>";
            echo "</table>";

              echo "</form>";
      if(isset($_GET["yearValue"])   && isset($_GET["monthValue"])   &&  isset($_GET["dayValue"])    ){

        setDays();

      } else {
        echo "날짜를 입력 하십시오.";
      }



      echo "<br><br><br>";



    function show_today($str){
        //$str = htmlspecialchars($str);
        echo $str."<br/>";
    }

    function show_Dday($str){
        $str = htmlspecialchars($str);
        //$str = intval($str);
        echo "$str";
        // $result = 1 * $str;
        // $dday = (30-$result);
        // echo $dday;
    }

    function setDays(){
      $yyyy = $_GET["yearValue"];
      $yyyy = intval($yyyy);
      $mm = $_GET["monthValue"];
      $dd = $_GET["dayValue"];

      echo "입력한 날짜는 : ";
      show_today(date("Y/m/d",strtotime($yyyy-$mm-$dd)));

    }

?>




  </body>
</html>
