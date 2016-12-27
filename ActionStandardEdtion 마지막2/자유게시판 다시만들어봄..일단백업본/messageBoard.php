

  <link href="./css/Boardcss.css" type="text/css" rel="stylesheet">
  <?php


      // $row = $this->contentValuesArray;
      // $rowCount = $this->C_rowCount;
      // echo $this->contentValuesArray[0]."<br>";
      // echo $this->contentValuesArray[1]."<br>";

    // 각 세션의 이름을 다르게해서 세션마다 해당하는 내용을 저장한다.
    for($i = 0 ; $i<$this->C_rowCount; $i++){
      $this->contentValuesArray[0][$i] = $this->row[$i]["num"];
      $this->contentValuesArray[1][$i] = $this->row[$i]["id"];
      $this->contentValuesArray[2][$i] = $this->row[$i]["name"];
      $this->contentValuesArray[3][$i] = $this->row[$i]["nick"];
      $this->contentValuesArray[4][$i] = $this->row[$i]["content"];
      $this->contentValuesArray[5][$i] = $this->row[$i]["regist_day"];
      // echo "aaaaa".$this->contentValuesArray["c_name_$i"]; //  값이 안나옴...
      // echo "<br><br><br>디스카운터는 ".$this->rowCount."<br><br><br>";   // 16으로 나옴.

    }
  ?>


  <form  action="./index.php?mode=uploadBoard" method="post">
    <input style="margin-left:70%; margin-top:2%"type="submit" value="글 작성">
  </form>

  <div style="margin-left:15%; margin-top:7%">
  <table class="boardtable" border="1px solid black" width="80%">

    <tr>
      <td style="width:10%" class="boardtable">
        글번호
      </td>
      <td style="width:20%">
        작성자
      </td>
      <td style="width:50%">
        글 제목
      </td>
      <td style="width:20%">
        글 작성 날짜
      </td>
    </tr>

  </table>
  <table class="boardtable" border="1px solid black" width="80%">
    <?php

      //페이징 하려면...
      // 전체 카운트 필요.
      // 보여주기만 할 갯수카운트 필요. ex)5 <--- 현재의 $rowCount 대신에 5가 들어가야된다.
      //

    // $count = 0;   // 페이징을 위한 게시글 숫자카운트

      for($i = 0 ; $i<$this->C_rowCount; $i++){?>




      <tr>
        <td style="width:10%" class="boardtable">
          <?php echo $_SESSION["c_num_$i"]; ?>
        </td>
        <td style="width:20%">
          <?php echo $_SESSION["c_id_$i"]; ?>
        </td>
        <td style="width:50%">
          <a style="color:white" href="./index.php?messagenum=<?php $_SESSION["c_num_$i"]; ?>">  <?php $_SESSION["c_name_$i"]; ?> </a>
        </td>
        <td style="width:20%">
          <?php echo $_SESSION["c_registday_$i"]; ?>

        </td>
      </tr>

    <?php   $count++; //글이 하나 작성 될때마다 카운트++
  } ?>

  </table>

  </div>
  </form>

  <table style="margin-top:10%; margin-left:40%;">
    <tr><td>
      <input style="text-align:right;"type="text">
    </tr><td/>
<br><br><br>

  </table>
  <?php

// echo $count;



  ?>
