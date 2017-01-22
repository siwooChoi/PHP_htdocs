<link href="/css/login_css.css" type="text/css" rel="stylesheet">
<?php if ($session->isAuthenticated()): ?>

<h2 class="login_id"><?php echo $_SESSION['user']['user_name']; ?></h2>

<div class="top_loginflag">


      <form class="top_login_button" action="<?php print $base_url; ?>/account/signout" method="post">
        <input type="submit" name="name" value="로그아웃">
      </form>

</div>

  <?php else: ?>

<div class="top_loginflag">
    <form class="top_login_button" action="<?php print $base_url; ?>/account/signin" method="post">
      <input type="submit" name="name" value="로그인">
    </form>


  <form class="top_signup_button" action="<?php print $base_url; ?>/account/signup" method="post">
    <input type="submit" name="name" value="회원가입">
  </form>
</div>

  <?php endif; ?>
