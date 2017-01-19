<?php if ($session->isAuthenticated()): ?>


    <a href="<?php print $base_url; ?>/account/signout">
      <div>
        로그아웃
      </div>
    </a>

    <a href="">
      <div>
        장바구니
      </div>
    </a>


  <?php else: ?>


  <a href="<?php print $base_url; ?>/account/signin">
    <div>
      로그인
    </div>
  </a>

  <a href="<?php print $base_url; ?>/account/signup">
    <div>
      계정 등록(회원가입)
    </div>
  </a>


  <?php endif; ?>
