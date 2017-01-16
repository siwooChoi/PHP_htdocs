<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<!-- 각 action에 따른 views폴더내의 view파일들에서 설정하여 보내줌-->
<title>
<?php if (isset($title)): print $this->escape($title) . ' - '; endif; ?>
Weblog
</title>
<!-- { endfor; endwhile; endswitch; endforeach;} -->
<link rel="stylesheet"
      type="text/css"
      href="/css/style.css" />
</head>
<body>
<div id="header">
	<h1><a href="<?php print $base_url; ?>/">
    <!--$request, $base_url,$session==> Controller에서 View 객체 생성시 전달해줌 -->
  --- Weblog --- Weblog --- Weblog --- Weblog --- Weblog ---
  </a></h1>
</div>

<div id="nav">
	<p>
		<?php if ($session->isAuthenticated()): ?>
			<a href="<?php print $base_url; ?>/">
      Top Page
      </a>
			<a href="<?php print $base_url; ?>/account">
      계정
      </a>
		<?php else: ?>
			<a href="<?php print $base_url; ?>/account/signin">
      로그인
      </a>
			<a href="<?php print $base_url; ?>/account/signup">
      계정 등록(회원가입)
      </a>
		<?php endif; ?>
	</p>
</div>

<div id="main">
	<?php print $_content; ?>
  <!-- $_content: View 객체의 render()메서드에서 전달해줌 -->
</div>
</body>
</html>
