<div class="status">
	<div class="status_content">
  <a href="<?php print $base_url; ?>/user/<?php print $this->escape(
  $status['user_name']); ?>">
	<?php print $this->escape($status['user_name']); ?>
	<!-- userAction을 위한 링크 생성 -->
  </a>
	<?php print $this->escape($status['message']); ?>
	</div>
	<div>
  <a href="<?php print $base_url; ?>/user/<?php print $this->escape(
  $status['user_name']); ?>/status/<?php print $this->escape(
  $status['id']); ?>">
	<?php
		// echo "status.php에서의 this가 의미하는것 : <br>";
		// echo var_dump($this);
		// echo "<br><br>";
		//
		// echo "status.php에서의 base_url ??  : <br>";
		// echo var_dump($base_url);
		// echo "<br><br>";

		
	?>
	<?php  print $this->escape($status['time_stamp']); ?>
	<!-- specificAction을 위한 링크 생성 -->
  </a>
	</div>
</div>
