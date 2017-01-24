

  <link href="/css/writeContent_css.css" type="text/css" rel="stylesheet">

<p style="text-align:center">글 작성</p>

  <div class="create_textbox" id="memo_row1">
    <form  enctype="multipart/form-data" action="<?php echo $base_url; ?>/board/fileupload" method="post">

      <div id="memo_writer"><span >▷ <?php echo $_SESSION['user']['user_name']." ( ".$_SESSION['user']['nick']." ) ";
         ?></span></div><br>

      글 제목 : <input style="width:500px" type="text" name="message_name" ><br><br>
      글 내용 <br>

      <textarea rows="12" cols="100" name="message_text"><?php
        if(!isset($messaged)){
          echo "";
        } else{
          echo $messaged;
        }
  ?></textarea><br>


        <table style="margin-left:35%">
            <tr>
                <td>
                  <!-- <form enctype="multipart/form-data" action="<?php //echo $base_url;?>/board/fileupload" method="POST"> -->

                      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                      <input class="myfile" type="file" name="myfile" placeholder="Photo">
                      <!-- <input type="submit" name="userfile" value="upload"/> -->
                  <!-- </form> -->
                </td>
            </tr>

          <tr>
              <td>
                <!-- 빈 공간 -->
              </td>
              <td>

                <input class="upb1" type="submit" value="작성하기">

              </td>

    </form>

          <form class="" action="<?php echo $base_url; ?>/board/contentBoard" method="post">
              <td>
                <input class="upb2" type="submit" value="취소">
              </td>
         </tr>
     </table>
         </form>
  </div>   <!-- end of memo_row1 -->
