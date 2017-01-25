<?php $this->setPageTitle('title', '사용자의 Top Page') ?>

<form action="<?php print $base_url; ?>/status/post" method="post">
	<input type="hidden"
         name="_token"
         value="<?php print $this->escape($_token); ?>" />
  <?php if (isset($errors) && count($errors) > 0): ?>
  <?php print $this->render('errors', array('errors' => $errors)); ?>
  <?php endif; ?>

	<?php
				// echo "blog/index.php 에서의 base_url : ";
				// var_dump($base_url);
		?>


	<p> 작성 글 입력 : </p>
	<textarea name="message_text"
            rows="4"
            cols="70"><?php print $this->escape($message); ?>
  </textarea>
	<p><input type="submit"
            value="글 등록" /></p>
</form>
<hr>
<h2>글 목록</h2>
<div id="statuses">
	<?php foreach ($statuses as $status): ?>
  <?php print $this->render('blog/status', array('status' => $status)); ?>
	<?php endforeach; ?>
</div>
