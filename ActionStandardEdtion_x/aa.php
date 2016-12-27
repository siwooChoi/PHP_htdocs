if(isset($_POST["userid"])){


      // textbox,DB존재 ID,PW 일치 시  1출력되는지 확인 (맞으면1 아니면0 출력)
  $result = $stt->rowCount();

  // if 입력ID, PW  와  DB의 아이디,비번 맞는지 비교
  // true  : 로그인 성공,  아이디&비번  쿠키or세션 저장
  // flase : 로그인 실패,  다시 로그인 화면으로 돌아가기
  if($result == 1){
    $this->id = $_POST["userid"];
    $this->pw = $_POST["userpw"];

    $_SESSION["logon"] = $this->id;
  }
}
