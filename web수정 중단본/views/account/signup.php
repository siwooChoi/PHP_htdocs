<?php $this->setPageTitle('title', '계정 생성') ?>
<h2>사용자 계정을 생성</h2>
<form action="<?php print $base_url; ?>/account/register"
      method="post">
	<input type="hidden" name="_token" value="<?php print $this->escape($_token); ?>" />

           <!-- View클래스의 escape() -->
  <?php if (isset($errors) && count($errors) > 0): ?>
  <?php print $this->render('errors', array('errors' => $errors)); ?>
  <?php endif; ?>

  <?php  // var_dump($this); //이 객체에서 사용하는 $this는 View객체이다. ?>



  <?php print $this->render('account/inputs',   // View객체의 render를 사용해서 inputs.php 를 실행
                             array('user_name' => $user_name, 'password' => $password,)
                           ); ?>



	<p> <input type="submit" value="등록" /> </p>
</form>
