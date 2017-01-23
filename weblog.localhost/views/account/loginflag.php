
<link href="/css/login_css.css" type="text/css" rel="stylesheet">
<?php if ($session->isAuthenticated()): ?>

<h2 class="login_id"><?php echo $_SESSION['user']['user_name']; ?></h2>

<div class="top_loginflag">
<?php
    if(isset($_SESSION['user']['user_name']) && $_SESSION['user']['user_name'] == "admin"){ ?>
        <form  action="<?php print $base_url; ?>/product/adminUpPage" method="post">
          <input class="top_admin_upProduct" type="submit" name="name" value="상품등록">
        </form>
<?php } ?>

      <form  action="<?php print $base_url; ?>/account/signout" method="post">
        <input class="top_login_button" type="submit" name="name" value="로그아웃">
      </form>

      <form  action="<?php print $base_url; ?>/account/deleteId" method="post">
        <input class="top_delete_id" type="submit" name="name" value="회원탈퇴">
      </form>

</div>

  <?php else: ?>

<div class="top_loginflag">
    <form  action="<?php print $base_url; ?>/account/signin" method="post">
      <input class="top_login_button" type="submit" name="name" value="로그인">
    </form>


  <form action="<?php print $base_url; ?>/account/signup" method="post">
    <input class="top_signup_button"  type="submit" name="name" value="회원가입">
  </form>
</div>

  <?php endif; ?>
