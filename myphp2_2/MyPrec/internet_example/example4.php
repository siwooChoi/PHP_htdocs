
<!-- Example#4 Persistent connections -->

<?php
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
?>
