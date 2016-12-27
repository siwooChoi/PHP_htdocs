<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>

  <body>



    <form action="../controlor/controlSupport.php?mode=createUser" method="post">
      회원가입 창<br>
      아이디: <input type="text" name="createId">
             <!-- <input type="button" name="checkId" value="중복확인" onclick="Script_checkid()"> -->
              <br>
      비밀번호: <input type="password" name="createPw1"><br>
      비밀번호 확인: <input type="password" name="createPw2"><br>
      이름: <input type="text" name="createName"><br>
      닉네임: <input type="text" name="createNick"><br>
      연락처: <input type="text" name="createTel1" maxlength="3"> -
              <input type="text" name="createTel2" maxlength="4"> -
              <input type="text" name="createTel3" maxlength="4"> <br>
      이메일: <input type="text" name="createEmail1">@
             <input type="text" name="createEmail2">
      <br>
      <table>
        <tr><td>
      <input type="submit" value="가입하기">

    </form>

    <form action="../index.php" method="post">
    </td><td>
       <input type="submit" value="취소">
     </td></tr>
    </form>
      </table>




  </body>
</html>
