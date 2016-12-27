<meta charset="utf-8" />

<?php

  $movie = $_POST['movie'];
  $book =  $_POST['book'];
  $shop =  $_POST['shop'];
  $sport = $_POST['sport'];

  echo "아이디       : {$_POST['id']}<br>";
  echo "이름         : {$_POST['name']}<br>";
  echo "비밀번호     : {$_POST['passwd']}<br>";
  echo "비밀번호확인 : {$_POST['passwd_confirm']}<br>";
  echo "성별         : {$_POST['gender']}<br>";
  echo "휴대번호         : {$_POST['phone1']} - {$_POST['phone2']} - {$_POST['phone3']}<br>";
  echo "주소         : {$_POST['address']}<br>";
  echo "영화감상         : {$movie}<br>";
  echo "독서         : {$book}<br>";
  echo "쇼핑         : {$shop}<br>";
  echo "운동         : {$sport}<br>";
  echo "자기소개         : {$_POST['intro']}<br>";
  echo "제목(hidden 타입에서 전달) : {$_POST['title']}<br>";


 ?>
