<link href="/css/readContent_css.css" type="text/css" rel="stylesheet">

<?php

  if(!isset($_SESSION['user']['user_name'])){
    echo "<script>alert('로그인 후 이용하실 수 있습니다..')</script>";
    echo "<script> history.go(-1); </script>";
  }

 ?>

  <table class='ftable' border="1px solid black">
    <tr>
      <td style="width:20%">
        글 번호 : <?php  echo $content[0]['id'];  ?>
      </td>
      <td style="width:50%">
        글 제목 : <?php  echo $content[0]['message_name'];  ?>
      </td>
      <td style="width:30%">
        작성 시간 : <?php  echo $content[0]['time_stamp'];  ?>
      </td>
      <tr>
        <td style="width:20%">
          <!-- 빈공간 -->
        </td>
        <td style="width:50%">
          <!-- 빈공간 -->
        </td>
      <td style="width:30%">
        글쓴이 : <?php echo $content[0]['user_name']." ";
                      echo "( ".$content[0]['user_nick']." )"; ?>
      </td>
    </tr>
    </tr>
  </table>

  <table  class='ftable2 'border="1px solid black">
<tr>
  <td style="width:15%">
    <!-- 빈공간 -->
  </td>
  <td style="width:70%; height:250px;">
    <?php echo $content[0]['message_text']; ?>
  </td>
  <td style="width:15%">
    <!-- 빈공간 -->
  </td>
</tr>
<tr>
  <td><!-- 빈공간 --></td>
<td>
  <!-- 다운로드파일 목록 -->
  <a href="<?php echo $base_url; ?>/board/pageNumforDownload?page=<?php echo $content[0]['id']; ?>">
  <?php

    echo $content[0]['file_name']
   ?>

</td>
<td><?php
  if($content[0]['file_size'] != ""){
    $file_size = $content[0]['file_size'] / 1025;
  } else{
    $file_size = "없음";
  }
  if($file_size == "0"){
    $file_size = "파일없음";
  }
  echo $file_size;

?>
</td>
</tr>
  </table>

  <table >
    <tr>
      <td style="width:80%">
        <!-- 빈공간 -->
      </td>

      <?php  if(($content[0]['user_name'] == $_SESSION['user']['user_name']) || ($_SESSION['user']['user_name'] == "admin")) {?>
      <td>

    <form  action="<?php echo $base_url; ?>/board/modifyBoard" method="post">
      <input type="hidden" name="content_number" value="<?php  echo $content[0]['id']; ?>">
      <input type="hidden" name="content_writerNumber" value="<?php  echo $content[0]['user_id']; ?>">
      <input type="hidden" name="content_writerName" value="<?php  echo $content[0]['user_name']; ?>">
      <input type="hidden" name="content_writerNick" value="<?php  echo $content[0]['user_nick']; ?>">
      <input type="hidden" name="content_name" value="<?php  echo $content[0]['message_name']; ?>">
      <input type="hidden" name="content_text" value="<?php  echo $content[0]['message_text']; ?>">
      <input type="hidden" name="content_timeStamp" value="<?php  echo $content[0]['time_stamp']; ?>">


      <input class="read_modi" type="submit" value="수정하기">
    </form>
    </td>
    <td>
      <form  action="<?php echo $base_url; ?>/board/deleteBoard" method="post">
        <input type="hidden" name="hidden_Contentdelete" value="<?php echo $content[0]['id']; ?>">
        <input class="read_dele" type="submit" value="삭제하기">
      </form>
    </td>
  <?php }   else { ?>
    <td style="width:13%">
      <!-- 빈공간 -->
    </td>

  <?php }    ?>
    <td>

      <form  action="<?php echo $base_url; ?>/board/contentBoard" method="post">
        <input class="read_back" type="submit" value="목록으로">
      </form>
    </td>
  </tr>
  </table>

<?php
// $_FILES['userfile']['name'];
//   print_r($_SESSION['userfile']);
//   var_dump($_SESSION['userfile']);  echo "<br>";

  echo "<br><br><br>";

?>
