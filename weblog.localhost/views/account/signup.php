<?php $this->setPageTitle('title', '계정 생성') ?>
<?php //print "(signup.php 에서의 2번라인 escape(_token): ".$this->escape($_token); ?>
<link href="/css/signup_css.css" type="text/css" rel="stylesheet">
<form class="signupmain" action="<?php print $base_url; ?>/account/register" method="post">
	<input type="hidden" name="_token" value="<?php print $this->escape($_token); ?>" />

           <!-- View클래스의 escape() -->
  <?php if (isset($errors) && count($errors) > 0): ?>
  <?php print $this->render('errors', array('errors' => $errors)); ?>
  <?php endif; ?>

  <?php  // var_dump($this); //이 객체에서 사용하는 $this는 View객체이다. ?>



  <?php //print $this->render('account/createUser',   // View객체의 render를 사용해서 inputs.php 를 실행
                                                  // --수정-->>  createUser.php 실행
    //                         array('user_name' => $user_name, 'password' => $password,
                                  //  'nick'      => $user_nick, 'tel'      => $user_tel,
                                  //  'email'     => $user_email, 'basket'  => $basket
    //                             )
  //                         ); ?>

  <p class="createUser_title">회원 가입</p>
  <table class="createUser_table">
    <tr>
      <td>

  I D <input class="createUserbox1" type="text" name="user_name">
         <!-- <input type="button" name="checkId" value="중복확인" onclick="Script_checkid()"> -->
          <br>
  PW <input class="createUserbox2" type="password" name="password"><br>
  PW <input class="createUserbox3" type="password" name="password2"><br>
  NICK <input class="createUserbox5" type="text" name="nick"><br>
  TEL <input class ="createUsertel1" type="text" name="tel1" maxlength="3">
          <span class="telofbar1"> - </span>
          <input class="createUsertel2" type="text" name="tel2" maxlength="4">
          <span class="telofbar2"> - </span>
          <input class="createUsertel3" type="text" name="tel3" maxlength="4"> <br>
  Email <input class="createUser_email1" type="text" name="email1">  <span class="emailofsea"> @ </span>
         <input class="createUser_email2" type="text" name="email2">


</table>



	<p> <input class="create" type="submit" value="등록" /> </p>
</form>
<form action="<?php echo $base_url; ?>/">
<input class="cancel" type="submit" value="취소">
</form>
