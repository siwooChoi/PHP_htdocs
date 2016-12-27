<?php

  function connect() {
    $dsn = 'mysql:host=localhost; dbname=syu_db; charset=utf8;';
    $user = 'root';
    $pass = '0000';

    try{
      $db = new PDO($dsn, $user, $pass);
    } catch(PDOException $e){
      exit("접속불가 : {$e->getMessage()}");
    }

    return $db;

  }

/*
try{
  $dbo = connect();
  $sql = " ";
  $sql .= " ";


  $stt = $dbo -> prepare($sql,

      array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $result = $stt->execute();

      if($result){
        echo "성공";
      } else {
        echo "실패";
      }

  $dbo = NULL;
} catch(PDOException $e){
      exit("에러발생: {$e->getMessage()}");
}

*/


 ?>
