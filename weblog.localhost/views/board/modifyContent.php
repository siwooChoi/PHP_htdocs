<body>
  <link href="/css/modifyContent_css.css" type="text/css" rel="stylesheet">

 <p style="text-align:center"> 글 수정</p>
  <div class="memo_row_modi">
    <form  enctype="multipart/form-data" action="<?php echo $base_url;?>/board/modifyUploadBoard?page=<?php echo $content[0]['id']?>" method="post" >
      <div id="memo_writer"><span >▷<?php echo $content[0]['user_name']." ( ".$content[0]['user_nick']." )"; ?> </span></div><br>
      글 번호 : <?php echo $content[0]['id'];?><br>
      글 제목 : <input style="width:500px" type="text" name="modify_message_name" value="<?php echo $content[0]['message_name'];?>" ><br><br>
      글 내용 <br>
      <textarea rows="12" cols="100" name="modify_message_text"><?php echo $content[0]['message_text']; ?></textarea><br>
      <!-- <input type="hidden" name="modify_message_text" value="<?php //echo $content[0]['message_text']; ?>"> -->


        <table style="margin-left:35%" >
            <tr>
                <td>
                  <form>
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                      <input name="userfile" type="file" />

                  </form>
                </td>
            </tr>

          <tr>
              <td>
                <!-- 빈 공간 -->
              </td>
              <td>
                <input class="modi_modi" type="submit" value="수정하기">
              </td>

    </form>

          <form class="" action="<?php echo $base_url;?>/board/contentBoard" method="post">
              <td>
                <input class="modi_can" type="submit" value="취소">
              </td>
         </tr>
     </table>
         </form>
  </div> <!-- end of memo_row1 -->
</body>
