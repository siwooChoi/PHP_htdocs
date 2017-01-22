<?php
if(!isset($_SESSION['user']['user_name'])){
  echo "<script>alert('로그인 후 이용하실 수 있습니다..')</script>";
  echo "<script> history.go(-1); </script>";
} else{
  ?>
  <link href="/css/contentBoard_css.css" type="text/css" rel="stylesheet">



  <div style="margin-left:15%; margin-top:7%">
  <!-- <table class="boardtable1" border="1px solid black" width="80%">
  </table> -->

  <table class="inputTextbox">
    <tr><td>
      <input style="text-align:right;" type="text" value="">
    </tr><td/>
<br><br><br>

  </table>

  <table class="boardtable2" border="1px solid black" width="80%"><tr>
    <td style="width:8%; text-align:center">
      글번호
    </td>
    <td style="width:19%; text-align:center">
      작성자
    </td>
    <td style="text-align:center">
      글 제목
    </td>
    <td style="width:18%; text-align:center">
      글 작성 날짜
    </td>
  </tr>
    <?php
    $rowCount = count($content);
      //페이징 하려면...
      // 전체 카운트 필요.
      // 보여주기만 할 갯수카운트 필요. ex)5 <--- 현재의 $rowCount 대신에 5가 들어가야된다.

    $count = 0;   // 페이징을 위한 게시글 숫자카운트

      for($i = 0 ; $i<$rowCount; $i++){     ?>
        <?php if($i == 0){ ?>
        <form  action="<?php echo $base_url; ?>/board/writeContent" method="post">

          <input type="hidden" name="content_number" value="<?php  echo $content[$i]['id']; ?>">
          <input type="hidden" name="content_writerNumber" value="<?php  echo $content[$i]['user_id']; ?>">
          <input type="hidden" name="content_writerName" value="<?php  echo $content[$i]['user_name']; ?>">
          <input type="hidden" name="content_writerNick" value="<?php  echo $content[$i]['user_nick']; ?>">
          <input type="hidden" name="content_name" value="<?php  echo $content[$i]['message_name']; ?>">
          <input type="hidden" name="content_text" value="<?php  echo $content[$i]['message_text']; ?>">
          <input type="hidden" name="content_timeStamp" value="<?php  echo $content[$i]['time_stamp']; ?>">
          <input class="createcon" type="submit" value="글 작성">
        </form>
        <?php } ?>

      <tr>
        <td style="width:8%; text-align:center" class="boardtable">
          <?php
            echo $content[$i]['id'];
            // $_SESSION['numberArray'] = $content[$i]['id'];
          ?>
        </td>
        <td style="width:19%; text-align:center">
          <?php echo $content[$i]['user_nick']; ?>
        </td>
        <td>
          <a href="<?php echo $base_url; ?>/board/openBoard?page=<?php echo $content[$i]['id']; ?>">
            <h4 style="text-align:center"><?php echo $content[$i]['message_name']; ?></h4>
          </a>
        </td>
        <td style="width:18%; text-align:center">
          <?php echo $content[$i]['time_stamp']; ?>

        </td>
      </tr>

    <?php   $count++; //글이 하나 작성 될때마다 카운트++
  } ?>

  </table>

  </div>
  </form>


  <?php
}
  ?>
