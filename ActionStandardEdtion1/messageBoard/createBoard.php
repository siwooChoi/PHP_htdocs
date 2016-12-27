

  <link href="./css/Boardcss.css" type="text/css" rel="stylesheet">

  <div class="memo_row1" id="memo_row1" style="margin-left:20%; margin-top:5%">
    <form  enctype="multipart/form-data" action="./controlor/controlSupport.php?create_content=yes" method="post" >
      <div id="memo_writer"><span >▷ <?= $_SESSION['userNick'] ?></span></div><br>

      글 제목 : <input style="width:500px" type="text" name="boardname"><br><br>
      글 내용 <br>
      <textarea rows="12" cols="100" name="content"></textarea><br>


        <table style="margin-left:35%">
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
                <input type="submit" value="작성하기">
              </td>

    </form>

          <form class="" action="./index.php?mode=menu2view" method="post">
              <td>
                <input type="submit" value="취소">
              </td>
         </tr>
     </table>
         </form>
  </div> <!-- end of memo_row1 -->
