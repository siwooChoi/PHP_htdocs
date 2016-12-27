<?php

  $dsn = 'mysql:host=127.0.0.1;dbname=syu_db;';
  $user = 'root';
  $pass = '0000';

  try{
    $db_obj = new PDO($dsn, $user, $pass);

    print '접속 성공';

  }catch(PDOException $e){
    exit('DB접속 불가: {$e->getMessage()}');
  }

  
  //$db_obj = NULL;  // 가비지컬렉션 이 나타남


 ?>
