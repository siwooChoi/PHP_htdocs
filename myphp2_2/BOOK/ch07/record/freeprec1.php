<?php
// table 내의 record 읽는 코드.
    require_once "DBManager.php";

    $dbo = connect();

    $testUserid = "testUser1";

    $sql = "select * from userlist where id = :id";



  try {
    $show_tables = $dbo->prepare($sql);
    $show_tables->execute();
    echo "<table border = '1'>";
    while($row = $show_tables->fetch(PDO::FETCH_ASSOC)){
      echo "<tr>";
      echo "<td>".$row['userid']."</td>";
      echo "<td>".$row['userpw']."</td>";
      echo "</tr>";
    }

    //
    // ':id'=>$testUserid;
    // ':id'=>1234;

  } catch (Exception $e) {
      echo $e->getMessage();
  }





 ?>
