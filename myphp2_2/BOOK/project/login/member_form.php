<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
   <link rel='stylesheet' type='text/css' href = '../css/common.css' media='all' />
   <link rel='stylesheet' type='text/css' href = '../css/member.css' media='all' />

  <script>

  // function check_id() {
  //   window.open("check_id.php?id="+document.member_form.id.value,"IDcheck",
  //   "left=200, top=200, width=400, height=130, scrollbars=no, resizable=yes");
  // }

  function check_nick() {
    window.open("check_nick.php?nick="+document.member_form.nick.value, "NICKcheck",
    "left=200, width=200, height=60,scrollbars=no, resizable=yes");
  }

  function check_input() {

    // if(!document.member_form.id.value){
    //   alert("아이디를 입력하세요.");
    //   document.member_form.id.focus();
    //   return;
    // }

    if(!document.member_form.pass.value){
      alert("비밀번호를 입력하세요.");
      document.member_form.pass.focus();
      return;
    }

    if(!document.member_form.pass_confirm.value){
      alert("비밀번호 확인을 입력하세요.");
      document.member_form.pass_confirm.focus();
      return;
    }

    if(!document.member_form.name.value){
      alert("이름을 입력하세요.");
      document.member_form.name.focus();
      return;
    }

    if(!document.member_form.nick.value){
      alert("닉네임을 입력하세요.");
      document.member_form.nick.focus();
      return;
    }

    if(!document.member_form.hp2.value || !document.member_form.hp3.value) {
      alert("휴대폰 번호를 입력하세요.");
      document.member_form.hp2.focus();
      return;
    }

    if(!document.member_form.value != document.member_form.pass_confirm.value){
      alert("비밀번호가 일치하지 않습니다. \n다시 입력해주세요.");
      document.member_form.pass.focus();
      document.member_form.passselect();
      return;
    }

    document.member_form.submit();
  }

    function reset_form(){
      // document.member_form.id.value="";
      document.member_form.pass.value="";
      document.member_form.pass_confirm.value="";
      document.member_form.value="";
      document.member_form.nick.value="";
      document.member_form.hp1.value="010";
      document.member_form.hp2.value="";
      document.member_form.hp3.value="";
      document.member_form.email1.value="";
      document.member_form.email2.value="";

      document.member_form.id.focus();

      return;
}

  </script>

  </head>

<?php
  require_once "DBManager.php";

  try{
    $dbo = connect();

    $sql = "select * from member where id= :id";

    $stt = $dbo->prepare($sql, array(
      PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL)
    );


    $_SESSION['userid'] = "testUser1";

    $stt->execute(array(':id'=>$_SESSION['userid']));

    $row = $stt->fetch(PDO::FETCH_ASSOC);

    // -  <--- 기준으로 문자열을 폭파시켜서 割る 함.
    $hp = explode("-", $row['hp']);
    $email = explode("@", $row['email']);

    $dbo = NULL;  // DB를 닫아도 위에서 변수로 받은 값들은 살아있기 때문에 닫아도 됨

  }catch(PDOException $e){
    exit("오류 발생: {$e->getMessage()}");
  }

?>

  <body>
      <div id="wrap">
        <div id="header">
          <?php require_once "../lib/top_login2.php"; ?>
        </div> <!-- header end -->

        <div id="menu">
          <?php require_once "../lib/top_menu2.php"; ?>
        </div> <!-- menu end -->

        <div id="content">
          <div id="col1">
            <div id="left_menu">
              <?php require_once "../lib/left_menu.php"; ?>
            </div>
          </div> <!-- col1 end -->

          <div id="col2">
            <form name = "member_form" method="post" action="modify.php">
              <div id = "title">
                <img src="../img/title_join.gif">
              </div> <!-- title end -->

          <div id="form_join">
            <div id ="join1">
              <ul>
                <li>* 아이디</li>
                <li>* 비밀번호</li>
                <li>* 비밀번호 확인</li>
                <li>* 이름</li>
                <li>* 닉네임</li>
                <li>* 휴대폰</li>
                <li>&nbsp;&nbsp;&nbsp;이메일</li>
              </ul>
            </div>

            <div id ="join2">
              <ul>
                <!-- <li><div id="id1"><input type="text" name="id"></div> -->
                <li><?=$row['id']?>
                <!-- <div id="id2"><a href="#"><img src="../img/check_id.gif"
                  onclick="check_id()"></a></div><div id="id3">4~12자이 영문 소문자,
                    숫자와 특수기호(_)만 사용할 수 있습니다.</div> -->
                </li>

                <li><input type="password" name="pass" value="<?=$row['pass'] ?>"></li>

                <li><input type="password" name="pass_confirm" value="<?=$row['pass'] ?>"></li>

                <li><input type="text" name="name" value="<?=$row['name'] ?>"></li>

                <li><div id="nick1"><input type="text" name="nick" value="<?=$row['nick'] ?>"></div>
                <div id="nick2"><a href="#"><img src="../img/check_id.gif"
                  onclick="check_nick()"></a></div>
                </li>

                <li>
                  <!-- <select class="hp" name="hp1">
                     <option value='010'>010</option>
                     <option value='011'>011</option>
                     <option value='016'>016</option>
                     <option value='017'>017</option>
                     <option value='018'>018</option>
                     <option value='019'>019</option>
                   </select> -->
                  <input type="text" class="hp" name="hp1" value="<?=$hp[0] ?>"> -
                  <input type="text" class="hp" name="hp2" value="<?=$hp[1] ?>"> -
                  <input type="text" class="hp" name="hp3" value="<?=$hp[2] ?>">
              </li>
                <li><input type="text" id="email1" name"email1" value="<?=$email[0] ?>"> @
                    <input type="text"name="email2" value="<?=$email[1] ?>"></li>
              </ul>
            </div>
          <div class ="clear"> </div>
          <div id="must"> *은 필수 입력항목입니다. </div>

          <div id="button"><a href="#"><img src="../img/button_save.gif"
            onclick="check_input()"></a>&nbsp;&nbsp;
          <a href="#"><img src="../img/button_reset.gif" onclick="reser_form()"></a>
        </div>

      </form>
    </div>  <!-- col2 end -->
    </div>  <!-- content end -->
  </div>  <!-- wrap end -->

  </body>
</html>
