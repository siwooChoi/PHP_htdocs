<?php
// echo "test text";

  require '../bootstrap.php';
  require '../BlogApp.php';

  $app = new BlogApp(false);
      // true 에러출력,    flase 에러출력X
  $app->run();


?>
