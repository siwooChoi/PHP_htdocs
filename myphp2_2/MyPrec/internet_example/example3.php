

<!-- Example#3 Closing a connection -->

<?php
  $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
  // use the connection here

  // and now we're done; close it
  $dbh = null;
?>
