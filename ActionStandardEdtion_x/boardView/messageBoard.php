

  <!-- <link href="./css/Boardcss.css" type="text/css" rel="stylesheet"> -->
  <?php

    // 컨텐츠에 관한 정보를 세션으로 받아온다.

      $row = $_SESSION['content_row'];
      $rowCount = $_SESSION['content_rowCount'];

    // 각 세션의 이름을 다르게해서 세션마다 해당하는 내용을 저장한다.
    for($i = 0 ; $i<$rowCount; $i++){
      $_SESSION["c_num_$i"] = $row[$i]["num"];
      $_SESSION["c_id_$i"] = $row[$i]["id"];
      $_SESSION["c_name_$i"] = $row[$i]["name"];
      $_SESSION["c_nick_$i"] = $row[$i]["nick"];
      $_SESSION["c_content_$i"] = $row[$i]["content"];
      $_SESSION["c_registday_$i"] = $row[$i]["regist_day"];
    }
  ?>


  <form  action="./index.php?mode=createBoard" method="post">
    <input class="sbbutton" type="submit" value="글 작성">
  </form>

  <div class="maintab">
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

    $count = 0;   // 페이징을 위한 게시글 숫자카운트

      for($i = 0 ; $i<$rowCount; $i++){     ?>



      <tr>
        <td style="width:10%" class="boardtable">
          <?php echo $_SESSION["c_num_$i"]; ?>
        </td>
        <td style="width:20%">
          <?php echo $_SESSION["c_id_$i"]; ?>
        </td>
        <td style="width:50%">
          <a style="color:white" href="./index.php?messagenum=<?php echo $_SESSION["c_num_$i"] ?>">  <?php echo $_SESSION["c_name_$i"]; ?> </a>
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

    </tr><td/>
<br><br><br>

  </table>
  <?php

echo $count;



  ?>
