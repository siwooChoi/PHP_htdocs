  <!-- 40 페이지 -->
<?php $this->setPageTitle('title', '계정 생성')
// 여기서의 $this 는  View객체 를 의미한다.
?>

<h2>사용자 계정을 생성</h2>
<form action="<?php print $base_url; ?>/account/register" method="post">
              <?php  // register에 사용자가 입력하는 값은 3개(inputs의 id,pass / token 까지 합해서 3개이다.) ?>
  <input type="hidden" name="_token" value="<?php print $this->escape($_token); ?>"/>
  <!-- View클래스의 escape() -->

  <?php if(isset($errors) && count($errors) > 0): ?>
  <?php print $this->render('errors', array('errors' => $errors));
  // View객체의 render()이다. ?>
  <?php endif; ?>

  <?php print $this->render('account/inputs', array('user_name' => $user_name, 'password' => $password, )); ?>
  <p><input type="submit" value="등록" /></p>
</form>
