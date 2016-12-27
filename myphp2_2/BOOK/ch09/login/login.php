<?php
           session_start();
?>
<meta charset="utf-8">
<?php

  $id = $_POST['id'];
  $pass = $_POST['pass'];

   // 이전화면에서 이름이 입력되지 않았으면 "이름을 입력하세요"
   // 메시지 출력
   if(!$id) {
     echo("
           <script>
             window.alert('아이디를 입력하세요.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   if(!$pass) {
     echo("
           <script>
             window.alert('비밀번호를 입력하세요.')
             history.go(-1)
           </script>
         ");
         exit;
   }

  //  include "../lib/dbconn.php";
  //  $result = mysql_query($sql, $connect);
  //  $num_match = mysql_num_rows($result);

  require_once "../DBManager.php";

  $dbo = connect();

   $sql = "select * from member where id = :id";

   $stt = $dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));

   $result = $stt->execute(array(':id'=>$id));


   if(!$result)
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다.')
             history.go(-1)
           </script>
         ");
    }
    else
    {
        // $row = mysql_fetch_array($result);
        // $db_pass = $row['pass'];
        $sql2 = "select * from member";
        $stt2 = $dbo->prepare($sql2, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));

        $stt2->execute(array(':id'=>$result));
        while($row = $stt2->fetch(PDO::FETCH_ASSOC)){
            $db_pass = $row['pass'];
        if($pass != $db_pass)
        {
           echo("
              <script>
                window.alert('비밀번호가 틀립니다.')
                history.go(-1)
              </script>
           ");

           exit;
        }
        else
        {


           $userid = $row['id'];
		   $username = $row['name'];
		   $usernick = $row['nick'];
		   $userlevel = $row['level'];

      // $userid = "csw";
      // $username = "슈";
      // $usernick = "슈";
      // $userlevel = 9;

           $_SESSION['userid'] = $userid;
           $_SESSION['username'] = $username;
           $_SESSION['usernick'] = $usernick;
           $_SESSION['userlevel'] = $userlevel;

           echo("
              <script>
                location.href = '../index.php';
              </script>
           ");
        }
   }
 }
?>
