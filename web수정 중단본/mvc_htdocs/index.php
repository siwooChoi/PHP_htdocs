<?php
// echo "test text";

  require '../bootstrap.php';

  // require '../BlogApp.php';
  // $app = new BlogApp(true);

  require '../MallApp.php';
  $app = new MallApp(true);
      // true 에러출력,    flase 에러출력X

  $app->run();


?>
