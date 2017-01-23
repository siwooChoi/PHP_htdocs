<link href="/css/test1_css.css" type="text/css" rel="stylesheet">
<div class="back">
  test폴더 내에 있는 test2.php<br>
  테스트2 <br>
  <?php

  ini_set("display_errors", "1");
  $fname=$_FILES['photofile']['name']; //file name
  $fpath = './img/board'.$fname;

  // $uploadfile = $uploaddir.basename($_FILES['photofile']['tmp_name']);

  echo '<pre>';

  if (move_uploaded_file($_FILES['photofile']['tmp_name'], $fpath)) {

     echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";

  } else {

      print "파일 업로드 공격의 가능성이 있습니다!\n";

  }

  echo '자세한 디버깅 정보입니다:';

  print_r($_FILES);

  print "</pre>";

  ?>

  <img src="file/?$_FILES['userfile']['name']?>' />










</div>
