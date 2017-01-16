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
	<?php print $this->escape($status['time_stamp']); ?>
	<!-- specificAction을 위한 링크 생성 -->
  </a>
	</div>
</div>
