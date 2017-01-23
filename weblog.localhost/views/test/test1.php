<link href="/css/test1_css.css" type="text/css" rel="stylesheet">

<!-- 테스트1 <br> -->
<div class='back'>
  test폴더 내에 있는 test1.php
  <br>
  테스트1 <br>
  <!-- <a href="<?php print $base_url; ?>/test/test2">test2</a>

<form action="<?php $base_url?>/test/testPrint" method="post">
  <input type="text" name="value1"> <br>
  <input type="text" name="value2"> <br> -->

<hr>
  <!-- <input type="submit" value="전송">

  <form enctype="multipart/form-data" action="1.php" method="POST">

   <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

   <input name="userfile" type="file" />

   <input type="submit" value="upload" />

  </form> -->

<hr>

<form name="form_name" method="post" action="<?php echo $base_url; ?>/product/fileupload" encType="multipart/form-data">
	<label>Photo</label>
	<input type="file" name="myfile" placeholder="Photo">
	<button type="submit">업로드</button>
</form>

<img src="<?php echo $base_url;?>/img/board/test.png">

</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</div>
