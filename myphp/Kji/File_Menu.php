
<?php
  $savefile = dirname(__FILE__)."/msg.txt";
  // if(!file_exists($savefile)) {
  //   echo "아직 저장된 메시지 없음";
  //   exit;
  // }

  $msg = file_Get_contents($savefile);
  $msg_html = htmlspecialchars($msg);
  $msg_html = str_replace("\n", "<br />", $msg_html); // \n을 br태그로 바꿔라,  $msg_html 에서.

  echo <<<HTML
  <div style='border:solid black 1px; padding-left:80px;' >
    <div style='font-size:26px; color:blue;'>
      {$msg_html}
    </div>

  </div>

<form method="POST" action='main.php'>
  <pre>
    <input type='submit' value='글 작성'>
  </pre>
</form>

HTML;





?>
